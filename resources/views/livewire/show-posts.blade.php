<div class="row">
    <input class="form-control mb-3" type="text" wire:model="search" placeholder="Search" aria-label="search">
    @foreach ($posts as $post)
@endforeach
@if ($posts->count() == 0)
    <div class="alert alert-danger" role="alert">
        Data not found!
    </div>
@endif
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
</div>
