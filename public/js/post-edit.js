
/* HTMLの読み込みが完了してから処理を実行する */
document.addEventListener('DOMContentLoaded', function () {

    // 投稿編集用のモーダルを取得する
    const modal = document.getElementById('editPostModal');

    // 編集フォームを取得する
    const editForm = document.getElementById('editPostForm');

    // 投稿IDの入力欄を取得する
    const postIdInput = document.getElementById('editPostId');

    // 投稿内容の入力欄を取得する
    const postContentInput = document.getElementById('editPostContent');

    // 必要なHTML要素が見つからない場合は処理を終了する
    if (!modal || !editForm || !postIdInput || !postContentInput) {
        console.error('投稿編集モーダルのHTML要素が見つかりません。');
        return;
    }

    // 編集ボタンをすべて取得する
    const editButtons = document.querySelectorAll('.edit_post_button');

    // 各編集ボタンにクリックイベントを設定する
    editButtons.forEach(function (button) {
        button.addEventListener('click', function () {

            // クリックした投稿のIDを取得する
            const postId = button.dataset.postId;

            // クリックした投稿の内容を取得する
            const postContent = button.dataset.postContent;

            // 投稿IDをフォームに設定する
            postIdInput.value = postId;

            // 既存の投稿内容を入力欄に設定する
            postContentInput.value = postContent;

            // 投稿更新先のURLを設定する
            editForm.action = '/posts/' + postId;

            // モーダルを表示する
            modal.style.display = 'block';
        });
    });

});
