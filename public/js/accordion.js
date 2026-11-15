
document.addEventListener('DOMContentLoaded', function () {
    // メニューの開閉ボタン、矢印、メニュー一覧を取得する
    const menuButton = document.getElementById('userMenuButton');
    const menuArrow = document.getElementById('menuArrow');
    const menuList = document.getElementById('userMenuList');

    // 必要なHTML要素が存在しない場合は処理を終了する
    if (!menuButton || !menuArrow || !menuList) {
        return;
    }

    // ボタンをクリックしたときにメニューを開閉する
    menuButton.addEventListener('click', function () {
        // メニューが開いているかどうかを確認する
        const isOpen = menuList.classList.contains('is-open');

        // メニューの表示状態を切り替える
        menuList.classList.toggle('is-open');

        // メニューの状態に合わせてV字矢印の向きを切り替える
        menuArrow.classList.toggle('is-open', !isOpen);

        // スクリーンリーダーなどに開閉状態を伝える
        menuButton.setAttribute('aria-expanded', String(!isOpen));
    });
});
