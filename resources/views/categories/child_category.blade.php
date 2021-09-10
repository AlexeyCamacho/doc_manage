<div class="card card-dropdowns" data-id="{{$category->id}}" id="accordoinCard{{$category->id}}">
    <div class="card-header" id="heading{{$category->id}}">
        <h2 class="row mb-0">
            <div class="col">
                <button class="btn btn-block text-left" type="button" ondblclick="document.location.href = '/doc_manage/categories/{{$category->id}}';">
                    {{ $category->name }}
                    @if(!$category->visible)
                        <i class="bi bi-eye-slash"></i>
                    @endif
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
                    <button class="btn" type="button" data-toggle="collapse" data-target="#collapse{{$category->id}}" 
                    aria-expanded="@if ($openCategories->contains($category->id)) true @else false @endif" 
                    aria-controls="collapse{{$category->id}}" onclick="//close_all_collapse({{$category->id}})";>
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
    <div id="collapse{{$category->id}}" 
    class="collapse collapse-main @if ($openCategories->contains($category->id)) show @endif" 
    aria-labelledby="headingOne{{$category->id}}">
        <div class="card-body">
            @can('create-categories')
            @include('inc.hidden_accordion', ['category_id' => $category->id])
            @endcan
            @if (session('editMode'))
                @foreach ($category->categoriesOrderNameAll as $category)
                    @include('categories.child_category', ['category' => $category])
                @endforeach
            @else
                @foreach ($category->categoriesOrderNameVisible as $category)
                    @include('categories.child_category', ['category' => $category])
                @endforeach
            @endif
        </div>
    </div>
</div>