<?php

// バリデーションエラーの日本語メッセージを定義する
return [

    // 各バリデーションルールの日本語メッセージ
    'required' => ':attributeは必須項目です。',
    'string' => ':attributeは文字列で入力してください。',
    'min' => [
        'string' => ':attributeは:min文字以上で入力してください。',
    ],
    'max' => [
        'string' => ':attributeは:max文字以内で入力してください。',
        'file' => ':attributeは:max KB以下のファイルを選択してください。',
    ],
    'email' => ':attributeは有効なメールアドレス形式で入力してください。',
    'unique' => 'この:attributeはすでに登録されています。',
    'alpha_num' => ':attributeは英字と数字のみで入力してください。',
    'same' => ':attributeが一致していません。',
    'mimes' => ':attributeは指定された形式のファイルを選択してください。',
    'file' => ':attributeにはファイルを選択してください。',

    // エラーメッセージに表示する項目名
    'attributes' => [
        'username' => 'ユーザー名',
        'email' => 'メールアドレス',
        'password' => 'パスワード',
        'password_confirmation' => 'パスワード確認',
        'bio' => '自己紹介',
        'icon_image' => 'アイコン画像',
    ],

];
