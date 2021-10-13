<div class="btn-group">
    @can('management-statuses')
        <button role="button" class="btn btn-outline-secondary"
        data-hint="true" data-placement="top" title="Редактировать"
        data-bs-name="{{ $status->name }}"
        data-bs-id="{{ $status->id }}"
        data-bs-parent="{{ $status->status_id }}"
        data-bs-statuses="{{ $status->statuses()->with('childrenStatuses')->select('id')->get(); }}"
        data-toggle="modal" data-target="#editStatuses">
            <i class="bi bi-pencil" data-hint="true" data-placement="top" title="Редактировать"></i>
        </button>
        <button type="button" class="btn btn-outline-danger"
        data-hint="true" data-placement="top" title="Удалить"
        data-bs-name="{{ $status->name }}"
        data-bs-id="{{ $status->id }}"
        data-toggle="modal" data-target="#deleteStatuses">
            <i class="bi bi-trash" data-hint="true" data-placement="top" title="Удалить"></i>
        </button>
    @endcan
</div>
