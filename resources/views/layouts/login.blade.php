<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <!--IEブラウザ対策-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="ページの内容を表す文章" />
  <title>AtlasSNS / 改修課題</title>
  <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
  <!--スマホ,タブレット対応-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!--OGPタグ/twitterカード-->
</head>

<body>
  <header>
    @include('layouts.navigation')
  </header>
  <!-- Page Content -->
  <div id="row">
    <div id="container">
      {{ $slot }}
    </div>

    <div id="sideBar">
        <div id="confirm">
            <!-- ログイン中のユーザー名を表示する -->
            <p>{{ Auth::user()->username }}さんの</p>

            <!-- フォロー数を横並びで表示する -->
            <div class="sidebar_count">
                <p>フォロー数</p>
                <p>{{ $follow_count }}人</p>
            </div>

            <!-- フォローリストへのリンク -->
            <p class="btn sidebar_list_button">
                <a href="{{ route('follow-list') }}">フォローリスト</a>
            </p>

            <!-- フォロワー数を横並びで表示する -->
            <div class="sidebar_count">
                <p>フォロワー数</p>
                <p>{{ $follower_count }}人</p>
            </div>

            <!-- フォロワーリストへのリンク -->
            <p class="btn sidebar_list_button">
                <a href="{{ route('follower-list') }}">フォロワーリスト</a>
            </p>
        </div>

        <!-- ユーザー検索へのリンク -->
        <p class="btn sidebar_search_button">
            <a href="{{ url('search') }}">ユーザー検索</a>
        </p>
    </div>

  </div>
  <footer>
  </footer>
  <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
