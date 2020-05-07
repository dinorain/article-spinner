<div class="footer">
    <div class="container-fluid">
        <a class="footer-brand" href="/">{{ config('app.name', 'ARCSPIN') }}</a>
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                Copyright © {{ Carbon\Carbon::now()->format('Y') }} Dustin Jourdan.
                All rights reserved.
                @if (Auth::check())
                    Dashboard by <a href="https://colorlib.com/wp/">Colorlib</a>.
                @endif
            </div>

            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="text-md-right footer-links d-none d-sm-block">
                    <a href={{ route('about') }}>About</a>
                    <a href={{ route('contact') }}>Contact</a>
                </div>
            </div>
        </div>
    </div>
</div>
