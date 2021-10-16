<!-- MODAL edit -->
    <div class="modal fade" id="editDocuments" tabindex="-1" aria-labelledby="editDocumentsLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDocumentsLabel">Редактирование документа</h5>
                    <button type="button" class="close" aria-label="Close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="documents_edit_form">
                        @csrf
                        <input name="id" id="edit_documents-id" type="hidden" value="">
                        <div class="mb-3">
                            <label for="data-bs-title" class="col-form-label">Название:</label>
                            <input type="text" class="form-control edit_documents" id="edit_documents-title" name="title">
                            <x-print-errors action="edit_documents" field="title"></x-print-errors>
                        </div>
                        <div class="mb-3">
                            <label for="data-bs-title" class="col-form-label">Описание:</label>
                            <textarea class="form-control edit_documents" id="edit_documents-description" rows="2" name="description"></textarea>
                            <x-print-errors action="edit_documents" field="description"></x-print-errors>
                        </div>
                        <div class="mb-3">
                            <label for="data-bs-category" class="col-form-label">Категория:</label>
                            <select id="edit_documents-category" class="form-select edit_documents" name="category">
                                @include('inc.option', ['objects' => $allCategories, 'id' => 'id', 'name' => 'name', 'childrens' => 'categories'])
                            </select>
                            <x-print-errors action="edit_documents" field="category"></x-print-errors>
                        </div>
                        <div class="mb-3">
                            <label for="edit_documents-deadline" class="col-form-label">Дедлайн:</label>
                            <input type="date" class="form-control edit_documents" id="edit_documents-deadline" name="deadline" min="{{ date('Y-m-d') }}">
                            <x-print-errors action="edit_documents" field="deadline"></x-print-errors>
                        </div>
                        <div class="mb-3">
                            <div><label for="edit_documents-tags" class="col-form-label">Тэги:</label></div>
                            <select class="form-select edit_documents" id="edit_documents-tags" name="tags[]" multiple>
                                @foreach ($tags as $tag)
                                    <option value="{{$tag->id}}">{{$tag->name}}</option>
                                @endforeach
                            </select>
                            <x-print-errors action="edit_documents" field="tags"></x-print-errors>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" onclick="rm_class('edit_documents', 'is-invalid');
                    clear_class('errors-edit_documents');
                    ajax('documents_edit_form', '/doc_manage/documents/edit', 'edit_documents-');">Сохранить</button>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    var editDocumentsModal = document.getElementById('editDocuments');
    editDocumentsModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        set_value_modal(editDocumentsModal, button, 'data-bs-name', 'edit_documents-title');
        set_value_modal(editDocumentsModal, button, 'data-bs-parent', 'edit_documents-category');
        set_value_modal(editDocumentsModal, button, 'data-bs-id', 'edit_documents-id');
        set_value_modal(editDocumentsModal, button, 'data-bs-description', 'edit_documents-description');
        set_value_modal(editDocumentsModal, button, 'data-bs-deadline', 'edit_documents-deadline');
        set_placeholder(button, 'data-bs-name', 'edit_documents-title');
        var max_deadline = button.getAttribute('data-bs-max_deadline');
        set_value_attribute_tag_by_id(max_deadline, 'edit_documents-deadline', 'min');
        tags = set_value_multiSelect(button, 'data-bs-tags', 'id');
        select_tags.setValue(tags);
    })
    editDocumentsModal.addEventListener('hide.bs.modal', function (event) {
        rm_class('edit_documents', 'is-invalid');
        clear_class('errors-edit_documents');
    })

    select_tags = new vanillaSelectBox('#edit_documents-tags', {"translations": { "all": "Все", "items": "предметы","selectAll":"Выбрать все","clearAll":"Очистить все"}});
</script>
