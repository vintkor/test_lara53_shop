@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            {!! Breadcrumbs::render('single_news', $news) !!}
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>{{ $news->title }}</h1>
                </div>
                <div class="panel-body">
                    {!! $news->text !!}
                </div>
                <div class="panel-footer">
                    Дата публикации: {{ $news->created_at }}
                </div>
            </div>
        </div>
    </div>
@endsection