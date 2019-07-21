@extends('template')

@section('content')
<div class="container">
    <div class="home">
    @if (Auth::user()->type == 'admin')
        <div class="row justify-content-center">
            <div class="col-10 admin-header">
                
            </div>
            <div class="col-10 col-md-10 col-lg-10 col-xl-10 admin-panel">
                <h5>Panel administracyjny</h5>   
                <ul>
                    <li class="col-8 col-md-3 col-lg-3 col-xl-3 nav-item admin-cards">
                        <a class="nav-link" href="">
                            <img src="{{ URL::asset('media/icons/users.png') }}">
                            <span>Użytkownicy</span>
                        </a>
                    </li>
                    <li class="col-8 col-md-3 col-lg-3 col-xl-3 nav-item admin-cards">
                         <a class="nav-link" href="">
                            <img src="{{ URL::asset('media/icons/settings.png') }}">
                            <span>Ustawienia</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    @else
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <p>
                            Witamy w systemie zarządzania dokumentacją projektową.
                        </p>
                        <p>
                            O wszystkich aktualizacjach jak i nowych funkcjach systemu będziesz informowany na bieżąco w zakładce <b>Aktualności</b>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif
    </div>
</div>
@endsection
