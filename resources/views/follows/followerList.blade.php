<x-login-layout>

    <!-- 自分をフォローしているユーザーの一覧を表示する -->
    <div class="follow_list">

        <h2>フォロワーリスト</h2>

        <!-- フォロワーのアイコン一覧を囲む -->
        <div class="follow_icon_list">

            <!-- フォロワーを1人ずつ表示する -->
            @forelse ($users as $user)
                <div class="follow_list_item">

                    <!-- アイコンをクリックすると相手ユーザーのプロフィールへ移動する -->
                    <div class="follow_list_icon">
                        <a href="{{ route('profile.show', $user->id) }}">
                            <img
                                src="{{ asset('images/' . $user->icon_image) }}"
                                alt="ユーザーアイコン"
                            >
                        </a>
                    </div>

                </div>
            @empty
                <!-- フォロワーがいない場合に表示する -->
                <p>フォロワーはいません。</p>
            @endforelse

        </div>

    </div>

    <!-- フォロワーの投稿一覧を表示する -->
    <div class="follow_posts">

        <!-- 投稿を新しい順に1件ずつ表示する -->
        @forelse ($posts as $post)
            <div class="follow_post_item">

                <!-- 投稿者のアイコンをクリックすると、そのユーザーのプロフィールへ移動する -->
                <div class="follow_post_icon">
                    <a href="{{ route('profile.show', $post->user->id) }}">
                        <img
                            src="{{ asset('images/' . $post->user->icon_image) }}"
                            alt="ユーザーアイコン"
                        >
                    </a>
                </div>

                <!-- 投稿者名・投稿内容・投稿日時を表示する -->
                <div class="follow_post_content">

                    <!-- 投稿者のユーザー名 -->
                    <p class="follow_post_username">
                        {{ $post->user->username }}
                    </p>

                    <!-- 投稿内容 -->
                    <p class="follow_post_text">
                        {{ $post->post }}
                    </p>

                </div>

                <!-- 投稿日時を右側に表示する -->
                <p class="follow_post_date">
                    {{ $post->created_at->format('Y-m-d H:i') }}
                </p>

            </div>
        @empty
            <!-- 投稿がない場合に表示する -->
            <p>投稿はありません。</p>
        @endforelse

    </div>

</x-login-layout>
