@if(Route::is('users'))
<div class="btn-group">
    @if($user->blocked == 0)
        <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#editUsers"
        data-bs-login="{{ $user->login }}" data-bs-email="{{ $user->email }}" data-bs-name="{{ $user->name }}" data-bs-role="{{ $user->role }}" data-bs-id="{{ $user->id }}" data-placement="top" title="Редактировать">
            <i class="bi bi-pencil" data-toggle="tooltip" data-placement="top" title="Редактировать"></i>
        </button>
        <button type="button" class="btn btn-outline-secondary" onclick="block_unblock_user({{ $user->id }}, '{{ csrf_token() }}');" data-toggle="tooltip" data-placement="top" title="Заблокировать">
            <i class="bi bi-lock" data-toggle="tooltip" data-placement="top" title="Заблокировать"></i>
        </button>
    @else
        <button type="button" class="btn btn-outline-secondary" onclick="block_unblock_user({{ $user->id }}, '{{ csrf_token() }}');" data-toggle="tooltip" data-placement="top" title="Разблокировать">
            <i class="bi bi-unlock" data-toggle="tooltip" data-placement="top" title="Разблокировать"></i>
        </button>
        <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteUsers"
        data-placement="top" title="Удалить" data-bs-id="{{ $user->id }}">
            <i class="bi bi-trash" data-toggle="tooltip" data-placement="top" title="Удалить"></i>
        </button>
    @endif
</div>
@endif