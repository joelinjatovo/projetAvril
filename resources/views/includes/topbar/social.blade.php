@php $socialConfig = \App\Models\Config::social(); @endphp
@foreach(\App\Models\Config::socialRules() as $key => $value)
    @if($metaConfig = $socialConfig->get_meta($key))
    <li class="{{'social-'.$key}}">
        <a href="{{$metaConfig->value}}" target="_blank">
          <i class="{{'fa fa-'.$key}}"></i>
        </a>
    </li>
    @endif
@endforeach