@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            {!! Breadcrumbs::render('profile') !!}
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <img src="../images/user/{{ $user->img }}" alt="{{ $user->name }}" class="img-responsive img-circle" style="margin: 0 auto; border: 1px solid #ecf0f1; padding: 3px; background: #fff">
                <p class="text-muted" style="text-align: center">Профиль создан {{ $user->created_at }}</p>
                <h1 style="text-align: center">Профиль пользователя {{ $user->name }}<br><small>{{ $user->email }}</small></h1>
            </div>
        </div>
    </div>

    <style>
        .edit_profile_style {
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
        .edit_profile_style:hover {
            background: #0F7864;
            transform: scale(1.1) rotate(20deg);
        }
    </style>

    <button class="edit_profile_style" data-toggle="modal" data-target=".edit_profile"><i class="fa fa-pencil" aria-hidden="true"></i></button>

    <div class="modal fade edit_profile" tabindex="-1" role="dialog" aria-labelledby="edit_profile" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('profile') }}" method="post" enctype="multipart/form-data" class="form">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Обновление провиля {{ $user->name }}</h4>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <div class="form-group">
                            <label for="name">Имя пользователя</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Адресс электронной почты</label>
                            <input type="text" id="email" name="email" class="form-control" value="{{ $user->email }}">
                        </div>
                        <div class="form-group">
                            <label for="img">Изображение</label>
                            <input type="file" id="img" name="img" class="form-control" accept="image/jpg,image/jpeg,image/png">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success pull-left">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i>  Обновить профиль
                        </button>
                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">
                            <i class="fa fa-ban" aria-hidden="true"></i> Отмена
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection