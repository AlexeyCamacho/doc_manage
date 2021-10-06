<!-- MODAL delete -->
    <div class="modal fade" id="deleteDocuments" tabindex="-1" aria-labelledby="DeleteDocumentsLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="DeleteDocumentsLabel">Удаление документа</h5>
                    <button type="button" class="close" aria-label="Close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="documents_delete_form">
                        @csrf
                        <input name="id" id="delete_documents-id" type="hidden" value="">
                        <div class="mb-3">
                            Вы собираетесь удалить документ. Все файлы будут удалены с сервера. После этого действия, восстановить документ будет невозможно. Вы уверены, что хотите удалить документ <span id="delete_documents-name" class="font-weight-bold"></span>?
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-danger" onclick="rm_class('delete_documents', 'is-invalid');
                    clear_class('errors-delete'); 
                    ajax('documents_delete_form', '/doc_manage/documents/delete', 'delete_documents-', 'categories');">Удалить</button>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    var deleteDocumentsModal = document.getElementById('deleteDocuments');
    deleteDocumentsModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        set_value_modal(deleteDocumentsModal, button, 'data-bs-id', 'delete_documents-id');
        set_value_div(button, 'data-bs-name', 'delete_documents-name');
    })
</script>