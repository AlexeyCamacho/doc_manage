<div class="btn-group">
@if(Route::is('users'))
    @if($user->blocked == 0)
        @can('edit-users')
        <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#editUsers"
        data-bs-login="{{ $user->login }}" data-bs-email="{{ $user->email }}" data-bs-name="{{ $user->name }}"data-bs-role="{{ $user->role }}" data-bs-id="{{ $user->id }}" data-placement="top" title="Редактировать">
            <i class="bi bi-pencil" data-toggle="tooltip" data-placement="top" title="Редактировать"></i>
        </button>
        @endcan
        @can('blocked-users')
        <button type="button" class="btn btn-outline-secondary" onclick="block_unblock_user({{ $user->id }}, '{{ csrf_token() }}');" data-toggle="tooltip" data-placement="top" title="Заблокировать">
            <i class="bi bi-lock" data-toggle="tooltip" data-placement="top" title="Заблокировать"></i>
        </button>
        @endcan
    @else
        @can('blocked-users')
        <button type="button" class="btn btn-outline-secondary" onclick="block_unblock_user({{ $user->id }}, '{{ csrf_token() }}');" data-toggle="tooltip" data-placement="top" title="Разблокировать">
            <i class="bi bi-unlock" data-toggle="tooltip" data-placement="top" title="Разблокировать"></i>
        </button>
        @endcan
        @can('delete-users')
        <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteUsers"
        data-placement="top" title="Удалить" data-bs-id="{{ $user->id }}">
            <i class="bi bi-trash" data-toggle="tooltip" data-placement="top" title="Удалить"></i>
        </button>
        @endcan
    @endif
@endif
</div>