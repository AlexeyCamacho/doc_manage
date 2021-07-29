@foreach ($category->categoriesOrderNameAll as $category)
    <option value="{{ $category->id }}">
        @for ($i = 1; $i < $loop->depth; $i++)
            -@endfor>{{ $category->name }}</option>
    @include('inc.optionCategories', ['category' => $category])
@endforeach