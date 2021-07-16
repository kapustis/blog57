@extends('blog.admin.layout.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="mb-4">Пользователь {{$user->name}}</h1>
                <form method="post" action="{{ route('blog.admin.users.update', ['user' => $user->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="Имя, Фамилия"
                               required maxlength="255" value="{{ old('name') ?? $user->name }}">
                    </div>

                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Адрес почты"
                               required maxlength="255" value="{{ old('email') ?? $user->email }}">
                    </div>

                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" name="change_password"
                               id="change_password">
                        <label class="form-check-label" for="change_password">
                            Изменить пароль пользователя
                        </label>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" name="password" maxlength="255"
                               placeholder="Новый пароль" value="">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" name="password_confirmation" maxlength="255"
                               placeholder="Пароль еще раз" value="">
                    </div>
                    @perm('assign-role')
                        @include('blog.admin.users.all-roles')
                    @endperm
                    @perm('assign-permission')
                        @include('blog.admin.users.all-perms')
                    @endperm
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
