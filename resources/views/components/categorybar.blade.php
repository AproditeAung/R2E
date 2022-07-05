<div class="container  position-sticky sticky-top">
    <div class="nav-scroller bg-transparent text-white p-3   py-1 mb-2">
        <nav class="nav d-flex justify-content-between">
            @foreach($categories as $c)
                <a class="p-2 link-secondary" href="{{ url('allblogs/?select='.$c->id) }}">{{ $c->name }}</a>
            @endforeach
        </nav>
    </div>
</div>
