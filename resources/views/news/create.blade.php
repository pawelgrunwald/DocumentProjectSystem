@extends('template')

@section('title')
	@if (isset($title))
		{{ $title }}
	@endif
@endsection

@section('content')
<div class="container">
  <div class="news-create">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <h3>Dodawanie aktualności</h3>
    <form action="{{ action('CurrentNewController@store') }}" method="POST" role="form" enctype="multipart/form-data">
      <input type="hidden" name="_token" value="{{ csrf_token() }}" />
      <div class="form-group">
        <label for="title">Tytuł</label>
        <input type="text" class="form-control" name="title" />
      </div>
      <div class="form-group">
        <label for="content">Treść</label>
        <textarea class="form-control" name="content" rows="10"></textarea>
      </div>
      <div class="custom-file">
        <input type="file" name="image">
      </div>
      <input type="hidden" name="date" value="{{ date('Y-m-d') }}">
      <input type="submit" class="btn btn-primary" value="Dodaj">
    </form>
  </div>
</div>
@endsection('content')