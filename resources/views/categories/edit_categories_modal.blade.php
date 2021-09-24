<!-- MODAL edit -->
    <div class="modal fade" id="editCategories" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Редактирование категории</h5>
                    <button type="button" class="close" aria-label="Close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="category_edit_form">
                        @csrf
                        <input name="id" id="edit-id" type="hidden" value="">
                        <div class="mb-3">
                            <label for="data-bs-title" class="col-form-label">Название:</label>
                            <input type="text" class="form-control edit" id="edit-title" name="title">
                            <x-print-errors action="edit" field="title"></x-print-errors>
                        </div>
                        <div class="mb-3">
                            <label for="data-bs-category" class="col-form-label">Родительская категория:</label>
                            <select id="edit-category" class="form-select edit" name="category">
                                <option value="null" selected>Корневой каталог</option>
                                @foreach ($allCategories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @include('inc.optionCategories', ['category' => $category])
                                @endforeach
                            </select>
                            <x-print-errors action="edit" field="category"></x-print-errors>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" onclick="rm_class('edit', 'is-invalid');
                    clear_class('errors-edit'); 
                    ajax('category_edit_form', 'categories/edit', 'edit-');">Сохранить</button>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    var editCategoriesModal = document.getElementById('editCategories');
    editCategoriesModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        set_value_modal(editCategoriesModal, button, 'data-bs-name', 'edit-title');
        set_value_modal(editCategoriesModal, button, 'data-bs-parent', 'edit-category');
        set_value_modal(editCategoriesModal, button, 'data-bs-id', 'edit-id');
        set_placeholder(button, 'data-bs-name', 'edit-title');
        var category = button.getAttribute('data-bs-id');
        disabled_children_categories('edit-category', category);
    })
    editCategoriesModal.addEventListener('hide.bs.modal', function (event) {
        rm_class('edit', 'is-invalid');
        clear_class('errors-edit');
        enabled_add_children_categories('edit-category');
    })
</script>