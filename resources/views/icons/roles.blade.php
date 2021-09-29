<div class="btn-group">
    @can('edit-users')
        <a role="button" class="btn btn-outline-secondary" href="{{ route('edit-role') }}/{{$role->id}}" data-hint="true" data-placement="top" title="Редактировать">
            <i class="bi bi-pencil" data-hint="true" data-placement="top" title="Редактировать"></i>
        </a>
        <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteRoles" data-hint="true" data-placement="top" title="Удалить" data-bs-name="{{ $role->name }}" data-bs-id="{{ $role->id }}">
            <i class="bi bi-trash" data-hint="true" data-placement="top" title="Удалить"></i>
        </button>
    @endcan
</div>