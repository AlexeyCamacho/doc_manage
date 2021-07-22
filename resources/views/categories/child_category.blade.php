<div class="accordion" id="accordion{{$child_category->parent_id}}">
    <div class="card">
        <div class="card-header" id="heading{{$child_category->id}}">
            <h2 class="mb-0">
                <button class="btn btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne{{$child_category->id}}" aria-expanded="false" aria-controls="collapseOne{{$child_category->id}}">
                    {{ $child_category->name }}
                </button>
            </h2>    
        </div>
        <div id="collapseOne{{$child_category->id}}" class="collapse" aria-labelledby="headingOne{{$child_category->id}}" data-parent="#accordion{{$child_category->parent_id}}">
            <div class="card-body">
                @if ($child_category->categories)
                @foreach ($child_category->categories as $childCategory)
                @include('child_category', ['child_category' => $childCategory])
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
