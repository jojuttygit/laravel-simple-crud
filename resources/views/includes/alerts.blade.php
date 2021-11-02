@if (session('success'))
    <div class="alert alert-success mt-5" role="alert">
        {{ session('message') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-error mt-5" role="alert">
        {{ session('error') }}
    </div>
@endif