<div class="btn-group">
    @can('edit-users')
        <button role="button" class="btn btn-outline-secondary"
        data-hint="true" data-placement="top" title="Редактировать"
        onclick="show_edit_form('{{ $tag->id }}', '{{ $tag->name }}');">
            <i class="bi bi-pencil" data-hint="true" data-placement="top" title="Редактировать"></i>
        </button>
        <button type="button" class="btn btn-outline-danger"
        data-hint="true" data-placement="top" title="Удалить"
        data-bs-name="{{ $tag->name }}"
        data-bs-id="{{ $tag->id }}"
        data-toggle="modal" data-target="#deleteTags">
            <i class="bi bi-trash" data-hint="true" data-placement="top" title="Удалить"></i>
        </button>
    @endcan
</div>
