<!-- MODAL delete -->
    <div class="modal fade" id="deleteCategories" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Удаление категории</h5>
                    <button type="button" class="close" aria-label="Close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="category_delete_form">
                        @csrf
                        <input name="id" id="delete-id" type="hidden" value="">
                        <x-print-errors action="delete" field="id"></x-print-errors>
                        <div class="mb-3">
                            Вы собираетесь удалить категорию. После этого действия, восстановить категорию будет невозможно. Все дочерние категории и документы будут перенесены в другие категории.  Вы уверены, что хотите удалить категорию <span id="delete-name" class="font-weight-bold"></span>?
                        </div>
                        <div class="mb-3">
                            <label for="data-bs-category" class="col-form-label">Переместить дочернии категории в</label>
                            <select id="delete-category" class="form-select delete" name="category">
                                <option value="null" selected>Корневой каталог</option>
                                @foreach ($allCategories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @include('inc.optionCategories', ['category' => $category])
                                @endforeach
                            </select>
                            <x-print-errors action="delete" field="category"></x-print-errors>
                        </div>
                        <div class="mb-3">
                            <label for="data-bs-category" class="col-form-label">Переместить документы в</label>
                            <select id="delete-doc-category" class="form-select delete" name="doc_category">
                                @foreach ($allCategories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @include('inc.optionCategories', ['category' => $category])
                                @endforeach
                            </select>
                            <x-print-errors action="delete" field="category"></x-print-errors>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-danger" onclick="rm_class('delete', 'is-invalid');
                    clear_class('errors-delete');
                    ajax('category_delete_form', 'categories/delete', 'delete-');">Удалить</button>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    var deleteCategoriesModal = document.getElementById('deleteCategories');
    deleteCategoriesModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        set_value_modal(deleteCategoriesModal, button, 'data-bs-id', 'delete-id');
        set_value_modal(deleteCategoriesModal, button, 'data-bs-archive', 'delete-category');
        set_value_modal(deleteCategoriesModal, button, 'data-bs-archive', 'delete-doc-category');
        set_value_div(button, 'data-bs-name', 'delete-name');
        var category = button.getAttribute('data-bs-id');
        disabled_children_categories('delete-category', category);
        disabled_category('delete-doc-category', category);
    })
    deleteCategoriesModal.addEventListener('hide.bs.modal', function (event) {
        enabled_options('delete-category');
        enabled_options('delete-doc-category');
    })
</script>
