<article class="property list-style clearfix">
    <div class="property-contents">
        <div class="author-box clearfix">
            <a href="{{route(\Auth::user()->role.'.user.contact', $user)}}" class="author-img"><img src="{{$user->imageUrl(false)}}" alt="{{$user->name}}" width="100px;"></a>
            <cite class="author-name">Personal Seller: <a href="{{route(\Auth::user()->role.'.user.contact', $user)}}">{{$user->name}}</a></cite>
            <span class="email"><i class="fa fa-email"></i> {{$user->email}}</span>
        </div>
    </div>
</article>