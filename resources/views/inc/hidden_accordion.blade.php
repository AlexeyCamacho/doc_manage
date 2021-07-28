<div class="accordion accordion-add-category d-none" id="add-category{{ $category_id }}">
    <div class="card card-dropdowns" id="accordoinCard">
        <div class="card-header" id="heading">
            <h2 class="row mb-0 mt-2">
                <form method="post" action="categories/create" class="row add-category" id="form-add-category{{ $category_id }}">
                    @csrf
                    @if($category_id != 0)
                    <input type="hidden" name="category_id" value="{{ $category_id }}">
                    @endif
                    <div class="col">
                        <input type="text" name="name" class="form-control create-name" required>
                    </div>
                    <div class="col-3">
                        <div class="btn-group mb-2">
                            <button type="subbmit" class="btn btn-outline-success">
                                <i class="bi bi-check-lg"></i>
                            </button>
                            <button type="button" class="btn btn-outline-danger" onclick="
                            reset_form_by_id('form-add-category{{ $category_id }}');
                            hide_elem_by_id('add-category{{ $category_id }}');">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </h2>    
        </div>
    </div>
</div>