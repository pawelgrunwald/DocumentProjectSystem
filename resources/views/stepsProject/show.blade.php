
@extends('template')

@section('title') 
  @if (isset($title))
    {{ $title }} 
  @endif
@endsection('title')

@section('content')
<div class="container">
  <div class="simple-step">
    <div class="card text-dark bg-light mb-8" style="max-width: 100%;">
      <div class="card-header">{{ $step->name }}</div>
      <div class="card-body">
        {!! $step->describe !!}
      </div>
    </div>
  </div>
</div>
@endsection('content')