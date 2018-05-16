<div class="property clearfix">
    <a href="{{route('user.index',['user'=>$user])}}">
        <img src="{{$user->imageUrl(false)}}" alt="Property Image">
    </a>
    <div class="property-contents">
        <h6 class="entry-title"> <a href="{{route('user.index',['user'=>$user])}}">{{$user->name}}</a></h6>
        <span  class="btn btn-price">{{$user->role}}</span>
    </div>
</div>