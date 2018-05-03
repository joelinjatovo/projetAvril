@extends('layouts.backend')

@section('subcontent')
{{Auth::user()->email}}
@endsection