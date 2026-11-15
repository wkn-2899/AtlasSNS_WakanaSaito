<x-login-layout>

    <!-- 投稿内容を登録するフォーム -->
    <form action="{{ route('posts.store') }}" method="POST" class="post_form">
        @csrf

        <!-- ログイン中のユーザーのアイコンを表示する -->
        <div class="post_user_icon">
            <img
                src="{{ asset('images/' . auth()->user()->icon_image) }}"
                alt="ユーザーアイコン"
            >
        </div>

        <!-- 投稿内容の入力欄 -->
        <div class="post_input">
            <textarea
                name="post"
                placeholder="投稿内容を入力してください。"
                aria-label="投稿内容"
            >{{ old('post') }}</textarea>

            <!-- 投稿内容にエラーがある場合はメッセージを表示する -->
            @error('post')
                <p class="error_message">{{ $message }}</p>
            @enderror
        </div>

        <!-- 投稿ボタンの画像をクリックして送信する -->
        <button type="submit" class="post_button">
            <img
                src="{{ asset('images/post.png') }}"
                alt="投稿"
            >
        </button>
    </form>

        <!-- 登録済みの投稿一覧 -->
    <div class="post_list">

        <!-- 投稿を1件ずつ表示する -->
        @foreach ($posts as $post)
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

                <!-- ログイン中のユーザー本人の投稿だけ操作ボタンを表示する -->
                @if ((int) $post->user_id === (int) auth()->id())

                    <!-- 投稿編集ボタン：画像をクリックして編集画面を開く -->
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

                    <!-- 投稿削除フォーム：削除前に確認する -->
                    <form
                        action="{{ route('posts.destroy', $post->id) }}"
                        method="POST"
                        class="delete_post_form"
                        onsubmit="return confirm('この投稿を削除します。よろしいでしょうか？');"
                    >
                        @csrf
                        @method('DELETE')

                        <!-- 用意された削除画像をボタンとして表示する -->
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
        @endforeach

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

                <!-- 編集アイコンを押すと投稿を保存する -->
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
