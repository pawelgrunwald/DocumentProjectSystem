@extends('template')

@section('content')
<div class="container">
    <div class="news-single">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-8 col-xl-8">
                    <div class="card">
                        <div class="card-header">{{ $news->title }}</div>
                        <div class="card-body">
                            {{ $news->content }}
                            <br>
                            <br>
                            <a>
                                <img src="{{ URL::asset('images/'.$news->image) }}">
                            </a>
                        </div>
                        <div class="card-footer text-right">
                            {{ $news->date }}
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection