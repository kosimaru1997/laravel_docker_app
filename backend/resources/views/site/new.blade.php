@extends('layouts.app')
@section('javascript')
<script src="/js/preview.js" defer></script>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row mt-3">
        <h3 class="ml-2">Create Site Note</h3>
        <div class="col-12">
            {{-- <div id="flash_messages">
            </div> --}}
            <form action="{{ route('site_store') }}" method="post">
                @csrf
                <div class="bg-site py-3 px-4 mb-2">
                <div class="tag-form w-75 mb-4">
                    <label for="site_tags">Tags</label>
                    <input class="form-control" placeholder=",で区切ってください" type="text" name="tag" id="site_tag">
                </div>
                <input class="form-control mb-3" placeholder="例：https://hogehoge" type="text" name="url" id="site_url">
                <div class="file-header d-flex">
                <div class="border-top border-left border-right events-none bg-white py-2 px-3" id="markdown">
                     Edit note
                </div>
                <div class="events-auto border-top border-right bg-light-grey py-2 px-3" ,="" id="preview">
                    Preview
                </div>
                </div>
                <div id="preview-area"></div>
                <div id="note-form">
                <textarea class="form-control note-control p-3" id="md-textarea" placeholder="メモ記入欄（マークダウン対応）" name="note" cols="30" rows="13"></textarea>
                </div>
                <input type="submit" name="commit" value="Post" class="btn btn-outline-secondary d-block px-4 ms-2 my-3" data-disable-with="Post">
            </div>
            </form>
       </div>

    </div>
  </div>
@endsection
