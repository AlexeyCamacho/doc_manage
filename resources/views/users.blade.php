@extends('layouts.base')

@section('title', 'Сотрудники')

@section('content')
<div class="container-fluid border shadow bg-white rounded p-3">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1>{{ ('Сотрудники') }}</h1>
            <table class="table table-striped my-4">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">ФИО</th>
                        <th scope="col">Должность</th>
                        <th scope="col">Последняя активность</th>
                        <th scope="col">Действия</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($data as $el)
                        <tr>
                            <th scope="row"> {{ $el->id }} </th>
                            <td> {{ $el->name }} </td>
                            <td> {{ $el->role }} </td>
                            <td> {{ $el->updated_at }} </td>
                            <td> @include('inc.icons') </td>
                        </tr>    
                    @endforeach 

                </tbody>
            </table>            

            <button type="button" class="btn btn-outline-primary user_add_button"
            onclick="display_block('user_add_form', 'user_add_button');">
                <i class="bi bi-plus-circle"></i><span class="m-1">{{ __('Добавить сотрудника') }}</span>
            </button>
            <button type="button" class="btn btn-outline-danger d-none user_add_form" 
            onclick="display_block('user_add_button', 'user_add_form');
            rm_class('is-invalid'); clear_class('errors');">
                <i class="bi bi-x-lg"></i>
            </button>
            <button type="button" class="btn btn-outline-success d-none user_add_form" 
            onclick="rm_class('is-invalid'); clear_class('errors'); 
            ajax('user_add_form', '/doc_manage/users/create'); ">
                <i class="bi bi-check-lg"></i>
            </button>
            <form method="POST" class="row my-3 d-none user_add_form" id="user_add_form" action="users/create">
                @csrf
                <div class="col-3">
                    <input name="login" id="login" type="text" class="form-control" placeholder="Логин" required>
                    <span class="text-danger">
                        <strong id="error-login" class="errors"></strong>
                    </span>
                </div>
                <div class="col-3">
                    <input name="email" id="email" type="email" class="form-control" 
                    placeholder="E-mail" required>
                    <span class="text-danger">
                        <strong id="error-email" class="errors"></strong>
                    </span>
                </div>
                <div class="col-3">
                    <input name="name" id="name" type="text" class="form-control" placeholder="ФИО" required>
                    <span class="text-danger">
                        <strong id="error-name" class="errors"></strong>
                    </span>
                </div>
                <div class="col-3">
                    <select name="role" id="role" class="form-select">
                        <option value="0">Тест</option>
                    </select>
                    <span class="text-danger">
                        <strong id="error-role" class="errors"></strong>
                    </span>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
