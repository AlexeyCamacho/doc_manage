@if ($object)

@if ($object->$parent)
    @include('inc.parents', ['object' => $object->$parent, 'name' => $name, 'parent' => $parent])
@endif

{{ $object->$name }}

@endif
