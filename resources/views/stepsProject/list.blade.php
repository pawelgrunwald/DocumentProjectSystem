
@extends('template')

@section('title') 
  @if (isset($title))
    {{ $title }} 
  @endif
@endsection('title')

@section('content')
<div class="container">
  <div class="steps-list">
    <h3>Przebieg projektu - {{ $projectName }}</h3>
    <div class="steps-nav">
      <a href="{{ URL::to('projects') }}" class="btn btn-primary">Wróć do projektów</a>
      <a href="{{ URL::to('steps/' . $projectName . '/' . $projectID . '/createStep') }}" class="btn btn-success">Dodaj nowy krok</a>
    </div>
    {{ $steps->links() }}
        <table class="table">
          <thead>
              <th scope="col">Nazwa kroku</th>
              <th scope="col">Status</th>
              <th scope="col">Ustaw jako</th>
              <th scope="col">Akcje</th>
            </tr>
          </thead>
          <tbody>
          @foreach ($steps as $step)
            @if ($step->status == 'Skończony')
              <tr style="background: #A5D6A7; color: #000000;">
            @elseif ($step->status == 'W trakcie')
              <tr style="background: #FFCC80; color: #000000;">
            @else
              <tr style="background: #EF9A9A; color: #000000;">
            @endif
                <td> <a style="color: #000000; font-weight: 600;" href="{{ URL::to('steps/'.$projectName.'/'.$projectID.'/show/'.$step->id) }}"> {{ $step->name }} </a></td>
                <td> {{ $step->status }} </td>
                <td>
                  @if ($step->status == 'Nie zaczęty' || $step->status == 'W trakcie')
                    <a href="{{ URL::to('steps/'.$projectName.'/'.$projectID.'/set/'.$step->id.'/finite') }}" class="btn btn-dark">Skończony</a>
                    @if ($step->status == 'Nie zaczęty')
                       <a href="{{ URL::to('steps/'.$projectName.'/'.$projectID.'/set/'.$step->id.'/during') }}" class="btn btn-dark">W trakcie</a>
                    @endif
                  @endif  
                </td>
                <td>
                  <a href="{{ URL::to('steps/edit/'.$projectName.'/'.$projectID.'/'.$step->id) }}" class="btn btn-warning">Edytuj</a>
                  <a href="{{ URL::to('steps/delete/'.$projectName.'/'.$projectID.'/'.$step->id) }}" class="btn btn-danger" onclick="return confirm('Czy na pewno chcesz usunąć krok ?')">Usuń</a>
                </td>
              </tr>

          @endforeach
          </tbody>
        </table>     
  </div>
</div>
@endsection('content')