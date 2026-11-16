<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <!--IEブラウザ対策-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="description" content="ページの内容を表す文章" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>AtlasSNS / 改修課題</title>

        <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/logout.css') }} ">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

        <!-- 登録完了画面のときだけ専用CSSを読み込む -->
        @if (View::getSection('page_css') === 'added')
            <link rel="stylesheet" href="{{ asset('css/added.css') }}">
        @endif

        <!--スマホ,タブレット対応-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <header>
            <h1><img src="{{ asset('images/atlas.png') }}" alt="AtlasSNS"></h1>
            <p>Social Network Service</p>
        </header>
        <div id="container">
            {{ $slot }}
        </div>
        <script src="{{ asset('js/app.js') }}"></script>

    </body>
</html>
