@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            {!! Breadcrumbs::render('news') !!}
        </div>
    </div>
    <div class="container">
        <div class="row">
            @foreach($all_news as $news)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="{{ route('news') }}/{{ $news->slug }}">{{ $news->title }}</a>
                        <span class="pull-right">{{ $news->created_at }}</span>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-2">
                            <img src="../images/news/{{ $news->img }}" alt="{{ $news->title }}" class="img-responsive thumbnail">
                        </div>
                        <div class="col-md-10">
                            {{ str_limit( strip_tags($news->text), 600) }}
                        </div>
                    </div>
                    @if(Auth::user())
                        <div class="panel-footer">
                            <button type="submit" class="btn btn-default btn-xs" data-toggle="modal" data-target=".delete_news_{{ $news->id }}">
                                <i class="fa fa-trash-o" aria-hidden="true"></i> Удалить новость
                            </button>
                        </div>
                        {{-- Modal Delete News --}}
                        <div class="modal fade delete_news_{{ $news->id }}" tabindex="-1" role="dialog" aria-labelledby="delete_news_{{ $news->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="/delete_news/{{ $news->id }}" method="post">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Вы точно хотите удалить эту новость?</h4>
                                        </div>
                                        <div class="modal-body">
                                            <h3 class="text-success">{{ $news->title }}</h3>
                                            {{ csrf_field() }}
                                            <input type="hidden" value="{{ $news->id }}">
                                            <input type="hidden" name="_method" value="DELETE" >
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-danger pull-left">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i> Да удалить!
                                            </button>
                                            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">
                                                <i class="fa fa-ban" aria-hidden="true"></i> Нет. Отмена
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
            {{ $all_news->links() }}
        </div>
    </div>
    @if(Auth::user())
        <style>
            .add-news {
                background: #18BC9C;
                transition: .2s;
                color: #fff;
                border: none;
                border-radius: 50%;
                padding: 14px 20px;
                font-size: 20px;
                display: block;
                position: fixed;
                bottom: 40px;
                right: 40px;
                box-shadow: 1px 1px 5px rgba(0,0,0,0.3);
            }
            .add-news:hover {
                background: #0F7864;
                transform: scale(1.1) rotate(90deg);
            }
        </style>
        <button class="add-news" data-toggle="modal" data-target=".add_news"><i class="fa fa-plus" aria-hidden="true"></i></button>

        <div class="modal fade add_news" tabindex="-1" role="dialog" aria-labelledby="add_news" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="/add_news" method="post" enctype="multipart/form-data" class="form">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Добавление новости</h4>
                        </div>
                        <div class="modal-body">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="title">Название новости</label>
                                <input type="text" id="title" name="title" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="description">SEO-описание новости</label>
                                <input type="text" id="description" name="description" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="keywords">SEO-Кличевые слова (через запятую)</label>
                                <input type="text" id="keywords" name="keywords" class="form-control">
                            </div>
                            <label for="text">Текст новости</label>
                            <textarea name="text" id="text" cols="30" rows="10" class="form-control"></textarea>
                            <div class="form-group">
                                <label for="img">Изображение</label>
                                <input type="file" id="img" name="img" class="form-control" accept="image/jpg,image/jpeg,image/png">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success pull-left">
                                <i class="fa fa-floppy-o" aria-hidden="true"></i> Добавить новость
                            </button>
                            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">
                                <i class="fa fa-ban" aria-hidden="true"></i> Отмена
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection