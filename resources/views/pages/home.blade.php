@extends('layouts.app')

@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="jumbotron text-center">
                <div class="title m-b-md">
                    {{$title}}
                </div>
                <p>
                    <a class="btn btn-primary btn-lg" href="/login" roles="button">Login<a>
                    <a class="btn btn-success btn-lg" href="/sign-up" roles="button">Sign up<a>
                </p>
            </div>
        </div>
    </div>
@endsection
