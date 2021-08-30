@extends('layouts.app')

@section('content')
<div class="row m-0">
    <div class="col-12">
    <h2 class="ml-2">- Your Site Note -</h2>
    <div>
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
                {{-- <p type="button" class="text-center mb-0" data-bs-toggle="modal" data-bs-target="#noteModal_<%= site.id %>">
                  <i class="fas fa-sort-down fa-2x w-50"></i>
                </p>
                <%= render 'sites/noteModal', site: site %> --}}
              @endif
                <div class="text-end mt-3">
                  <object>
                      <a href="#"></a>
                  </object>
                  {{-- <% if current_user == site.user %>
                    <object><%= link_to "編集", edit_site_path(site), "data-turbolinks": false, class: "text-info me-3" %></object>
                    <object><%= link_to "削除", site_path(site), method: :delete, class: "text-danger", data: {confirm: "本当に削除しますか？"} %></object>
                  <% end %> --}}
                </div>
            </div>
          </li>
        @endforeach
    </div>
</div>
</div>
@endsection
