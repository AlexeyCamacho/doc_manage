<!-- MODAL edit -->
    <div class="modal fade" id="editStatuses" tabindex="-1" aria-labelledby="editStatusesLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editStatusesLabel">Редактирование статуса</h5>
                    <button type="button" class="close" aria-label="Close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="status_edit_form">
                        @csrf
                        <input name="id" id="edit-id" type="hidden" value="">
                        <x-print-errors action="edit" field="id"></x-print-errors>
                        <div class="mb-3">
                            <label for="data-bs-title" class="col-form-label">Название:</label>
                            <input type="text" class="form-control edit" id="edit-title" name="title">
                            <x-print-errors action="edit" field="title"></x-print-errors>
                        </div>
                        <div class="mb-3">
                            <label for="data-bs-status" class="col-form-label">Связанный статус:</label>
                            <select id="edit-status" class="form-select edit" name="status">
                                <option value="null" selected>/</option>
                                @include('inc.option', ['objects' => $statusesOption, 'id' => 'id', 'name' => 'name', 'childrens' => 'statuses'])
                            </select>
                            <x-print-errors action="edit" field="status"></x-print-errors>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" onclick="rm_class('edit', 'is-invalid');
                    clear_class('errors-edit');
                    ajax('status_edit_form', 'statuses/edit', 'edit-');">Сохранить</button>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    var editStatusesModal = document.getElementById('editStatuses');
    editStatusesModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        set_value_modal(editStatusesModal, button, 'data-bs-name', 'edit-title');
        set_value_modal(editStatusesModal, button, 'data-bs-parent', 'edit-status');
        set_value_modal(editStatusesModal, button, 'data-bs-id', 'edit-id');
        set_placeholder(button, 'data-bs-name', 'edit-title');
        var json = JSON.parse(button.getAttribute('data-bs-statuses'));
        statuses = search_all_keys(json, 'id', 'children_statuses', 'statuses');
        disabled_options('edit-status', statuses);
    })
    editStatusesModal.addEventListener('hide.bs.modal', function (event) {
        rm_class('edit', 'is-invalid');
        clear_class('errors-edit');
        enabled_options('edit-status');
    })
</script>
