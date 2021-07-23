@extends('layouts.base')

@section('title', 'Категории')

@section('content')
<div class="container-fluid border shadow bg-white rounded p-3">
    <div class="row justify-content-center">
        <h1 class="pl-4 mb-4">{{ ('Категории') }}</h1>
        <div class="col-lg-4">
            <div class="accordion" id="accordionMain">
                @foreach ($categories as $category)
                <div class="card" data-id="{{$category->id}}">
                    <div class="card-header" id="heading{{$category->id}}">
                        <h2 class="row mb-0">
                            <div class="col-10">
                                <button class="btn btn-block text-left" type="button">
                                    {{ $category->name }}
                                </button>
                            </div>
                            <div class="col-2 col-offset-2">
                                <button class="btn btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne{{$category->id}}" aria-expanded="false" aria-controls="collapseOne{{$category->id}}">
                                    @if ($category->childrenCategories->count())
                                    <i class="bi bi-chevron-down"></i>
                                    @endif
                                </button>
                            </div>
                        </h2>    
                    </div>
                    <div id="collapseOne{{$category->id}}" class="collapse collapse-main" aria-labelledby="headingOne{{$category->id}}">
                        <div class="card-body">
                            @foreach ($category->childrenCategories as $childCategory)
                            @include('categories.child_category', ['child_category' => $childCategory])
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-lg-8">
            СПИСОК ДОКУМЕНТОВ
        </div>
    </div>
</div>

<form id="ajax-form">
    @csrf
</form>

<script type="text/javascript">
    
var collapses = document.getElementsByClassName('collapse-main');
for (var i = collapses.length-1; i >= 0 ; i--) {

    collapses[i].addEventListener('hide.bs.collapse', function (event) { 
        var card = event.target.parentElement;
        var icon = card.getElementsByTagName('i')[0];
        if(icon.classList.contains('bi-chevron-right')) { icon.classList.remove('bi-chevron-right'); }
        icon.classList.add('bi-chevron-down');

    });

    collapses[i].addEventListener('show.bs.collapse', function (event) { 
        var card = event.target.parentElement;
        var icon = card.getElementsByTagName('i')[0];
        if(icon.classList.contains('bi-chevron-down')) { icon.classList.remove('bi-chevron-down'); }
        icon.classList.add('bi-chevron-right');

        var id = card.getAttribute('data-id');
        session_set('openCategories', id, true);
    });

}


</script>
@endsection