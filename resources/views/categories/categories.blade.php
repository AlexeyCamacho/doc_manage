@extends('layouts.base')

@section('title', 'Категории')

@section('content')
<div class="container-fluid border shadow bg-white rounded p-3">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1>{{ ('Категории') }}</h1>

            <div class="accordion mt-4" id="accordionMain">
                @foreach ($categories as $category)
                <div class="card">
                    <div class="card-header" id="heading{{$category->id}}">
                        <h2 class="mb-0">
                            <button class="btn btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne{{$category->id}}" aria-expanded="false" aria-controls="collapseOne{{$category->id}}">
                                {{ $category->name }}
                            </button>
                        </h2>    
                    </div>
                    <div id="collapseOne{{$category->id}}" class="collapse" aria-labelledby="headingOne{{$category->id}}" data-parent="#accordionMain">
                        <div class="card-body pl-4">
                            @foreach ($category->childrenCategories as $childCategory)
                            @include('categories.child_category', ['child_category' => $childCategory])
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</div>
@endsection