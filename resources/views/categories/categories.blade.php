@extends('layouts.base')

@section('title', 'Категории')

@section('content')
<div class="container-fluid border shadow bg-white rounded p-3">
    <div class="row">
        <div class="col-lg-3 mb-3">
            <h1>{{ ('Категории') }}
                <button class="btn btn-outline-secondary btn-sm ml-4 mb-2" type="button"
                data-toggle="tooltip" data-placement="right" title="Закрыть все категории" onclick="session_reset('openCategories'); session_reset('select_category');
                location.reload();">
                    <i class="bi bi-arrow-clockwise" data-toggle="tooltip" data-placement="right" title="Закрыть все категории"></i>
                </button>
            </h1>
            
            @if (Route::current()->parameter('id'))
                @include('inc.breadcrumb', ['breadcrumbs' => $breadcrumbs])
            @endif
            <div class="accordion mt-4" id="accordionMain">
                @foreach ($categories as $category)
                    @include('categories.child_category', ['category' => $category])
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
        <div class="col-lg-9">
            <div id="documents">
                <div class="row">
                    <div class="col">
                        <h1 class="pl-4 mb-4">{{ ('Список документов') }}</h1>
                    </div>
                </div>
                <h4>Нажмите на категорию для показа документов</h4>
            </div>
        </div>
    </div>
</div>

<!-- Модальные окна -->

@can('edit-categories')
    @include('categories.edit_categories_modal')
@endcan

@can('delete-categories')
    @include('categories.delete_categories_modal')
@endcan

@can('create-documents')
    @include('categories.create_documents_modal')
@endcan

@can('edit-documents')
    @include('categories.edit_documents_modal')
@endcan

<script>    
    var close_child_tabs = {!! json_encode($close_child_tabs) !!};
</script>

<script src="{{ asset('js/categories.js') }}"></script>

@endsection


@section('running_scripts')

<script type="text/javascript">

var select_category = {!! json_encode($select_category) !!};
if(select_category) { select_documents(select_category); choice_cart(select_category); }

</script>

@endsection