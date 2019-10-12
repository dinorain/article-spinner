@extends('layouts.app')

@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                {{$title}}
            </div>
            @if(count($services)>0)
                <ul>
                    @foreach($services as $service)
                        <li>{{$service}} </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection
