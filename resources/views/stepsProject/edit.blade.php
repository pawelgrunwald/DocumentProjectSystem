@extends('template')

@section('title')
	@if (isset($title))
		{{ $title }}
	@endif
@endsection

@section('content')
<div class="container">
  <div class="edit-step">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <h3>Edycja kroku - {{ $step->name }}</h3>
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#infoModal">Informacja</button>
    <form action="{{ action('StepController@editStore') }}" method="POST" role="form">
      <input type="hidden" name="_token" value="{{ csrf_token() }}" />
      <input type="hidden" name="stepID" value="{{ $step->id }}">
      <input type="hidden" name="projectID" value="{{ $projectID }}">
      <input type="hidden" name="projectName" value="{{ $projectName }}">
      <div class="form-group">
        <label for="name">Nazwa kroku</label>
        <input type="text" class="form-control" name="name" value="{{ $step->name }}" />
      </div>
      <div class="form-group">
        <label for="describe">Opis kroku</label>
        <textarea class="form-control" name="describe" rows="10">{{ $step->describe }}</textarea>
      </div>
      @if ($step->status == 'Skończony')
  	    <div class="form-check">
  	        <input type="radio" class="form-check-input" id="editCheck" name="status" value="Nie zaczęty">
  	        <label class="form-check-label" for="editCheck">Nie zaczęty</label>
  	    </div>
  	    <div class="form-check">
  	        <input type="radio" class="form-check-input" id="editCheck" name="status" value="W trakcie">
  	        <label class="form-check-label" for="editCheck">W trakcie</label>
  	    </div>
  	@elseif ($step->status == 'W trakcie')
  		<div class="form-check">
  	        <input type="radio" class="form-check-input" id="editCheck" name="status" value="Nie zaczęty">
  	        <label class="form-check-label" for="editCheck">Nie zaczęty</label>
  	    </div>
      @else
  	    <div class="form-check">
  	        <input type="radio" class="form-check-input" id="editCheck" name="status" value="W trakcie">
  	        <label class="form-check-label" for="editCheck">W trakcie</label>
  	    </div>
      
      @endif
      <input type="submit" class="btn btn-primary" value="Aktualizuj krok">
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