<x-logout-layout>

  <!-- ログイン情報を/loginへPOST送信するフォーム -->
  {!! Form::open(['url' => 'login']) !!}

  <p>AtlasSNSへようこそ</p>

  <!-- メールアドレスの入力欄 -->
  {{ Form::label('email', 'メールアドレス') }}
  {{ Form::text('email', null, ['class' => 'input']) }}

  <!-- パスワードの入力欄 -->
  {{ Form::label('password', 'パスワード') }}
  {{ Form::password('password', ['class' => 'input']) }}

  <!-- 入力したメールアドレスとパスワードを送信する -->
  {{ Form::submit('ログイン') }}

  <!-- 新規ユーザー登録ページへのリンク -->
  <p><a href="register">新規ユーザーの方はこちら</a></p>

  <!-- フォームを終了する -->
  {!! Form::close() !!}

</x-logout-layout>
