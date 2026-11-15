<x-login-layout>

    <!-- ログイン中のユーザー自身のプロフィール情報を横並びで表示する -->
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

    </div>

    <!-- プロフィール情報の下に自分の投稿一覧を表示する -->
    <div class="profile_posts">

        <div class="post_list">

            <!-- 自分の投稿を新しい順に1件ずつ表示する -->
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

                    <!-- 自分の投稿に編集・削除ボタンを表示する -->
                    @if ((int) $post->user_id === (int) auth()->id())

                        <!-- 投稿編集ボタン -->
                        <button
                            type="button"
                            class="edit_post_button"
                            data-post-id="{{ $post->id }}"
                            data-post-content="{{ $post->post }}"
                        >
                            <img
                                src="{{ asset('images/edit.png') }}"
                                alt="投稿を編集"
                                class="edit_post_image"
                            >
                        </button>

                        <!-- 投稿削除フォーム -->
                        <form
                            action="{{ route('posts.destroy', $post->id) }}"
                            method="POST"
                            class="delete_post_form"
                            onsubmit="return confirm('この投稿を削除します。よろしいでしょうか？');"
                        >
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="delete_post_button">
                                <img
                                    src="{{ asset('images/trash.png') }}"
                                    alt="投稿を削除"
                                    class="delete_post_image"
                                >
                            </button>
                        </form>

                    @endif

                </div>
            @empty
                <!-- 投稿がない場合のメッセージ -->
                <p>投稿はありません。</p>
            @endforelse

        </div>

    </div>

    <!-- 投稿編集用のモーダル -->
    <div id="editPostModal" class="edit_post_modal">
        <div class="edit_post_modal_content">

            <!-- 編集内容を送信するフォーム -->
            <form id="editPostForm" method="POST">
                @csrf
                @method('PUT')

                <!-- 編集対象の投稿IDを保持する -->
                <input type="hidden" id="editPostId" name="post_id">

                <!-- 既存の投稿内容を表示する -->
                <textarea
                    id="editPostContent"
                    name="post"
                    maxlength="150"
                    required
                ></textarea>

                <!-- 編集内容を保存するボタン -->
                <button type="submit" class="modal_save_button">
                    <img
                        src="{{ asset('images/edit.png') }}"
                        alt="編集内容を保存"
                        class="modal_save_image"
                    >
                </button>
            </form>

        </div>
    </div>

    <!-- 投稿編集用のJavaScriptを読み込む -->
    <script src="{{ asset('js/post-edit.js') }}" defer></script>

</x-login-layout>
