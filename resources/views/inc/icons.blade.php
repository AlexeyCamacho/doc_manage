@if(Route::is('users'))
<div class="btn-group">
    @if($user->blocked == 0)
        <button type="button" class="btn btn-outline-secondary">
            <i class="bi bi-pencil"></i>
        </button>
        <button type="button" class="btn btn-outline-secondary" onclick="block_unblock_user({{ $user->id }}, '{{ csrf_token() }}');">
            <i class="bi bi-lock"></i>
        </button>
    @else
        <button type="button" class="btn btn-outline-secondary" onclick="block_unblock_user({{ $user->id }}, '{{ csrf_token() }}');">
            <i class="bi bi-unlock"></i>
        </button>
        <button type="button" class="btn btn-outline-danger">
            <i class="bi bi-trash"></i>
        </button>
    @endif
</div>
@endif