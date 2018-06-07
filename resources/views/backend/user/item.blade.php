<div class="property clearfix">
    <a href="{{route(\Auth::user()->role.'.user.contact', $user)}}"/>
        <img class="feature-image" src="{{$user->imageUrl(false)}}" alt="{{$user->name}}">
    </a>
    <div class="property-contents">
        <h6 class="entry-title"> <a href="{{route(\Auth::user()->role.'.user.contact', $user)}}">{{$user->name}}</a></h6>
        <span  class="btn btn-price">{{$user->role}}</span>
    </div>
</div>