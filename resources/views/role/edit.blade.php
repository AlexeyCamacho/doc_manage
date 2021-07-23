@extends('layouts.base')

@section('title', 'Создание роли')

@section('content')
<div class="container-fluid border shadow bg-white rounded p-3">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1 class="pb-2">{{ ('Редактирование роли ') }}{{ $role->name }}</h1>
            <form id="role_edit_form">
                @csrf
                <input type="hidden" name="id" value="{{$role->id}}">
                <div class="col-4 mb-3">
                    <label for="exampleInputEmail1" class="form-label">Название</label>
                    <input name="title" type="text" class="form-control edit" id="edit-title" value="{{$role->name}}" placeholder="{{$role->name}}">
                    <x-print-errors action="edit" field="title"></x-print-errors>
                    <div class="form-text">Название роли (должности) на русском языке.</div>
                </div>
                <div class="col-4 mb-3">
                    <label for="exampleInputPassword1" class="form-label">Обозначение</label>
                    <input name="slug" type="text" class="form-control edit" id="edit-slug" 
                    value="{{$role->slug}}" placeholder="{{$role->slug}}">
                    <x-print-errors action="edit" field="slug"></x-print-errors>
                    <div class="form-text">Краткое обозначение в 1 слово на английском языке.
                    </div>
                </div>
                <h2 class="mt-4">{{ ('Выберите права для данной роли') }}</h2>
                <div class="container my-4 py-2">
                    <div class="row">
                        @foreach($permissionСategories as $permissionName => $permission)
                            <div class="col-lg-4 col-md-6 border-right border-left pl-4 pb-4">
                                <h3>{{ $permissionName }}</h3>
                                @foreach($permission as $perm)
                                    <div class="form-check">
                                        @if ($activePermissions->search($perm->slug) !== false)
                                            <input name="{{ $perm->slug }}" class="form-check-input" type="checkbox"
                                            value="{{ $perm->slug }}" id="create-{{ $perm->slug }}" checked>
                                        @else
                                            <input name="{{ $perm->slug }}" class="form-check-input" type="checkbox"
                                            value="{{ $perm->slug }}" id="create-{{ $perm->slug }}">
                                        @endif
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
                rm_class('edit', 'is-invalid'); 
                clear_class('errors-edit');
                ajax('role_edit_form', '{{ route('edit-role')}}', 'edit-', 'role');">
                Сохранить изменения</button>
            </form>
        </div>
    </div>
</div>
@endsection
