@extends('layouts.base')

@section('title', 'Категории')

@section('content')
<div class="container-fluid border shadow bg-white rounded p-3">
    <div class="row justify-content-center">
        <div class="col-lg-4">
            <h1>{{ ('Категории') }}
                <button class="btn btn-outline-secondary btn-sm ml-4 mb-2" type="button"
                data-toggle="tooltip" data-placement="right" title="Закрыть все категории" onclick="session_reset('openCategories'); 
                location.reload();">
                    <i class="bi bi-arrow-clockwise" data-toggle="tooltip" data-placement="right" title="Закрыть все категории"></i>
                </button>
            </h1>
            <div class="accordion mt-4" id="accordionMain">
                @foreach ($categories as $category)
                <div class="card card-dropdowns" id="accordoinCard{{$category->id}}" data-id="{{$category->id}}">
                    <div class="card-header" id="heading{{$category->id}}">
                        <h2 class="row mb-0">
                            <div class="col">
                                <button class="btn btn-block text-left" type="button">
                                    {{ $category->name }}
                                </button>
                            </div>
                            @if (session('editMode'))
                            <div class="col-3">
                            @else
                            <div class="col-2">
                            @endif
                                <div class="btn-group">
                                    @include('icons.categories')
                                    @if ($category->categories->count())
                                    <button class="btn" type="button" data-toggle="collapse" data-target="#collapseOne{{$category->id}}" 
                                    aria-expanded="@if ($openCategories->contains($category->id)) true @else false @endif" 
                                    aria-controls="collapseOne{{$category->id}}">
                                        @if ($openCategories->contains($category->id)) 
                                            <i class="bi bi-chevron-up"></i> 
                                        @else 
                                            <i class="bi bi-chevron-down"></i> 
                                        @endif
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </h2>    
                    </div>
                    <div id="collapseOne{{$category->id}}" class="collapse collapse-main @if ($openCategories->contains($category->id)) show @endif" aria-labelledby="headingOne{{$category->id}}">
                        <div class="card-body">
                            @can('create-categories')
                            @include('inc.hidden_accordion', ['category_id' => $category->id])
                            @endcan
                            @foreach ($category->categoriesOrderName as $category)
                            @include('categories.child_category', ['category' => $category])
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @can('create-categories')
            @include('inc.hidden_accordion', ['category_id' => 0])
            @if (session('editMode'))
            <div class="d-flex flex-row-reverse mt-4">
                <button type="button" class="btn btn-outline-secondary" data-toggle="tooltip" data-placement="right" title="Добавить категорию" onclick="view_block_add_category(0);"><i class="bi bi-plus-circle" data-toggle="tooltip" data-placement="right" title="Добавить категорию"></i></button>
            </div>  
            @endif
            @endcan
        </div>
        <div class="col-lg-8">
            <h1 class="pl-4 mb-4">{{ ('Список документов') }}</h1>
            СПИСОК ДОКУМЕНТОВ
        </div>
    </div>
</div>

@can('edit-categories')
    <!-- MODAL edit -->
    <div class="modal fade" id="editCategories" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Редактирование категории</h5>
                    <button type="button" class="close" aria-label="Close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="category_edit_form" method="POST" action="categories/edit">
                        @csrf
                        <input name="id" id="edit-id" type="hidden" value="">
                        <div class="mb-3">
                            <label for="data-bs-title" class="col-form-label">Название:</label>
                            <input type="text" class="form-control edit" id="edit-title" name="title">
                            <x-print-errors action="edit" field="title"></x-print-errors>
                        </div>
                        <div class="mb-3">
                            <label for="data-bs-category" class="col-form-label">Родительская категория:</label>
                            <select id="edit-category" class="form-select edit" name="category">
                                <option value="null" selected>Корневой каталог</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @include('inc.optionCategories', ['category' => $category])
                                @endforeach
                            </select>
                            <x-print-errors action="edit" field="category"></x-print-errors>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" onclick="rm_class('edit', 'is-invalid');
                    clear_class('errors-edit'); 
                    ajax('category_edit_form', 'categories/edit', 'edit-');">Сохранить</button>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    var editCategoriesModal = document.getElementById('editCategories');
    editCategoriesModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        set_value_modal(editCategoriesModal, button, 'data-bs-name', 'edit-title');
        set_value_modal(editCategoriesModal, button, 'data-bs-parent', 'edit-category');
        set_value_modal(editCategoriesModal, button, 'data-bs-id', 'edit-id');
        set_placeholder(button, 'data-bs-name', 'edit-title');
        var category = button.getAttribute('data-bs-id');
        disabled_children_categories('edit-category', category);
    })
    editCategoriesModal.addEventListener('hide.bs.modal', function (event) {
        rm_class('edit', 'is-invalid');
        clear_class('errors-edit');
    })
</script>
@endcan

<script src="{{ asset('js/categories.js') }}"></script>
@endsection