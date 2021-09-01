@extends('layouts.app')
@section('javascript')
<script src="/js/confirm.js" defer></script>
@endsection

@section('content')
<div class="row pb-3 m-0 border-bottom">
    <div class="col-md-4">
        <img src={{$site->image}} class="site-show-image rounded w-90">
        </div>
        <div class="col-md-8">
        <a href="{{$site->url}}" target="_blank" rel="noopener noreferrer">
            <h5 class="card-title">{{$site->title}}</h5>
        </a>
        <h4>{{$site->description}}</h4>
    </div>
</div>

<div class="row mt-2 mb-4 mx-2">
    {{-- <div class="border rounded d-flex py-1 px-2 mb-2">
    <h5 class="mb-1 me-2">tags: </h5>
        <div class="border border-secondary rounded px-2 me-2">php</div>
        <div class="border border-secondary rounded px-2 me-2">laravel</div>
    </div> --}}
    <div class="note w-100 border rounded py-2 px-2">
    <div class="d-flex note-link pe-3">
        <h3 class="fw-bold" style="font-family: sans-serif;">-Note-</h3>
    </div>
        <h4 casss="px-2">
            @if(!empty($site->note))
            {{ $site->note }}
            @else
            No Contents
            @endif
        </h4>
    </div>
</div>

<div class="d-flex justify-content-end">
    <a class="mr-4" href="/site/{{$site->id}}/edit">
        <i class="far fa-edit fa-2x mt-1 cursor-p"></i>
    </a>
    <form class="cursor-p mr-2" id="delete-form" action="{{ route('site_destroy', $site->id) }}" method="post">
        @csrf
        <a><i class="fas fa-trash fa-2x text-secondary mt-1 mr-3 cursor-p" onclick="deleteHandle(event);"></i></a>
    </form>
</div>
@endsection
