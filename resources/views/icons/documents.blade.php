@if(session('editMode') && ( Gate::allows('edit-documents') || Gate::allows('delete-documents')))
<div class="dropdown text-center">
<button class="btn" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-expanded="false"> 
    <i class="bi bi-gear"></i> 
</button>
  <ul class="dropdown-menu no-min-width" aria-labelledby="dropdownMenu3">
    @can('edit-documents')
    @if (!$document->completed)
    <li>
        <button class="dropdown-item" type="button" data-bs-name="{{ $document->name }}" data-toggle="modal" data-target="#editDocuments" data-bs-id="{{ $document->id }}" data-bs-parent="{{ $document->category_id }}" data-bs-description="{{ $document->description }}" data-bs-deadline="{{ $document->deadline }}" data-bs-max_deadline="{{ max($document->files->max('deadline'), date('Y-m-d')) }}" data-hint="true" data-placement="right" title="Редактировать">
            <i class="bi bi-pencil" data-hint="true" data-placement="right" title="Редактировать"></i>
        </button>
    </li>
    @else
    <li>
        <button class="dropdown-item" type="button" data-hint="true" data-placement="right" title="Активировать" onclick="api_get('/documents/active', {{ $document->id }}); location.reload();">
            <i class="bi bi-journal-arrow-up" data-hint="true" data-placement="right" title="Активировать"></i>
        </button>
    </li>
    @endif
    @endcan
    @can('delete-documents')
    <li>
        <button class="dropdown-item" type="button" data-bs-name="" data-toggle="modal" data-target="#deleteDocuments" data-bs-id="" data-bs-parent="" data-bs-archive="22" data-hint="true" data-placement="right" title="Удалить">
            <i class="bi bi-trash" data-hint="true" data-placement="right" title="Удалить"></i>
        </button>
    </li>
    @endcan
  </ul>
</div>
@endif