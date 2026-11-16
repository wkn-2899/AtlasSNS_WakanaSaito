<x-logout-layout>

{!! Form::open(['url' => 'register']) !!}

<h2>新規ユーザー登録</h2>

{{ Form::label('ユーザー名') }}
{{ Form::text('username',null,['class' => 'input', 'autocomplete' => 'off']) }}
@error('username')
    <p class="error_message">{{ $message }}</p>
@enderror

{{ Form::label('メールアドレス') }}
{{ Form::email('email',null,['class' => 'input', 'autocomplete' => 'off']) }}
@error('email')
    <p class="error_message">{{ $message }}</p>
@enderror

{{ Form::label('パスワード') }}
{{ Form::password('password', ['class' => 'input', 'autocomplete' => 'new-password']) }}
@error('password')
    <p class="error_message">{{ $message }}</p>
@enderror

{{ Form::label('パスワード確認') }}
{{ Form::password('password_confirmation', ['class' => 'input']) }}
@error('password_confirmation')
    <p class="error_message">{{ $message }}</p>
@enderror

{{ Form::submit('新規登録') }}

<p><a href="login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}


</x-logout-layout>
