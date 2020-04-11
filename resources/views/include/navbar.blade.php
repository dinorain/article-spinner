<nav class="navbar navbar-expand-lg bg-white fixed-top">
    @if (Auth::check())
        <a class="navbar-brand" href="{{ route('admin.index') }}">{{ config('app.name', 'SPINTAX') }}</a>
    @else
        <a class="navbar-brand" href="/">{{ config('app.name', 'SPINTAX') }}</a>
    @endif
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>
