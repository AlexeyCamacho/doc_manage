@if(( Gate::allows('edit-documents') || Gate::allows('delete-documents')))
  <ul class="dropdown-menu no-min-width" aria-labelledby="dropdownMenuDocument">
    @can('edit-documents')
    <li>
        <button class="dropdown-item" type="button" data-toggle="modal" data-target="#editPositions" data-hint="true" data-placement="right" title="Редактировать">
            <i class="bi bi-pencil" data-hint="true" data-placement="right" title="Редактировать"></i>
        </button>
    </li>
    @endcan

    @can('delete-documents')
    <li>
        <button class="dropdown-item" type="button" data-toggle="modal" data-target="#deletePositions" data-hint="true" data-placement="right" title="Удалить">
            <i class="bi bi-trash" data-hint="true" data-placement="right" title="Удалить"></i>
        </button>
    </li>
    @endcan
  </ul>
@endif