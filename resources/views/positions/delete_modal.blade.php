<!-- MODAL delete -->
    <div class="modal fade" id="deletePositions" tabindex="-1" aria-labelledby="DeletePositionsLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="DeletePositionsLabel">Удаление позиции</h5>
                    <button type="button" class="close" aria-label="Close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="positions_delete_form">
                        @csrf
                        <input name="id" id="delete_positions-id" type="hidden" value="">
                        <div class="mb-3">
                            Вы собираетесь удалить позицию. Файл будет удалён с сервера. После этого действия восстановить его будет невозможно. Вы уверены, что хотите удалить позицию?
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-danger" onclick="rm_class('delete_positions', 'is-invalid');
                    clear_class('errors-delete'); 
                    ajax('positions_delete_form', '/doc_manage/files/delete', 'delete_positions-');">Удалить</button>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    var deletePositionsModal = document.getElementById('deletePositions');
    deletePositionsModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        set_value_modal(deletePositionsModal, button, 'data-bs-id', 'delete_positions-id');
    })
</script>