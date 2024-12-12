@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register">
    <div class="register__title">
        <h2>商品登録</h2>
    </div>
    <div class="register-form">
        <form action="/register" method="post" enctype="multipart/form-data">
            @csrf
            <div class="register-form__item">
                <p class="register-form-name">商品名<span class="required" >必須</span></p>
                <input type="text" name="name" value="" class="register-form__input-name" placeholder="商品名を入力">
            </div>
            <div class="register-form__item">
                <p class="register-form-name">値段<span class="required" >必須</span></p>
                <input type="text" name="price" value="" class="register-form__input-price" placeholder="値段を入力">
            </div>
            <div class="register-form__item">
                <p class="register-form-name">商品画像<span class="required" >必須</span></p>
                <div id="imagePreview" class="register-form__image-preview">
                </div>
                <input type="file" name="image" id="imageInput" class="register-form__input-image" onchange="previewImage(event)">
                <div id="imagePreview" class="register-form__image-preview">
            </div>
            <div class="register-form__item">
                <p class="register-form-name">季節<span class="required" >必須</span><span class="select">複数選択可</span></p>
                <label for="">
                    <input type="radio" name="season" value="" class="register-form__input-season">春
                </label>
                <label for="">
                    <input type="radio" name="season" value="" class="register-form__input-season">夏
                </label>
                <label for="">
                    <input type="radio" name="season" value="" class="register-form__input-season">秋
                </label>
                <label for="">
                    <input type="radio" name="season" value="" class="register-form__input-season">冬
                </label>
            </div>
            <div class="register-form__item">
                <p class="register-form-name">商品説明<span class="required" >必須</span></p>
                <textarea name="description" value="" class="register-form__input-description" placeholder="商品の説明を入力"></textarea>
            </div>
            <div class="register-form__button">
                <a href="/products" class="register-form__button-back">戻る</a>
                <button type="submit" class="register-form__button-register">登録</button>
            </div>
        </form>
    </div>
</div>

@section('scripts')
<script>
    // 画像プレビュー用のJavaScript関数
    function previewImage(event) {
        const file = event.target.files[0]; // 最初のファイルを取得
        const reader = new FileReader();

        reader.onload = function(e) {
            // プレビュー用のimgタグを作成
            const imagePreview = document.getElementById('imagePreview');
            imagePreview.innerHTML = ''; // 以前のプレビューを消す
            const img = document.createElement('img');
            img.src = e.target.result; // 読み込んだ画像のURLをセット
            img.alt = '商品画像プレビュー';
            img.style.maxWidth = '300px'; // プレビュー画像の最大幅を設定（任意）
            imagePreview.appendChild(img); // プレビューを表示
        };

        if (file) {
            reader.readAsDataURL(file); // 画像をDataURLとして読み込む
        }
    }
</script>
@endsection

@endsection
