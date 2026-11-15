<x-login-layout>

    <!-- ユーザー検索フォームと検索ワードの表示 -->
    <div class="search_area">

        <!-- 検索ワードを送信するフォーム -->
        <form action="{{ route('search') }}" method="GET" class="search_form">

            <!-- 検索ワードを入力する欄 -->
            <input
                type="text"
                name="keyword"
                placeholder="ユーザー名"
                value="{{ request('keyword') }}"
            >

            <!-- 検索ボタンの画像 -->
            <button type="submit" class="search_button">
                <img src="{{ asset('images/search.png') }}" alt="検索">
            </button>

        </form>

        <!-- 検索ワードが入力されている場合だけ表示する -->
        @if (request()->filled('keyword'))
            <p class="search_keyword">
                検索ワード：{{ request('keyword') }}
            </p>
        @endif

    </div>

    <!-- 検索結果のユーザー一覧 -->
    <div class="user_search_list">

        <!-- 検索結果のユーザーを1人ずつ表示する -->
        @forelse ($users as $user)
            <div class="user_search_item">

                <!-- ユーザーアイコンを表示する -->
                <div class="user_search_icon">
                    <img
                        src="{{ asset('images/' . $user->icon_image) }}"
                        alt="ユーザーアイコン"
                    >
                </div>

                <!-- ユーザー名を表示する -->
                <div class="user_search_name">
                    {{ $user->username }}
                </div>

                <!-- フォロー状態に応じてボタンを切り替える -->
                <div class="user_follow_button">

                    @if (in_array($user->id, $followed_user_ids))
                        <!-- フォロー解除処理を送信するフォーム -->
                        <form action="{{ route('unfollow', $user->id) }}" method="POST">
                            @csrf

                            <!-- 検索ワードを引き継ぐ -->
                            <input type="hidden" name="keyword" value="{{ request('keyword') }}">

                            <button type="submit" class="unfollow_button">
                                フォロー解除
                            </button>
                        </form>
                    @else
                        <!-- フォロー処理を送信するフォーム -->
                        <form action="{{ route('follow', $user->id) }}" method="POST">
                            @csrf

                            <!-- 検索ワードを引き継ぐ -->
                            <input type="hidden" name="keyword" value="{{ request('keyword') }}">

                            <button type="submit" class="follow_button">
                                フォローする
                            </button>
                        </form>
                    @endif

                </div>

            </div>

        @empty
            <!-- 検索結果がない場合に表示する -->
            <p>該当するユーザーはいません。</p>
        @endforelse

    </div>

</x-login-layout>
