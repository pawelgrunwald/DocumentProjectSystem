
@extends('template')

@section('title') 
  @if (isset($title))
    {{ $title }} 
  @endif
@endsection('title')

@section('content')
<div class="container">
  <div class="user-data">
    <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              Moje dane
            </div>
            <div class="card-body">
              <table class="table">
                <tr>
                  <td>Imię i nazwisko</td>
                  <td> {{ $userData['name'] }} {{ $userData['lastname'] }} </td>
                </tr>
                <tr>
                  <td>Email</td>
                  <td> {{ $userData['email'] }} </td>
                </tr>
                <tr>
                  <td>Typ konta</td>
                  <td> {{ $userData['type'] }} </td>
                </tr>
              </table>
            </div>
          </div>
      </div>   
    </div>
  </div>
</div>
@endsection('content')