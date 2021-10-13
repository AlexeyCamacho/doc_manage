<!-- MODAL delete -->
<div class="modal fade" id="deleteStatuses" tabindex="-1" aria-labelledby="deleteStatusesLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteStatusesLabel">Удаление статуса</h5>
                <button type="button" class="close" aria-label="Close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="status_delete_form">
                    @csrf
                    <input name="id" id="delete-id" type="hidden" value="">
                    <div class="mb-3">
                        Вы собираетесь удалить статус <span id="delete-name" class="font-weight-bold"></span> . У всех файлов, которым был присвоен статус, он сбросится. Вы уверены, что хотите это сделать?
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-danger" onclick="
                ajax('status_delete_form', 'statuses/delete', 'delete-'); ">Удалить</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var deleteStatusModal = document.getElementById('deleteStatuses');
    deleteStatusModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        set_value_modal(deleteStatusModal, button, 'data-bs-id', 'delete-id');
        set_value_div(button, 'data-bs-name', 'delete-name');
    })
</script>
