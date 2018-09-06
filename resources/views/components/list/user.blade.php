<li>
  <img src="{{$user->imageUrl()}}" alt="{{$user->fullname()}}">
  <a class="users-list-name" href="#">{{$user->fullname()}}</a>
  <span class="users-list-date">{{$user->created_at->diffForHumans()}}</span>
</li>
<!-- /.item -->