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
                            <label for="data-bs-category" class="col-form-label">Список ответственных:</label>
                            @foreach ($users as $user)
                            <div class="form-check">
                                <input class="form-check-input user_" type="checkbox" value="" user_id="{{$user->id}}">
                                <label class="form-check-label" for="user_{{$user->id}}">
                                {{ $user->name }}
                              </label>
                            </div>
                            @endforeach
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
    var editUserDocumentsModal = document.getElementById('editUserDocuments');
    editUserDocumentsModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        set_value_modal(editUserDocumentsModal, button, 'data-bs-id', 'edit_users_documents-id');
        var list_class = JSON.parse(button.getAttribute('data-bs-users'));
        var users = [];
        for (var i = list_class.length-1; i >= 0 ; i--) {
            users.push(list_class[i]['id']);
        }

        set_array('user_', users, 'user_id');
    })
    editUserDocumentsModal.addEventListener('hide.bs.modal', function (event) {
        rm_class('edit_users_documents', 'is-invalid');
        clear_class('errors-edit_users_documents');
        clear_checked('user_');
    })
</script>