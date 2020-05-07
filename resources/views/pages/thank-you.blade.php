@extends('layouts.app-main')

@section('content')
<div class="container" style="text-align: center">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-4">
            <i class="fas fa-thumbs-up mb-4 mt-4" style="font-size: 4rem;"></i>
            <h1>Thank you{{ $name ? ', '.$name : ''}}!</h1>
            <h3>Your message is much appreciated.</h3>
        </div>
    </div>
    <a href="{{ route('welcome') }}" class="btn btn-primary">Go back to ARCSPIN</a>
</div>
@endsection
