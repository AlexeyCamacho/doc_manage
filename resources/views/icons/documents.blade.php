@if(session('editMode') && ( Gate::allows('edit-documents') || Gate::allows('delete-documents')))
<div class="dropdown text-center">
<button class="btn" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-expanded="false" data-reference="#accordionMain"> 
    <i class="bi bi-gear"></i> 
</button>
  <ul class="dropdown-menu no-min-width" aria-labelledby="dropdownMenu2">
    @can('edit-documents')
    <li>
        <button class="dropdown-item" type="button" data-bs-name="" data-toggle="modal" data-target="#editCategories" data-bs-id="" data-bs-parent="" data-placement="right" title="Редактировать">
            <i class="bi bi-pencil" data-toggle="tooltip" data-placement="right" title="Редактировать"></i>
        </button>
    </li>
    @endcan
    @can('delete-documents')
    <li>
        <button class="dropdown-item" type="button" data-bs-name="" data-toggle="modal" data-target="#deleteCategories" data-bs-id="" data-bs-parent="" data-bs-archive="22" data-placement="right" title="Удалить">
            <i class="bi bi-trash" data-toggle="tooltip" data-placement="right" title="Удалить"></i>
        </button>
    </li>
    @endcan
  </ul>
</div>
@endif