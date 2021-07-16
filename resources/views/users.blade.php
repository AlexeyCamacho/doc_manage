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
                        <th scope="col">{{ ('ID') }}</th>
                        <th scope="col">{{ ('ФИО') }}</th>
                        <th scope="col">{{ ('Должность') }}</th>
                        <th scope="col">{{ ('Последняя активность') }}</th>
                        <th scope="col">{{ ('Действия') }}</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($data as $user)
                        <tr>
                            <th scope="row"> {{ $user->id }} </th>
                            <td> {{ $user->name }} </td>
                            <td> {{ $user->role }} </td>
                            <td> {{ $user->updated_at }} </td>
                            <td> @include('inc.icons') </td>
                        </tr>    
                    @endforeach 

                </tbody>
            </table>

            @can('create-users')
                <button type="button" class="btn btn-outline-primary user_add_button"
                onclick="
                    display_block('user_add_form', 'user_add_button');">
                    <i class="bi bi-plus-circle"></i><span class="m-1">{{ __('Добавить сотрудника') }}</span>
                </button>
                <button type="button" class="btn btn-outline-danger d-none user_add_form" 
                onclick="
                    display_block('user_add_button', 'user_add_form');
                    rm_class('create', 'is-invalid'); 
                    clear_class('errors-create');"
                data-toggle="tooltip" title="Отмена">
                    <i class="bi bi-x-lg"></i>
                </button>
                <button type="button" class="btn btn-outline-success d-none user_add_form" 
                onclick="
                    rm_class('create', 'is-invalid'); 
                    clear_class('errors-create');
                    display_block('spinner-border', 'none'); 
                    ajax('user_add_form', 'users/create', 'create-');"
                data-toggle="tooltip" title="Добавить">
                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true" ></span>
                    <i class="bi bi-check-lg"></i>
                </button>

                <form method="POST" class="row my-3 d-none user_add_form" id="user_add_form">
                    @csrf
                    <div class="col-3">
                        <input name="login" id="create-login" type="text" class="form-control create" placeholder="Логин" required>
                        <x-print-errors action="create" field="login"></x-print-errors>
                    </div>
                    <div class="col-3">
                        <input name="email" id="create-email" type="email" class="form-control create" 
                        placeholder="E-mail" required>
                        <x-print-errors action="create" field="email"></x-print-errors>
                    </div>
                    <div class="col-3">
                        <input name="name" id="create-name" type="text" class="form-control create" placeholder="ФИО" required>
                        <x-print-errors action="create" field="name"></x-print-errors>
                    </div>
                    <div class="col-3">
                        <select name="role" id="create-role" class="form-select create">
                            <option value="0">Тест</option>
                        </select>
                        <x-print-errors action="create" field="role"></x-print-errors>
                    </div>
                </form>
            @endcan
        </div>
    </div>
</div>
@can('edit-users')
    <!-- MODAL edit -->
    <div class="modal fade" id="editUsers" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Редактирование</h5>
                    <button type="button" class="close" aria-label="Close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="user_edit_form">
                        @csrf
                        <input name="id" id="edit-id" type="hidden" value="">
                        <div class="mb-3">
                            <label for="data-bs-login" class="col-form-label">Логин:</label>
                            <input type="text" class="form-control edit" id="edit-login" name="login">
                            <x-print-errors action="edit" field="login"></x-print-errors>
                        </div>
                        <div class="mb-3">
                            <label for="data-bs-email" class="col-form-label">Email:</label>
                            <input type="text" class="form-control edit" id="edit-email" name="email">
                            <x-print-errors action="edit" field="email"></x-print-errors>
                        </div>
                        <div class="mb-3">
                            <label for="data-bs-name" class="col-form-label">ФИО:</label>
                            <input type="text" class="form-control edit" id="edit-name" name="name">
                            <x-print-errors action="edit" field="name"></x-print-errors>
                        </div>
                        <div class="mb-3">
                            <label for="data-bs-role" class="col-form-label">Должность:</label>
                            <select name="role" id="edit-role" class="form-select edit" name="role">
                                <option value="0">Тест</option>
                                <option value="1">Тест1</option>
                            </select>
                            <x-print-errors action="edit" field="role"></x-print-errors>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" 
                    onclick="rm_class('edit', 'is-invalid'); clear_class('errors-edit');">Закрыть</button>
                    <button type="button" class="btn btn-primary" onclick="rm_class('edit', 'is-invalid');
                    clear_class('errors-edit'); 
                    ajax('user_edit_form', 'users/edit', 'edit-'); 
                    //document.getElementById('user_edit_form').submit();">Сохранить</button>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
  var editUserModal = document.getElementById('editUsers');
  editUserModal.addEventListener('show.bs.modal', function (event) {
  var button = event.relatedTarget;
  set_value_modal(editUserModal, button, 'data-bs-login', 'edit-login');
  set_value_modal(editUserModal, button, 'data-bs-email', 'edit-email');
  set_value_modal(editUserModal, button, 'data-bs-name', 'edit-name');
  set_value_modal(editUserModal, button, 'data-bs-role', 'edit-role');
  set_value_modal(editUserModal, button, 'data-bs-id', 'edit-id');
})
</script>
@endcan

@can('delete-users')
<!-- MODAL delete -->
<div class="modal fade" id="deleteUsers" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Удаление</h5>
                <button type="button" class="close" aria-label="Close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="user_delete_form">
                    @csrf
                    <input name="id" id="delete-id" type="hidden" value="">
                    <div class="mb-3">
                        Для запрета доступа пользователю в систему, достаточно его заблокировать. Крайне не рекомендуется удалять пользователей. Делайте это только в том случае, если сотрудник  загружал мало документов в систему. При удалении пользователя будет невозможно отследить историю его действий и загруженных документов. Вы уверены, что хотите удалить пользователя?
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-danger" onclick=" 
                ajax('user_delete_form', 'users/delete', 'delete-'); ">Удалить</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  var deleteUserModal = document.getElementById('deleteUsers');
  deleteUserModal.addEventListener('show.bs.modal', function (event) {
  var button = event.relatedTarget;
  set_value_modal(deleteUserModal, button, 'data-bs-id', 'delete-id');
})
</script>
@endcan

@endsection
