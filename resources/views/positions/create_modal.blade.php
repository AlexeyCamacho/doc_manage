<!-- MODAL create -->
    <div class="modal fade" id="createPositons" tabindex="-1" aria-labelledby="createPositonsLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="мLabel">Добавление файла</h5>
                    <button type="button" class="close" aria-label="Close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="positions_create_form" enctype="multipart/form-data">
                        @csrf
                        <input name="id" id="create_positions-id" type="hidden" value="">
                        <div class="mb-3">
                            <input class="form-control" type="file" id="create_positions-file" name="file">
                            <x-print-errors action="create_positions" field="file"></x-print-errors>
                        </div>
                        <div class="d-none" id="file_true">
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="create_positions-document_ready" name="document_ready">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Документ завершен</label>
                            </div>
                            <div class="mb-3">
                                <label for="create_positions-deadline" class="col-form-label">Дедлайн:</label>
                                <input type="date" class="form-control create_positions" id="create_positions-deadline" name="deadline" min="{{ date('Y-m-d') }}">
                                <x-print-errors action="create_positions" field="deadline"></x-print-errors>
                                <small class="text-muted">Оставьте пустым, если дедлайн неопределен.</small>
                            </div>
                            <div class="mb-3">
                                <label for="data-bs-title" class="col-form-label">Статус:</label>
                                <select class="form-select create_positions" id="create_positions-status" name="status">
                                    <option value="" selected>Новый статус</option>
                                    @include('inc.option', ['objects' => $statuses, 'id' => 'id', 'name' => 'name', 'childrens' => 'statuses'])
                                </select>
                                <x-print-errors action="create_positions" field="status"></x-print-errors>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control create_positions" id="create_positions-new_status" name="new_status">
                                <x-print-errors action="create_positions" field="new_status"></x-print-errors>
                                <small class="text-muted">Если нужно, установите новый статус. Он будет наследовать статус, которую вы выбрали выше.</small>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" onclick="rm_class('create_positions', 'is-invalid');
                    clear_class('errors-create_positions');
                    ajax('positions_create_form', '/doc_manage/files/create', 'create_positions-');">Создать</button>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    document.getElementById('create_positions-file').addEventListener('change', function(){
        if( this.value ){
            show_elem_by_id('file_true');
        } else { 
            hide_elem_by_id('file_true');
        } 
    });

    var createPositonsModal = document.getElementById('createPositons');

    createPositonsModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        set_value_modal(createPositonsModal, button, 'data-bs-id', 'create_positions-id');
        var deadline = button.getAttribute('data-bs-deadline');
        set_value_attribute_tag_by_id(deadline, 'create_positions-deadline', 'max');
    })

    createPositonsModal.addEventListener('hide.bs.modal', function (event) {
        rm_class('create_positions', 'is-invalid');
        clear_class('errors-create_positions');
        reset_form_by_id('positions_create_form');
    });

</script>