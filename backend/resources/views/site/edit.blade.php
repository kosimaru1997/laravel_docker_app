@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="row mt-3">
        <h2 class="ml-2">{{$site->title}}</h2>
        <div class="col-12">
            <h3 class="ml-2 mt-2">Edit Note</h3>
            {{-- <div id="flash_messages">
            </div> --}}
            <form action="/site/{{$site->id}}/update" method="post">
                @csrf
                {{-- <div class="tag-form mb-2"> --}}
                    {{-- <label for="site_tags">Tags</label>
                    <input class="form-control" placeholder=",で区切ってください" type="text" name="site[tag]" id="site_tag"> --}}
                {{-- </div> --}}
            <div class="bg-site py-3 px-4 mb-2">
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
                <textarea class="form-control note-control p-3" id="md-textarea" placeholder="メモ記入欄（マークダウン対応）" name="note" cols="30" rows="13">{{$site->note}}</textarea>
                </div>
                <input type="submit" name="commit" value="Post" class="btn btn-outline-secondary d-block px-4 ms-2 my-3" data-disable-with="Post">
            </div>
            </form>
       </div>

    </div>
  </div>
@endsection
