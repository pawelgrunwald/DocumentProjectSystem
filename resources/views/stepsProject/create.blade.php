@extends('template')

@section('title')
	@if (isset($title))
		{{ $title }}
	@endif
@endsection

@section('content')
<div class="container">
  <div class="create-step">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <h3>Dodawanie kroków do projektu - {{ $projectName }}</h3>
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#infoModal">Informacja</button>
    <form action="{{ action('StepController@store') }}" method="POST" role="form">
      <input type="hidden" name="_token" value="{{ csrf_token() }}" />
      <input type="hidden" name="projectID" value="{{ $projectID }}">
      <input type="hidden" name="projectName" value="{{ $projectName }}">
      <div class="form-group">
        <label for="name">Nazwa kroku</label>
        <input type="text" class="form-control" name="name" />
      </div>
      <div class="form-group">
        <label for="describe">Opis kroku</label>
        <textarea class="form-control" name="describe" rows="10"></textarea>
      </div>
      <input type="submit" class="btn btn-primary" value="Dodaj krok">
    </form>
  </div>
  <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Informacja</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h6>Dozwolone znaczniki HTML</h6>

          <ul>
            <li><xmp><br></xmp>Znacznik nowej lini w tekście</li>
            <li><xmp><ul></ul></xmp>Znaczniki dotyczące listy nienumerowanej</li>
            <li><xmp><ol></ol></xmp>Znaczniki dotyczące listy numerowanej</li>
            <li><xmp><li></li></xmp>Znaczniki, w których wpisuje się elementy listy numerowanej bądź nienumerowanej</li>
            <li><xmp><h4></h4></xmp>Znaczniki nagłówkowe</li>
            <li><xmp><h5></h5></xmp>Znaczniki nagłówkowe</li>
            <li><xmp><h6></h6></xmp>Znaczniki nagłówkowe</li>
            <li><xmp><p></p></xmp>Znaczniki wstawiające nowy akapit w tekście</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection('content')