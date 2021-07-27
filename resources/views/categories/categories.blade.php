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
                            @include('inc.hidden_accordion', ['category_id' => $category->id])
                            @foreach ($category->categories as $category)
                            @include('categories.child_category', ['category' => $category])
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @include('inc.hidden_accordion', ['category_id' => 0])
            @if (session('editMode'))
            <div class="d-flex flex-row-reverse mt-4">
                <button type="button" class="btn btn-outline-secondary" data-toggle="tooltip" data-placement="right" title="Добавить категорию" onclick="view_block_add_category(0);"><i class="bi bi-plus-circle" data-toggle="tooltip" data-placement="right" title="Добавить категорию"></i></button>
            </div>  
            @endif
        </div>
        <div class="col-lg-8">
            <h1 class="pl-4 mb-4">{{ ('Список документов') }}</h1>
            СПИСОК ДОКУМЕНТОВ
        </div>
    </div>
</div>

<script src="{{ asset('js/categories.js') }}"></script>
@endsection