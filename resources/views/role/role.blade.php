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
                <a role="button" class="btn btn-outline-primary" href="{{ route('create-role') }}">
                    <i class="bi bi-plus-circle"></i><span class="m-1">{{ __('Создать роль') }}</span>
                </a>
            @endcan
        </div>
    </div>
</div>

@can('delete-roles')
<!-- MODAL delete -->
<div class="modal fade" id="deleteRoles" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Удаление</h5>
                <button type="button" class="close" aria-label="Close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="role_delete_form">
                    @csrf
                    <input name="id" id="delete-id" type="hidden" value="">
                    <div class="mb-3">
                        Вы собираетесь удалить роль <span id="delete-name"></span> . У всех пользователей, которым была присвоена эта роль, она сбросится. Вы сможете переназначить пользователю другую роль. Вы уверены, что хотите это сделать?
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-danger" onclick=" 
                ajax('role_delete_form', 'role/delete', 'delete-'); ">Удалить</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var deleteUserModal = document.getElementById('deleteRoles');
    deleteUserModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        set_value_modal(deleteUserModal, button, 'data-bs-id', 'delete-id');
        set_value_div(button, 'data-bs-name', 'delete-name');
    })
</script>
@endcan

@endsection
