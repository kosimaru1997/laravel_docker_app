@extends('layouts.app')

@section('content')

<div class="row m-0">
    <div class="col-12">
        <div class="d-flex">
            <h2 class="ml-2">- Your Site Note -</h2>
            <a href="{{ route('site_new') }}">
                <i class="fas fa-plus-circle fa-2x mt-1 ml-3"></i>
            </a>
        </div>
    <div class="d-flex flex-wrap">
        @foreach($sites as $site)
        <li class="list-unstyled card-list my-4">
            <div class="card mx-auto" style="width: 95%;">
            <img src="{{ $site->image }}" alt="画像がありません" class="border-bottom card-image">
            <div class="card-body p-2">
              {{-- <div class="d-flex py-1 mb-1">
                @if(empty($site->))
                  <% site.tags.each do |tag| %>
                  <div class="border border-secondary rounded px-2 me-2"><%= tag.tag_name %></div>
                  <% end %>
                <% else %>
                  <div class="border border-secondary rounded px-2 me-2">No Tags</div>
                <% end %>
              </div> --}}
              <a href="{{ $site->url }}" target="_blank" rel="noopener noreferrer">
              <h5 class="card-title">{{ $site->title }}</h5></a>
              @if(!empty($site->note))
                <p class="card-text text-dark text-break mb-1">
                    {{ $site->note }}
                </p>
              @endif
                <div class="text-right mt-3">
                    <object>
                        <a href="site/{{$site->id}}" class="text-primary mr-3">詳細</a>
                    </object>
                    <object>
                        <a href="/site/{{$site->id}}/edit" class="text-info mr-3">編集</a>
                    </object>
                </div>
            </div>
          </li>
        @endforeach
    </div>
</div>
</div>
@endsection
