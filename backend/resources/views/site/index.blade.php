@extends('layouts.app')

@section('content')
<div class="row m-0">
    <div class="col-12">
    <h2 class="ml-2">- Your Site Note -</h2>
    <div class="d-flex">
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
                <p type="button" class="text-center mb-0" data-toggle="modal" data-target="#exampleModal">
                    <i class="fas fa-sort-down fa-2x w-50"></i>
                </p>

                </p>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
              @endif
                <div class="text-right mt-3">
                    <object>
                        <a href="#" class="text-primary mr-3">詳細</a>
                    </object>
                    <object>
                        <a href="#" class="text-info mr-3">編集</a>
                    </object>
                    <object>
                        <a href="#" method="delete" class="text-danger" onclick="deleteHandle(event);">削除</a>
                    </object>
                </div>
            </div>
          </li>
        @endforeach
    </div>
</div>
</div>
@endsection
