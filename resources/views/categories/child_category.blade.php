<div class="accordion">
    <div class="card card-dropdowns" data-id="{{$category->id}}" id="accordoinCard{{$category->id}}">
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
        <div id="collapseOne{{$category->id}}" 
        class="collapse @if ($openCategories->contains($category->id)) show @endif" 
        aria-labelledby="headingOne{{$category->id}}">
            <div class="card-body">
                @include('inc.hidden_accordion', ['category_id' => $category->id])
                @if ($category->categories)
                @foreach ($category->categories as $category)
                @include('categories.child_category', ['category' => $category])
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
