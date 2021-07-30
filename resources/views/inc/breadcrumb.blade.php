<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
    @foreach ($breadcrumbs as $breadcrumb)
        @if ($loop->last)
            <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb->get('name') }}</li>
        @else
            <li class="breadcrumb-item"><a href="{{ $breadcrumb->get('href') }}">{{ $breadcrumb->get('name') }}</a></li>
        @endif
    @endforeach
    </ol>
</nav>