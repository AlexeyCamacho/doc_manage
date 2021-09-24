@if (!$loop) 

@foreach ($objects as $object)
    <option value="{{ $object->$id }}">{{ $object->$name }}</option>
    @include('inc.option', ['objects' => $object, 'id' => $id, 'name' => $name, 'childrens' => $childrens])
@endforeach

@else

@foreach ($objects->$childrens as $object)
    <option value="{{ $object->$id }}">
        @for ($i = 1; $i < $loop->depth; $i++)
            -@endfor>{{ $object->$name }}</option>
    @include('inc.option', ['objects' => $object, 'id' => $id, 'name' => $name, 'childrens' => $childrens])
@endforeach

@endif