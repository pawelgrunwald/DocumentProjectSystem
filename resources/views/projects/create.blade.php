@extends('template')

@section('title')
	@if (isset($title))
		{{ $title }}
	@endif
@endsection

@section('content')
<div class="container">
  <div class="create-project">
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <h3>Dodawanie Projektu</h3>
      <form action="{{ action('ProjectController@store') }}" method="POST" role="form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <div class="form-group">
          <label for="name">Nazwa</label>
          <input type="text" class="form-control" name="name" />
        </div>
        <input type="submit" class="btn btn-primary" value="Dodaj">
      </form>
  </div>
</div>
@endsection('content')