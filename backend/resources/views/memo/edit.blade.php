@extends('layouts.memo')

@section('javascript')
<script src="/js/confirm.js" defer></script>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        メモ編集
        <form class="cursor-p" id="delete-form" action="{{ route('destroy') }}" method="POST">
            @csrf
            <input type="hidden" name="memo_id" value="{{ $edit_memo[0]['id']}}"/>
            <a><i class="fas fa-trash mr-3 cursor-p" onclick="deleteHandle(event);"></i></a>
        </form>
    </div>
    <form class="card-body" action="{{ route('update') }}" method="POST">
        @csrf
        <input type="hidden" name="memo_id" value="{{ $edit_memo[0]['id']}}"/>
        <div class="form-group">
            <textarea class="form-control" name="content" rows="3" placeholder="ここにメモを入力">{{ $edit_memo[0]['content'] }}</textarea>
        </div>
        @error('content')
            <div class="alert alert-danger">メモ内容を入力してください！</div>
        @enderror
    @foreach($tags as $tag)
        <div class="form-check form-check-inline mb-3">
          <input class="form-check-input" type="checkbox" name="tags[]" id="{{ $tag['id'] }}" value="{{ $tag['id'] }}" {{ in_array($tag['id'], $include_tags) ? 'checked' : ''}}>
          <label class="form-check-label" for="{{ $tag['id'] }}">{{ $tag['name']}}</label>
        </div>
    @endforeach
        <input type="text" class="form-control w-50 mb-3" name="new_tag" placeholder="新しいタグを入力" />
        <button type="submit" class="btn btn-outline-secondary">更新</button>
    </form>
</div>
@endsection
