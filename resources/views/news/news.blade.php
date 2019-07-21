@extends('template')

@section('content')
<div class="container">
    <div class="news-list">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-8 col-xl-8 offset-md-2 offset-lg-2 offset-xl-2">
                <div class="add-news">
                    <h4>Aktualności
                    @if (Auth::user()->type == 'admin')
                        <a href="{{ URL::to('news/create') }}" class="btn btn-success">Dodaj wpis</a>
                    @endif
                    </h4>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            {{ $news->links() }}
        </div>
        @foreach ($news as $new)
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-8 col-xl-8">
                    <div class="card">
                        <div class="card-header">{{ $new->title }}</div>
                        <div class="card-body">

                            @if (strlen($new->content) > 400)
                                {{ substr($new->content, 0, 400) }}
                                ... <a href="{{ URL::to('news/'.$new->id) }}">więcej</a>
                            @else
                                {{ $new->content }}
                            @endif
                        </div>
                        <div class="card-footer text-right">
                            {{ $new->date }}
                        @if (Auth::user()->type == 'admin')
                            <div class="action-card">
                                <a href="{{ URL::to('news/delete/'.$new->id) }}" class="btn btn-danger" onclick="return confirm('Czy na pewno chcesz usunąć ten wpis ?');">Usuń</a>
                                <a href="{{ URL::to('news/edit/'.$new->id) }}" class="btn btn-warning">Edytuj</a>
                            </div>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection