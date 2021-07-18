@extends('layouts.base')

@section('title', 'Роли')

@section('content')
<div class="container-fluid border shadow bg-white rounded p-3">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1>{{ ('Роли') }}</h1>
            <table class="table table-striped my-4">
                <thead>
                    <tr>
                        <th scope="col">{{ ('ID') }}</th>
                        <th scope="col">{{ ('Роль') }}</th>
                        <th scope="col">{{ ('Обозначение') }}</th>
                        <th scope="col">{{ ('Действия') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <th scope="row"> {{ $role->id }} </th>
                            <td> {{ $role->name }} </td>
                            <td> {{ $role->slug }}</td>
                            <td> @include('icons.roles') </td>
                        </tr>    
                    @endforeach
                </tbody>
            </table>
            {{ $roles->links() }}

            @can('create-roles')
                <button type="button" class="btn btn-outline-primary">
                    <i class="bi bi-plus-circle"></i><span class="m-1">{{ __('Создать роль') }}</span>
                </button>
            @endcan
        </div>
    </div>
</div>

@endsection
