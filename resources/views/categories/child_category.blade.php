<div class="accordion" id="accordion{{$child_category->parent_id}}">
    <div class="card" data-id="{{$child_category->id}}">
        <div class="card-header" id="heading{{$child_category->id}}">
            <h2 class="row mb-0">
                <div class="col-10">
                    <button class="btn btn-block text-left" type="button">
                        {{ $child_category->name }}
                    </button>
                </div>
                <div class="col-2">
                    <button class="btn btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne{{$child_category->id}}" 
                    aria-expanded="@if ($openCategories->contains($child_category->id)) true @else false @endif"
                    aria-controls="collapseOne{{$child_category->id}}">
                        @if ($child_category->categories->count())
                            @if ($openCategories->contains($child_category->id)) 
                                <i class="bi bi-chevron-up"></i> 
                            @else 
                                <i class="bi bi-chevron-down"></i> 
                            @endif
                        @endif
                    </button>
                </div>
            </h2>    
        </div>
        <div id="collapseOne{{$child_category->id}}" 
        class="collapse @if ($openCategories->contains($child_category->id)) show @endif" 
        aria-labelledby="headingOne{{$child_category->id}}">
            <div class="card-body">
                @if ($child_category->categories)
                @foreach ($child_category->categories as $childCategory)
                @include('categories.child_category', ['child_category' => $childCategory])
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
