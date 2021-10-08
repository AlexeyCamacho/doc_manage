@if(( Gate::allows('edit-documents') || Gate::allows('delete-documents')))
    <ul class="dropdown-menu no-min-width" aria-labelledby="dropdownMenuDocument">
        @can('edit-documents')
            @if (!$document->completed)
                <li>
                    <button class="dropdown-item" type="button"
                    data-hint="true" data-placement="right" title="Завершить документ"
                    onclick="api_get('/documents/complete', {{ $document->id }}); location.reload();">
                    <i class="bi bi-file-earmark-check" data-hint="true" data-placement="right" title="Завершить документ"></i>
                </button>
            </li>
            @if (($document->users->contains(Auth::id())) || Gate::allows('edit-users-documents'))
                <li>
                    <button class="dropdown-item" type="button"
                    data-toggle="modal" data-target="#editUserDocuments"
                    data-bs-id="{{ $document->id }}"
                    data-bs-users="{{ $document->users()->select('id')->get(); }}"
                    data-hint="true" data-placement="right" title="Назначить ответственных">
                    <i class="bi bi-person-plus" data-hint="true" data-placement="right" title="Назначить ответственных"></i>
                </button>
            </li>
        @endif
        <li>
            <button class="dropdown-item" type="button"
            data-toggle="modal" data-target="#editDocuments"
            data-bs-name="{{ $document->name }}"
            data-bs-id="{{ $document->id }}"
            data-bs-parent="{{ $document->category_id }}"
            data-bs-description="{{ $document->description }}"
            data-bs-deadline="{{ $document->deadline }}"
            data-bs-tags="{{ $document->tags()->select('id')->get(); }}"
            data-bs-max_deadline="{{ max($document->files->max('deadline'), date('Y-m-d')) }}"
            data-hint="true" data-placement="right" title="Редактировать">
            <i class="bi bi-pencil" data-hint="true" data-placement="right" title="Редактировать"></i>
        </button>
    </li>
@else
    <li>
        <button class="dropdown-item" type="button"
        data-hint="true" data-placement="right" title="Активировать"
        onclick="api_get('/documents/active', {{ $document->id }}); location.reload();">
        <i class="bi bi-journal-arrow-up" data-hint="true" data-placement="right" title="Активировать"></i>
    </button>
</li>
@endif
@endcan

@can('delete-documents')
    @if (!$document->completed || Gate::allows('actions-completed-documents'))
        <li>
            <button class="dropdown-item" type="button"
            data-toggle="modal" data-target="#deleteDocuments"
            data-bs-id="{{ $document->id }}"
            data-bs-name="{{ $document->name }}"
            data-hint="true" data-placement="right" title="Удалить">
            <i class="bi bi-trash" data-hint="true" data-placement="right" title="Удалить"></i>
        </button>
    </li>
@endif
@endcan
</ul>
@endif
