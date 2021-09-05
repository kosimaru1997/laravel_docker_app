@extends('layouts.app')

@section('content')
<div class="row mt-4 m-0">
    <div class="col-md-6 border-right border-primary p-0">
        <div class="text-center">
            <h2>SiteNote</h2>
            <p>SITE NOTEは様々なWebサイトを管理するためのツールです。<br/>
                お気に入りのサイトや学習で利用したサイトに<br/>
                あなたのメモを添えて管理することができます。<br/>
                マークダウン記法にも対応しており、柔軟な記述が出来ます。
            </p>
        </div>
    </div>
    <div class="col-md-6 border-left border-primary p-0">
        <div class="text-center">
            <h2>Memo</h2>
            <p>Memoはシンプルなメモツールです。<br/>
               単純なメモを記録するのに便利です。<br/>
               タグ付けによりメモの種類を分け管理出来ます。<br/>

            </p>
        </div>
    </div>
</div>
<div class="row mt-5 m-0">
    <div class="col-12 text-center">
        <h2>SiteNote or Memo</h2>
        <h4>Yor are logged in!</h4>
        <h5>Please Choose SiteNote or Memo</h5>
        <div class="d-flex justify-content-center
        mt-5">
            <a class="btn btn-outline-primary top-btn mx-5" href="{{ route('sites') }}">{{ __('SiteNote') }}</a>
            <a class="btn btn-outline-secondary top-btn mx-5" href="{{ route('memo') }}">{{ __('Memo') }}</a>
        </div>
    </div>
</div>
@endsection

