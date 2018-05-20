<template>
<div class="comments-app" id="comments">
   <!-- From -->
   <div class="comment-form" v-if="user">
        <div id="respond" class="comment-respond contact-form"> 
            <h4 id="reply-title" class="comment-reply-title">Laissez un commentaire</h4> 
            <form class="form" name="form" id="commentform">
                <p class="form-comment"><textarea v-model="message" id="comment" name="comment" placeholder="Commentaire" cols="45" rows="8" aria-required="true" required="required"></textarea></p> 
                <p class="form-submit"><input @click="saveComment" name="submit" type="button"  id="submit" class="submit-btn btn btn-default btn-lg" value="Poster un Commentaire"></p> 
            </form>                             
        </div>
   </div>
 
   <div class="comment-form" v-else>
       <div id="respond" class="comment-respond contact-form"> 
            <h4 id="reply-title" class="comment-reply-title">Laissez un commentaire</h4> 
            <form class="form" name="form" id="commentform">
                <a href="/login" class="form-comment"><textarea v-model="message" id="comment" name="comment" placeholder="Commentaire" cols="45" rows="8" aria-required="true" required="required"></textarea></a>
            </form>                             
        </div>
   </div>
 
   <!-- Comments List -->
   <ol class="commentlist" v-if="comments"> 
       <!-- Comment -->
       <li class="comment even thread-even depth-1" v-for="(comment, index) in commentsData">
           
           <!-- Comment Box -->
           <article class="clearfix" v-if="!spamComments[index] || !comment.spam"> 
                <a class="author-img" href="#"> 
                    <img src="/images/avatar.png" alt="Author">
                </a>                                     
                <div class="comment-detail-wrap"> 
                    <div class="comment-meta clearfix"> 
                        <h5 class="author"> <cite class="fn"> <cite class="fn"> <a href="#" rel="external nofollow" class="url">{{comment.name}}</a> </cite> </cite> </h5> 
                        <time datetime="2013-08-01T19:22:45+00:00">{{comment.date}}</time>                                             
                    </div>                                         
                    <div class="comment-body"> 
                        <p>{{comment.content}}</p> 
                        <a  v-on:click="openComment(index)" rel="nofollow" class="comment-reply-link btn btn-default btn-3d" href="#" data-hover="Reply">Repondre</a> 
                    </div>  
                    
                   <div class="comment-actions">
                       <ul class="list">
                           <li>Votes: {{comment.votes}}
                               <a v-if="!comment.votedByUser" v-on:click="voteComment(comment.id,'directcomment',index,0,'up')">Up Votes</a>
                               <a v-if="!comment.votedByUser" v-on:click="voteComment(comment.id,'directcomment',index,0,'down')">Down Votes</a>
                           </li>
                           <li>
                               <a v-on:click="spamComment(comment.id,'directcomment',index,0)">Spam</a>
                           </li>
                       </ul>
                   </div>
                </div>
           </article>
           
           <!-- form -->
           <div id="respond" class="comment-respond contact-form" v-if="commentBoxs[index]"> 
                <form class="form" name="form" id="commentform">
                    <p class="form-comment"><textarea v-model="message" id="comment" name="comment" placeholder="Commentaire" cols="45" rows="8" aria-required="true" required="required"></textarea></p> 
                    <p class="form-submit"><input @click="replyComment(comment.id,index)" name="submit" type="button"  id="submit" class="submit-btn btn btn-default btn-lg" value="Poster un Commentaire"></p> 
                </form>                             
           </div>
 
           <!-- Comment - Reply -->
           <ol class="children" v-if="comment.replies">
               <li class="comment" v-for="(replies,index2) in comment.replies">
                   <!-- Comment Box -->
                   <article class="clearfix" v-if="!spamCommentsReply[index2] || !replies.spam"> 
                        <a class="author-img" href="#"> 
                            <img src="/images/avatar.png" alt="Author">
                        </a>                                     
                        <div class="comment-detail-wrap"> 
                            <div class="comment-meta clearfix"> 
                                <h5 class="author"> <cite class="fn"> <cite class="fn"> <a href="#" rel="external nofollow" class="url">{{replies.name}}</a> </cite> </cite> </h5> 
                                <time datetime="2013-08-01T19:22:45+00:00">{{replies.date}}</time>
                            </div>                                         
                            
                            <div class="comment-body"> 
                                <p>{{replies.content}}</p> 
                                <a  v-on:click="replyCommentBox(index2)" rel="nofollow" class="comment-reply-link btn btn-default btn-3d" href="#" data-hover="Reply" style="display: none;">Repondre</a> 
                            </div>
                            
                            <div class="comment-actions">
                               <ul class="list">
                                   <li>Total votes: {{replies.votes}}
                                       <a v-if="!replies.votedByUser" v-on:click="voteComment(replies.id,'replycomment',index,index2,'up')">Up Votes</a>
                                       <a v-if="!replies.votedByUser" v-on:click="voteComment(comment.id,'replycomment',index,index2,'down')">Down Votes</a>
                                   </li>
                                   <li>
                                       <a v-on:click="spamComment(replies.id,'replycomment',index,index2)">Spam</a>
                                   </li>
                               </ul>
                            </div>
                            
                        </div>
                   </article>
                   
                   <!-- Reply form -->
                   <div id="respond" class="comment-respond contact-form" v-if="replyCommentBoxs[index2]"> 
                        <form class="form" name="form" id="commentform">
                            <p class="form-comment"><textarea v-model="message" id="comment" name="comment" placeholder="Commentaire" cols="45" rows="8" aria-required="true" required="required"></textarea></p> 
                            <p class="form-submit"><input @click="replyComment(comment.id,index)" name="submit" type="button"  id="submit" class="submit-btn btn btn-default btn-lg" value="Poster un Commentaire"></p> 
                        </form>                             
                   </div>
               </li>
           </ol>
       </li>
   </ol>
</div>
</template>

<script>
 
var _ = require('lodash');
 
export default {
   props: ['blog'],
 
   data() {
       return {
           comments: [],
           commentreplies: [],
           comments: 0,
           commentBoxs: [],
           message: null,
           replyCommentBoxs: [],
           commentsData: [],
           viewcomment: [],
           show: [],
           spamCommentsReply: [],
           spamComments: [],
           errorComment: null,
           errorReply: null,
           user: window.user
       }
   },
 
   http: {
       headers: {
           'X-CSRF-TOKEN': window.csrf
       }
   },
 
   methods: {
       fetchComments() {
           axios.get('/comments/' + this.blog.id).then(res => {
               console.log("---------fetchComments---------");
               console.log(res);
               console.log("-//------fetchComments----------");
               this.commentData = res.data;
               this.commentsData = _.orderBy(res.data, ['votes'], ['desc']);
               this.comments = 1;
           });
       },
 
       showComments(index) {
           if (!this.viewcomment[index]) {
               Vue.set(this.show, index, "hide");
               Vue.set(this.viewcomment, index, 1);
           } else {
               Vue.set(this.show, index, "view");
               Vue.set(this.viewcomment, index, 0);
           }
       },
 
       openComment(index) {
           if (this.user) {
               if (this.commentBoxs[index]) {
                   Vue.set(this.commentBoxs, index, 0);
               } else {
                   Vue.set(this.commentBoxs, index, 1);
               }
           }
       },
 
       replyCommentBox(index) {
           if (this.user) {
               if (this.replyCommentBoxs[index]) {
                   Vue.set(this.replyCommentBoxs, index, 0);
               } else {
                   Vue.set(this.replyCommentBoxs, index, 1);
               }
           }
       },
 
       saveComment() {
           if (this.message != null && this.message != ' ') {
               this.errorComment = null;
               axios.post('/comments', {
                   blog_id: this.blog.id,
                   content: this.message,
                   user_id: this.user.id
               }).then(res => {
                   console.log("---------saveComment---------");
                   console.log(res);
                   console.log("-//------saveComment----------");
                   if (res.data.status) {
                       this.commentsData.push({ 
                           "id": res.data.id, 
                           "name": this.user.name,
                           "content": this.message, 
                           "votes": 0, 
                           "reply": 0, 
                           "replies": [] 
                       });
                       this.message = null;
                   }
               });
           } else {
               this.errorComment = "Please enter a comment to save";
           }
       },
 
       replyComment(commentId, index) {
           if (this.message != null && this.message != ' ') {
               this.errorReply = null;
               axios.post('/comments', {
                   content: this.message,
                   user_id: this.user.id,
                   reply_id: commentId
               }).then(res => {
                   console.log("---------replyComment---------");
                   console.log(res);
                   console.log("-//------replyComment----------");
                   if (res.data.status) {
                       if (!this.commentsData[index].reply) {
                           this.commentsData[index].replies.push({ 
                               "id": res.data.id, 
                               "name": this.user.name,
                               "content": this.message, 
                               "votes": 0 
                           });
                           this.commentsData[index].reply = 1;
                           Vue.set(this.replyCommentBoxs, index, 0);
                           Vue.set(this.commentBoxs, index, 0);
                       } else {
                           this.commentsData[index].replies.push({ 
                               "id": res.data.id, 
                               "name": this.user.name, 
                               "content": this.message, 
                               "votes": 0
                           });
                           Vue.set(this.replyCommentBoxs, index, 0);
                           Vue.set(this.commentBoxs, index, 0);
 
                       }
                       this.message = null;
                   }
               });
 
           } else {
               this.errorReply = "Please enter a comment to save";
           }
       },
 
       voteComment(commentId, commentType, index, index2, voteType) {
           if (this.user) {
               axios.post('/comments/' + commentId + '/vote', {
                   user_id: this.user.id,
                   vote: voteType
               }).then(res => {
                   console.log("---------voteComment---------");
                   console.log(res);
                   console.log("-//------voteComment----------");
                   if (res.data) {
                       if (commentType == 'directcomment') {
                           if (voteType == 'up') {
                               this.commentsData[index].votes++;
                           } else if (voteType == 'down') {
                               this.commentsData[index].votes--;
                           }
                       } else if (commentType == 'replycomment') {
                           if (voteType == 'up') {
                               this.commentsData[index].replies[index2].votes++;
                           } else if (voteType == 'down') {
                               this.commentsData[index].replies[index2].votes--;
                           }
                       }
                   }
               });
           }
       },
 
       spamComment(commentId, commentType, index, index2) {
           console.log("spam here");
           if (this.user) {
               axios.post('/comments/' + commentId + '/spam', {
                   user_id: this.user.id,
               }).then(res => {
                   console.log("---------spamComment---------");
                   console.log(res);
                   console.log("-//------spamComment----------");
                   if (commentType == 'directcomment') {
                       Vue.set(this.spamComments, index, 1);
                       Vue.set(this.viewcomment, index, 1);
                   } else if (commentType == 'replycomment') {
                       Vue.set(this.spamCommentsReply, index2, 1);
                   }
               });
           }
       },
 
   },
 
   mounted() {
      console.log("mounted");
      this.fetchComments();
   }
}
</script>