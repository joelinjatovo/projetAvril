@extends('layouts.backend')

@section('subcontent')
<div id="property-single">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Choose your plan</h3></div>
                <div class="panel-body">
                    <ul class="list-group">
                        @foreach ($items as $plan)
                            <li class="list-group-item clearfix">
                                <div class="pull-left">
                                    <h4>{{ $plan->name }}</h4>
                                    <h4>${{ number_format($plan->cost, 2) }} monthly</h4>
                                    @if ($plan->description)
                                        <p>{{ $plan->description }}</p>
                                    @endif
                                </div>
                                <a href="{{ url('/plan', $plan->slug) }}" class="btn btn-default pull-right">Choose Plan</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection