@extends('layouts.base')

@section('title', 'Создание роли')

@section('content')
<div class="container-fluid border shadow bg-white rounded p-3">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1>{{ ('Редактирование роли ') }}{{ $role->name }}</h1>
            <form id="role_add_form">
                @csrf
                <div class="col-4 mb-3">
                    <label for="exampleInputEmail1" class="form-label">Название</label>
                    <input name="title" type="text" class="form-control create" id="create-title" value="{{$role->name}}" placeholder="{{$role->name}}">
                    <x-print-errors action="create" field="title"></x-print-errors>
                    <div class="form-text">Название роли (должности) на русском языке.</div>
                </div>
                <div class="col-4 mb-3">
                    <label for="exampleInputPassword1" class="form-label">Обозначение</label>
                    <input name="slug" type="text" class="form-control create" id="create-slug" 
                    value="{{$role->slug}}" placeholder="{{$role->slug}}">
                    <x-print-errors action="create" field="slug"></x-print-errors>
                    <div class="form-text">Краткое обозначение в 1 слово на английском языке.<br> Пример: director.
                    </div>
                </div>
                <hr>
                <h2 class="mt-4">{{ ('Выберите права для данной роли') }}</h2>
                <div class="container my-4 py-2">
                    <div class="row">
                        @foreach($permissionСategories as $permissionName => $permission)
                            <div class="col-lg-4 col-md-6 border-right border-left pl-4">
                                <h3>{{ $permissionName }}</h3>
                                @foreach($permission as $perm)
                                    <div class="form-check">
                                        <input name="{{ $perm->slug }}" class="form-check-input" type="checkbox" value="{{ $perm->slug }}"
                                        id="create-{{ $perm->slug }}">
                                        <label class="form-check-label" for="{{ $perm->slug }}">
                                            {{ $perm->name }}
                                        </label>
                                    </div>    
                                @endforeach
                            </div>    
                        @endforeach
                    </div>
                </div>
                <a role="button" class="btn btn-outline-secondary" href="{{ route('role') }}">
                {{ __('Назад') }}</a>
                <button type="button" class="btn btn-primary" onclick="
                rm_class('create', 'is-invalid'); 
                clear_class('errors-create');
                ajax('role_add_form', 'create', 'create-', 'role');">
                Сохранить изменения</button>
            </form>
        </div>
    </div>
</div>
@endsection
