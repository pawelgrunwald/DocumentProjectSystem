
@extends('template')

@section('title') 
  @if (isset($title))
    {{ $title }} 
  @endif
@endsection('title')

@section('content')
<div class="container">
  <div class="project-list">
      <h4>Projekty 
    @if (Auth::user()->type == 'user')
        <a href="{{ URL::to('projects/create') }}" class="btn btn-success">Nowy projekt</a>
    @endif
      </h4> 
      {{ $projects->links() }}
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Nazwa Projektu</th>
            @if (Auth::user()->type == 'admin')
              <th scope="col">Własność</th>
            @endif
            <th scope="col">Akcje</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($projects as $project)
          <tr>
            <td>
            @if (Auth::user()->type == 'user') 
              <a href=" {{ URL::to('steps/' . $project->projectName . '/' . $project->id) }} "> {{ $project->projectName }} </a>
            @else
              {{ $project->projectName }}
            @endif
            </td>
            @if (Auth::user()->type == 'admin')
              <td> {{ $project->userName }} </td>
            @endif
            <td>
              <a href="{{ URL::to('projects/edit/'.$project->id) }}" class="btn btn-warning">Edytuj</a>
              <a href="{{ URL::to('projects/delete/'.$project->id) }}" class="btn btn-danger" onclick="return confirm('Czy na pewno chcesz usunąć projekt ?')">Usuń</a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
  </div>
</div>
@endsection('content')