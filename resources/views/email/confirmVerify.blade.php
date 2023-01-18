@extends('layouts.app')

@section('content')
<h1>email verified</h1> 
@if(session()->has('message'))
  <h2> {{ session('message') }}</h2>
@endif

@endsection

