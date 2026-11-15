<x-login-layout>

        <!-- 相手ユーザーのプロフィール情報を横並びで表示する -->
        <div class="profile">

            <!-- 左側：ユーザーアイコン -->
            <div class="profile_icon">
                <img
                    src="{{ asset('images/' . $user->icon_image) }}"
                    alt="ユーザーアイコン"
                >
            </div>

            <!-- 中央：ユーザー名と自己紹介文 -->
            <div class="profile_info">

                <!-- ユーザー名 -->
                <div class="profile_detail">
                    <span class="profile_label">ユーザー名</span>
                    <span class="profile_value">{{ $user->username }}</span>
                </div>

                <!-- 自己紹介文 -->
                <div class="profile_detail">
                    <span class="profile_label">自己紹介</span>
                    <span class="profile_value">{{ $user->bio }}</span>
                </div>

            </div>

            <!-- 右側：フォロー状態に応じてボタンを表示する -->
            <div class="profile_action">
                @if ($is_following)
                    <!-- フォロー中の場合は解除ボタンを表示する -->
                    <form action="{{ route('unfollow', $user->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="unfollow_button">フォロー解除</button>
                    </form>
                @else
                    <!-- 未フォローの場合はフォローボタンを表示する -->
                    <form action="{{ route('follow', $user->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="follow_button">フォローする</button>
                    </form>
                @endif
            </div>

        </div>

    <!-- プロフィール情報の下に投稿一覧を表示する -->
    <div class="profile_posts">

        <!-- 投稿を新しい順に1件ずつ表示する -->
        <div class="post_list">
            @forelse ($posts as $post)
                <div class="post_item">

                    <!-- 投稿日時を表示する -->
                    <div class="post_item_date">
                        {{ $post->created_at->format('Y-m-d H:i') }}
                    </div>

                    <!-- 投稿者のアイコンと名前を表示する -->
                    <div class="post_item_user">
                        <img
                            src="{{ asset('images/' . $post->user->icon_image) }}"
                            alt="投稿者アイコン"
                        >
                        <span>{{ $post->user->username }}</span>
                    </div>

                    <!-- 投稿内容を表示する -->
                    <div class="post_item_content">
                        {{ $post->post }}
                    </div>

                </div>
            @empty
                <!-- 投稿がない場合のメッセージ -->
                <p>投稿はありません。</p>
            @endforelse
        </div>

    </div>

</x-login-layout>
