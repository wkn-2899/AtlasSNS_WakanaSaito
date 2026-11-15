<div id="head">

    <!-- Atlasロゴをクリックするとトップページへ移動する -->
    <h1>
        <a href="{{ route('top') }}">
            <img src="{{ asset('images/atlas.png') }}" alt="Atlas">
        </a>
    </h1>

    <!-- ユーザー名とアコーディオンメニュー -->
    <div class="user_menu">

        <!-- クリックするとメニューを開閉するボタン -->
        <button
            type="button"
            class="user_menu_button"
            id="userMenuButton"
            aria-expanded="false"
            aria-controls="userMenuList"
        >
             <!-- ログイン中のユーザー名を表示する -->
             <p>{{ Auth::user()->username }}　さん</p>

            <!-- JavaScriptで上下を切り替える矢印 -->
            <span class="menu_arrow" id="menuArrow"></span>

        </button>

        <!-- アイコンをクリックすると自分のプロフィール画面へ移動する -->
        <a href="{{ route('profile') }}" class="user_icon_link">
            <img
                src="{{ asset('images/' . Auth::user()->icon_image) }}"
                alt="自分のプロフィール"
                class="user_icon"
            >
        </a>

        <!-- クリックすると表示・非表示を切り替えるメニュー -->
        <ul class="user_menu_list" id="userMenuList">

            <!-- トップページへ移動する -->
            <li>
                <a href="{{ route('top') }}">HOME</a>
            </li>

            <!-- プロフィール編集ページへ移動する -->
            <li>
                <a href="{{ route('profile.edit') }}">プロフィール編集</a>
            </li>

            <!-- ログアウト処理を実行する -->
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">ログアウト</button>
                </form>
            </li>

        </ul>

    </div>

</div>

{{-- アコーディオンメニュー用JavaScriptを読み込む --}}
<script src="{{ asset('js/accordion.js') }}" defer></script>
