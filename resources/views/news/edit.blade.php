@extends('template')

@section('title')
	@if (isset($title))
		{{ $title }}
	@endif
@endsection

@section('content')
<div class="container">
  <div class="news-edit">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <h3>Edycja aktualności</h3>
    <form action="{{ action('CurrentNewController@editStore') }}" method="POST" role="form">
      <input type="hidden" name="_token" value="{{ csrf_token() }}" />
      <input type="hidden" name="news_id" value="{{ $news->id }}">
      <div class="form-group">
        <label for="title">Tytuł</label>
        <input type="text" class="form-control" name="title" value="{{ $news->title }}" />
      </div>
      <div class="form-group">
        <label for="content">Treść</label>
        <textarea class="form-control" name="content" rows="10">{{ $news->content }}</textarea>
      </div>
      <input type="submit" class="btn btn-primary" value="Zaktualizuj">
    </form>
  </div>
</div>
@endsection('content')