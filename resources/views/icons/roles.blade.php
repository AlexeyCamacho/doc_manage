<div class="btn-group">
    @can('edit-users')
        <button type="button" class="btn btn-outline-secondary" data-toggle="tooltip" data-placement="top" title="Редактировать">
            <i class="bi bi-pencil" data-toggle="tooltip" data-placement="top" title="Редактировать"></i>
        </button>
        <button type="button" class="btn btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Удалить">
            <i class="bi bi-trash" data-toggle="tooltip" data-placement="top" title="Удалить"></i>
        </button>
    @endcan
</div>