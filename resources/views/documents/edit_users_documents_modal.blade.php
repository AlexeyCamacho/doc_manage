<!-- MODAL edit -->
    <div class="modal fade" id="editUserDocuments" tabindex="-1" aria-labelledby="editUserDocumentsLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserDocumentsLabel">Назначение ответственных</h5>
                    <button type="button" class="close" aria-label="Close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="documents_users_edit_form">
                        @csrf
                        <input name="id" id="edit_users_documents-id" type="hidden" value="">
                        <div class="mb-3">
                            <div><label for="data-bs-category" class="col-form-label">Список ответственных:</label></div>
                            <select id="edit_users_documents-users" class="form-select edit_users_documents" name="users[]" multiple>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                            </select>
                            <x-print-errors action="edit_users_documents" field="users"></x-print-errors>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" onclick="rm_class('edit_users_documents', 'is-invalid');
                    clear_class('errors-edit_users_documents'); 
                    ajax('documents_users_edit_form', '/doc_manage/documents/responsible', 'edit_users_documents-');">Сохранить</button>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    var select_users = new vanillaSelectBox('#edit_users_documents-users', {"translations": { "all": "Все", "items": "предметы","selectAll":"Выбрать все","clearAll":"Очистить все"}});

    var editUserDocumentsModal = document.getElementById('editUserDocuments');
    editUserDocumentsModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        set_value_modal(editUserDocumentsModal, button, 'data-bs-id', 'edit_users_documents-id');
        var list_users = JSON.parse(button.getAttribute('data-bs-users'));
        var users = [];
        for (var i = list_users.length-1; i >= 0 ; i--) {
            users.push(String(list_users[i]['id']));
        }
        select_users.setValue(users);
    })
    editUserDocumentsModal.addEventListener('hide.bs.modal', function (event) {
        rm_class('edit_users_documents', 'is-invalid');
        clear_class('errors-edit_users_documents');
    })

</script>