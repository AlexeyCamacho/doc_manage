<!-- MODAL delete -->
<div class="modal fade" id="deleteTags" tabindex="-1" aria-labelledby="deleteTagsLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteTagsLabel">Удаление тега</h5>
                <button type="button" class="close" aria-label="Close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="tag_delete_form">
                    @csrf
                    <input name="id" id="delete-id" type="hidden" value="">
                    <div class="mb-3">
                        Вы собираетесь удалить тег <span id="delete-name" class="font-weight-bold"></span> . У всех документов, которым был присвоен тег, он сбросится. Вы уверены, что хотите это сделать?
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-danger" onclick="
                ajax('tag_delete_form', 'tags/delete', 'delete-'); ">Удалить</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var deleteTagModal = document.getElementById('deleteTags');
    deleteTagModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        set_value_modal(deleteTagModal, button, 'data-bs-id', 'delete-id');
        set_value_div(button, 'data-bs-name', 'delete-name');
    })
</script>
