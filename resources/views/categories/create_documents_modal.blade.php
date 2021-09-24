<!-- MODAL create -->
    <div class="modal fade" id="createDocuments" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Создание документа</h5>
                    <button type="button" class="close" aria-label="Close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="document_create_form" enctype="multipart/form-data">
                        @csrf
                        <input name="id_category" id="create-id_category" type="hidden" value="">
                        <div class="mb-3">
                            <label for="data-bs-title" class="col-form-label">Название:</label>
                            <input type="text" class="form-control create" id="create-title" name="title">
                            <x-print-errors action="create" field="title"></x-print-errors>
                        </div>
                        <div class="mb-3">
                            <label for="create-description" class="form-label">Описание:</label>
                            <textarea class="form-control" id="create-description" rows="2" name="description"></textarea>
                            <x-print-errors action="create" field="description"></x-print-errors>
                        </div>
                        <div class="mb-3">
                            <label for="create-deadline" class="col-form-label">Дедлайн:</label>
                            <input type="date" class="form-control create" id="create-deadline" name="deadline" min="{{ date('Y-m-d') }}">
                            <x-print-errors action="create" field="deadline"></x-print-errors>
                            <small class="text-muted">Оставьте пустым, если дедлайн неопределен.</small>
                        </div>
                        @can('loading-documents')
                        <div class="mb-3">
                            <input class="form-control" type="file" id="create-document_file" name="document_file">
                            <x-print-errors action="create" field="document_file"></x-print-errors>
                            <small class="text-muted">Загрузите файл, если он есть.</small>
                        </div>
                        <div class="d-none" id="file_true">
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="create-document_ready" name="document_ready" checked>
                                <label class="form-check-label" for="flexSwitchCheckDefault">Документ завершен</label>
                            </div>
                            <div class="d-none" id="document_not_ready">
                                <div class="mb-3">
                                    <label for="create-deadline_position" class="col-form-label">Дедлайн:</label>
                                    <input type="date" class="form-control create" id="create-deadline_position" name="deadline_position" min="{{ date('Y-m-d') }}">
                                    <x-print-errors action="create" field="deadline_position"></x-print-errors>
                                    <small class="text-muted">Оставьте пустым, если дедлайн файла совпадает с дедлайном документа.</small>
                                </div>
                                <div class="mb-3">
                                    <label for="data-bs-title" class="col-form-label">Статус:</label>
                                    <select class="form-select create" id="create-status" name="status">
                                        <option value="null" selected>Новый статус</option>
                                        @include('inc.option', ['objects' => $statuses, 'id' => 'id', 'name' => 'name', 'childrens' => 'statuses'])
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control create" id="create-new_status" name="new_status">
                                    <x-print-errors action="create" field="new_status"></x-print-errors>
                                    <small class="text-muted">Если нужно, установите новый статус. Он будет принадлежать категории, которую вы выбрали выше.</small>
                                </div>
                            </div>
                        </div>
                        @endcan
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" onclick="rm_class('create', 'is-invalid');
                    clear_class('errors-create'); 
                    ajax('document_create_form', 'documents/create', 'create-');">Создать</button>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    document.getElementById('create-document_file').addEventListener('change', function(){
        if( this.value ){
            show_elem_by_id('file_true');
        } else { 
            hide_elem_by_id('file_true');
        } 
    });

    document.getElementById('create-document_ready').addEventListener('change', function(){
        if( this.checked ){
            hide_elem_by_id('document_not_ready');
        } else { 
            show_elem_by_id('document_not_ready');
        } 
    });

    var createDocumentsModal = document.getElementById('createDocuments');

    createDocumentsModal.addEventListener('hide.bs.modal', function (event) {
        rm_class('create', 'is-invalid');
        clear_class('errors-create');
        reset_form_by_id('document_create_form');
    });

    document.getElementById('create-deadline').addEventListener('change', function(){
        var deadline = document.getElementById('create-deadline').value;
        document.getElementById('create-deadline_position').max = deadline;
    });

</script>