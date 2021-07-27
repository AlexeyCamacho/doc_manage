@if (session('editMode'))
<div class="dropdown">
<button class="btn" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-expanded="false" data-reference="#accordionMain"> 
    <i class="bi bi-gear"></i> 
</button>
  <ul class="dropdown-menu no-min-width" aria-labelledby="dropdownMenu2">
    <li>
        <button class="dropdown-item" type="button" onclick="view_block_add_category('{{$category->id}}');">
            <i class="bi bi-plus-circle" data-toggle="tooltip" data-placement="right" title="Добавить категорию"></i>
        </button>
    </li>
    <li>
        <button class="dropdown-item" type="button">
            <i class="bi bi-pencil" data-toggle="tooltip" data-placement="right" title="Редактировать"></i>
        </button>
    </li>
    <li>
        <button class="dropdown-item" type="button">
            <i class="bi bi-trash" data-toggle="tooltip" data-placement="right" title="Удалить"></i>
        </button>
    </li>
  </ul>
</div>
@endif