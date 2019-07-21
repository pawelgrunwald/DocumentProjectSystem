@extends('template')

@section('title')
	@if (isset($title))
		{{ $title }}
	@endif
@endsection

@section('content')
<div class="container">
  <div class="edit-project">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <h3>Edycja projektu - {{ $project->name }}</h3>
    <form action="{{ action('ProjectController@editStore') }}" method="POST" role="form">
      <input type="hidden" name="_token" value="{{ csrf_token() }}" />
      <input type="hidden" name="projectID" value="{{ $project->id }}">
      <div class="form-group">
        <label for="name">Nazwa projektu</label>
        <input type="text" class="form-control" name="name" value="{{ $project->name }}" />
      </div>
      <input type="submit" class="btn btn-primary" value="Aktualizuj projekt">
    </form>
  </div>
</div>
@endsection('content')