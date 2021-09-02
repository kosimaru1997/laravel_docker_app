@extends('layouts.app')
@section('javascript')
<script src="/js/confirm.js" defer></script>
@endsection

@section('content')

<div class="row m-0">
    <div class="col-12">
        <div class="d-flex">
            <h2 class="ml-2">- Your Site Note -</h2>
            <a href="{{ route('site_new') }}">
                <i class="fas fa-plus-circle fa-2x mt-1 ml-3"></i>
            </a>
        </div>
        <div class="search mr-2">
        <form class="form-inline justify-content-end d-flex" action="{{route('search')}}" accept-charset="UTF-8" method="get">
                <select class="mb-2 mr-2" name="option" id="option">
                    <option value="mix">mix</option>
                    <option value="title">title</option>
                    <option value="note">note</option></select>
                <select class="mb-2 mr-2" name="sort" id="sort">
                    <option value="new">new</option>
                    <option value="old">old</option></select>
                <select class="mb-2 mr-2" name="tags" id="tags">
                    <option value="">tags</option>
                    @foreach($tags as $tag)
                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                    @endforeach
                </select>
                <input class="form-control pr-3 mb-2 mr-2" placeholder="検索" type="search" name="word" id="word">
                <input type="submit" value="検索" class="media-none btn btn-outline-secondary mb-2" data-disable-with="検索">
            </form>
        </div>
        <div class="d-flex py-1 ms-4 mb-1">
            @foreach($tags as $tag)
            <div class="border border-secondary rounded px-2 mr-3">
              <a class="tag-link" href="/sites/?tag={{$tag['id']}}">{{$tag->name}}</a>
            </div>
            @endforeach
        </div>
    <div class="d-flex flex-wrap">
        @foreach($sites as $site)
        <li class="list-unstyled card-list my-4">
            <div class="card mx-auto" style="width: 95%;">
            <img src="{{ $site->image }}" alt="画像がありません" class="border-bottom card-image">
            <div class="card-body p-2">
              <div class="d-flex py-1 mb-1">
                @if(!empty($site->tags[0]))
                  @foreach($site->tags as $tag)
                    <div class="border border-secondary rounded px-2 mr-2">
                      {{ $tag->name }}
                    </div>
                  @endforeach
                @else
                  <div class="border border-secondary rounded px-2 mr-2">
                      No Tags
                </div>
                @endif
              </div>
              <a href="{{ $site->url }}" target="_blank" rel="noopener noreferrer">
              <h5 class="card-title">{{ $site->title }}</h5></a>
              @if(!empty($site->note))
                <p class="card-text text-dark text-break mb-1">
                    {{ $site->note }}
                </p>
              @endif
                <div class="d-flex justify-content-end mt-3">
                    <a href="site/{{$site->id}}" class="text-primary mr-4">
                        <i class="fas fa-info-circle fa-lg"></i>
                    </a>
                    <a href="/site/{{$site->id}}/edit" class="mr-2">
                        <i class="far fa-edit fa-lg mt-1 cursor-p"></i>
                    </a>
                </div>
            </div>
          </li>
        @endforeach
    </div>
</div>
</div>
@endsection
