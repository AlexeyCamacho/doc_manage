@extends('layouts.base')

@section('title', 'Категории')

@section('content')
<div class="container-fluid border shadow bg-white rounded p-3">
    <div class="row justify-content-center">
        <div class="col-lg-4">
            <h1 class="pl-3 mb-4">{{ ('Категории') }}
                <button class="btn btn-outline-secondary btn-sm ml-4 mb-2" type="button"
                data-toggle="tooltip" data-placement="right" title="Закрыть все категории" onclick="session_reset('openCategories'); 
                location.reload();">
                    <i class="bi bi-arrow-clockwise" data-toggle="tooltip" data-placement="right" title="Закрыть все категории"></i>
                </button>
            </h1>
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
                                <button class="btn btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne{{$category->id}}" 
                                aria-expanded="@if ($openCategories->contains($category->id)) true @else false @endif" 
                                aria-controls="collapseOne{{$category->id}}">
                                    @if ($category->childrenCategories->count())
                                        @if ($openCategories->contains($category->id)) 
                                            <i class="bi bi-chevron-up"></i> 
                                        @else 
                                            <i class="bi bi-chevron-down"></i> 
                                        @endif
                                    @endif
                                </button>
                            </div>
                        </h2>    
                    </div>
                    <div id="collapseOne{{$category->id}}" 
                        class="collapse collapse-main @if ($openCategories->contains($category->id)) show @endif"
                        aria-labelledby="headingOne{{$category->id}}">
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
            <h1 class="pl-4 mb-4">{{ ('Список документов') }}</h1>
            СПИСОК ДОКУМЕНТОВ
        </div>
    </div>
</div>

<script type="text/javascript">
    
var collapses = document.getElementsByClassName('collapse-main');
for (var i = collapses.length-1; i >= 0 ; i--) {

    collapses[i].addEventListener('hide.bs.collapse', function (event) { 
        var card = event.target.parentElement;
        var icon = card.getElementsByTagName('i')[0];
        if(icon.classList.contains('bi-chevron-up')) { icon.classList.remove('bi-chevron-up'); }
        icon.classList.add('bi-chevron-down');

        var id = card.getAttribute('data-id');
        session_delete_array('openCategories', id);

    });

    collapses[i].addEventListener('show.bs.collapse', function (event) { 
        var card = event.target.parentElement;
        var icon = card.getElementsByTagName('i')[0];
        if(icon.classList.contains('bi-chevron-down')) { icon.classList.remove('bi-chevron-down'); }
        icon.classList.add('bi-chevron-up');

        var id = card.getAttribute('data-id');
        session_set_array('openCategories', id);
    });

}


</script>
@endsection