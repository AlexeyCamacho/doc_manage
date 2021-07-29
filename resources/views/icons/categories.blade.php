@if(session('editMode') && ( Gate::allows('create-categories') || Gate::allows('edit-categories') || Gate::allows('delete-categories')))
<div class="dropdown">
<button class="btn" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-expanded="false" data-reference="#accordionMain"> 
    <i class="bi bi-gear"></i> 
</button>
  <ul class="dropdown-menu no-min-width" aria-labelledby="dropdownMenu2">
    @can('create-categories')
    <li>
        <button class="dropdown-item" type="button" onclick="view_block_add_category({{$category->id}});" data-toggle="tooltip" data-placement="right" title="Добавить категорию">
            <i class="bi bi-plus-circle" data-toggle="tooltip" data-placement="right" title="Добавить категорию"></i>
        </button>
    </li>
    @endcan
    @can('edit-categories')
    <li>
        <button class="dropdown-item" type="button" data-bs-name="{{ $category->name }}" data-toggle="modal" data-target="#editCategories" data-bs-id="{{ $category->id }}" data-bs-parent="{{ $category->category_id }}" data-placement="right" title="Редактировать">
            <i class="bi bi-pencil" data-toggle="tooltip" data-placement="right" title="Редактировать"></i>
        </button>
    </li>
    @endcan
    @can('visible-categories')
    @if($category->visible)
        <li>
            <button class="dropdown-item" type="button" onclick="hide_category({{$category->id}}); location.reload();" data-toggle="tooltip" data-placement="right" title="Скрыть">
            <i class="bi bi-eye-slash" data-toggle="tooltip" data-placement="right" title="Скрыть"></i>
            </button>
        </li>
    @else
        <li>
            <button class="dropdown-item" type="button" onclick="view_category({{$category->id}}); location.reload();" data-toggle="tooltip" data-placement="right" title="Показать">
            <i class="bi bi-eye" data-toggle="tooltip" data-placement="right" title="Показать"></i>
            </button>
        </li>
    @endif
    @endcan
    @can('delete-categories')
    <li>
        <button class="dropdown-item" type="button" data-bs-name="{{ $category->name }}" data-toggle="modal" data-target="#deleteCategories" data-bs-id="{{ $category->id }}" data-bs-parent="{{ $category->category_id }}" data-bs-archive="22" data-placement="right" title="Удалить">
            <i class="bi bi-trash" data-toggle="tooltip" data-placement="right" title="Удалить"></i>
        </button>
    </li>
    @endcan
  </ul>
</div>
@endif