<x-login-layout>

    <!-- プロフィール編集ページ全体 -->
    <div class="profile_edit">

        <!-- プロフィールの更新に成功したときにメッセージを表示する -->
        @if (session('success'))
            <p class="success_message">{{ session('success') }}</p>
        @endif

        <!-- プロフィール情報の入力フォーム -->
        <!-- 画像ファイルを送信できるように設定する -->
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- ユーザーアイコンとユーザー名を横並びに表示する -->
            <div class="profile_edit_top">
                <!-- ログイン中のユーザーアイコンを表示する -->
                <div class="profile_edit_icon">
                    <img
                        src="{{ asset('images/' . Auth::user()->icon_image) }}"
                        alt="ログインユーザーのアイコン"
                        width="80"
                        height="80"
                    >
                </div>

                <!-- ユーザー名 -->
                <div class="profile_edit_item">
                    <label for="username">ユーザー名</label>
                    <div>
                       <input
                           type="text"
                           id="username"
                           name="username"
                           value="{{ old('username', Auth::user()->username) }}"
                       >

                       <!-- ユーザー名のバリデーションエラーを表示する -->
                       @error('username')
                           <p class="validation_error">{{ $message }}</p>
                       @enderror
                   </div>
                </div>

            </div>

            <!-- メールアドレス -->
            <div class="profile_edit_item">
                <label for="email">メールアドレス</label>
                <div>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email', Auth::user()->email) }}"
                    >

                    <!-- メールアドレスのバリデーションエラーを表示する -->
                    @error('email')
                        <p class="validation_error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- パスワード -->
            <div class="profile_edit_item">
                <label for="password">パスワード</label>
                <div>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        autocomplete="new-password"
                    >

                    <!-- パスワードのバリデーションエラーを表示する -->
                    @error('password')
                        <p class="validation_error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- パスワード確認 -->
            <div class="profile_edit_item">
                <label for="passwordConfirmation">パスワード確認</label>
                <div>
                    <input
                        type="password"
                        id="passwordConfirmation"
                        name="password_confirmation"
                        autocomplete="new-password"
                    >

                    <!-- パスワード確認のバリデーションエラーを表示する -->
                    @error('password_confirmation')
                        <p class="validation_error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- 自己紹介文 -->
            <div class="profile_edit_item">
                <label for="bio">自己紹介</label>
                <div>
                    <textarea
                        id="bio"
                        name="bio"
                        rows="4"
                    >{{ old('bio', Auth::user()->bio) }}</textarea>

                    <!-- 自己紹介のバリデーションエラーを表示する -->
                    @error('bio')
                        <p class="validation_error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- 新しいアイコン画像を選択する欄 -->
            <div class="profile_edit_item">
                <label for="iconImage">アイコン画像</label>
                <div>

                    <input
                        type="file"
                        id="iconImage"
                        name="icon_image"
                        accept="image/jpeg,image/png,image/bmp,image/gif,image/svg+xml"
                        class="file_input_hidden"
                    >

                    <!-- ファイル選択ボタン -->
                    <label for="iconImage" class="file_select_button">
                        <span>ファイルを選択</span>
                    </label>

                    <!-- 選択した画像のファイル名を表示する -->
                    <span id="selectedFileName"></span>

                    <!-- アイコン画像のバリデーションエラーを表示する -->
                    @error('icon_image')
                        <p class="validation_error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- 入力内容を送信してプロフィールを更新する -->
            <button type="submit">更新</button>

        </form>

    </div>

    <script>
        // ファイル選択欄を取得する
        const iconImageInput = document.getElementById('iconImage');

        // ボタン内の文字を取得する
        const fileSelectButton = document.querySelector('.file_select_button span');

        // ファイルが選択されたときの処理
        iconImageInput.addEventListener('change', function () {

            // 選択されたファイル名をボタン内に表示する
            fileSelectButton.textContent = this.files.length
                ? this.files[0].name
                : 'ファイルを選択';
        });
    </script>

</x-login-layout>
