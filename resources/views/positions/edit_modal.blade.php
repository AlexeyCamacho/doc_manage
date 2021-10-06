<!-- MODAL create -->
    <div class="modal fade" id="editPositions" tabindex="-1" aria-labelledby="editPositonsLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPositonsLabel">Редактирования позиции</h5>
                    <button type="button" class="close" aria-label="Close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="positions_edit_form">
                        @csrf
                        <input name="id" id="edit_positions-id" type="hidden" value="">
                        <div class="mb-3">
                            <label for="edit_positions-deadline" class="col-form-label">Дедлайн:</label>
                            <input type="date" class="form-control edit_positions" id="edit_positions-deadline" name="deadline" min="{{ date('Y-m-d') }}">
                            <x-print-errors action="edit_positions" field="deadline"></x-print-errors>
                        </div>
                        <div class="mb-3">
                            <label for="data-bs-title" class="col-form-label">Статус:</label>
                            <select class="form-select edit_positions" id="edit_positions-status" name="status">
                                <option value="" selected>Новый статус</option>
                                @include('inc.option', ['objects' => $statuses, 'id' => 'id', 'name' => 'name', 'childrens' => 'statuses'])
                            </select>
                            <x-print-errors action="edit_positions" field="status"></x-print-errors>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control edit_positions" id="edit_positions-new_status" name="new_status">
                            <x-print-errors action="edit_positions" field="new_status"></x-print-errors>
                            <small class="text-muted">Если нужно, установите новый статус. Он будет наследовать статус, которую вы выбрали выше.</small>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" onclick="rm_class('edit_positions', 'is-invalid');
                    clear_class('errors-edit_positions');
                    ajax('positions_edit_form', '/doc_manage/files/edit', 'edit_positions-');">Создать</button>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    var editPositonsModal = document.getElementById('editPositions');

    editPositonsModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        set_value_modal(editPositonsModal, button, 'data-bs-id', 'edit_positions-id');
        set_value_modal(editPositonsModal, button, 'data-bs-status', 'edit_positions-status');
        set_value_modal(editPositonsModal, button, 'data-bs-deadline', 'edit_positions-deadline');
        var deadline = button.getAttribute('data-bs-deadline_doc');
        set_value_attribute_tag_by_id(deadline, 'edit_positions-deadline', 'max');
    })

    editPositonsModal.addEventListener('hide.bs.modal', function (event) {
        rm_class('edit_positions', 'is-invalid');
        clear_class('errors-edit_positions');
        reset_form_by_id('positions_edit_form');
    });

</script>