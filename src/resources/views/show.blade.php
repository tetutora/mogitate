@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')
<div class="nav">
    <nav class="breadcrumb">
        <a href="{{ route('products') }}">商品一覧</a>&gt; <span>詳細</span>
    </nav>
</div>
<div class="product-detail">
    <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="product-detail__content">
            <div class="product-detail__image">
                <!-- プレビュー用の画像タグ -->
                <img id="previewImage" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-detail__image-display">
                <div class="product-detail__image-edit">
                    <input type="file" name="image" id="imageInput" class="product-detail__input-image" onchange="previewImage(event)">
                </div>
            </div>
            <div class="product-detail__items">
                <div class="product-detail__item">
                    <p class="product-detail__item-name">商品名</p>
                    <input type="text" name="name" value="{{ $product->name }}" class="product-detail__input-name">
                </div>
                <div class="product-detail__item">
                    <p class="product-detail__item-name">値段</p>
                    <input type="text" name="price" value="{{ $product->price }}" class="product-detail__input-price">
                </div>
                <div class="product-detail__item">
                    <p class="product-detail__item-name">季節</p>
                    <label>
                        <input type="checkbox" name="season[]" value="spring" {{ in_array('spring', $product->seasons->pluck('name')->toArray()) ? 'checked' : '' }}> 春
                    </label>
                    <label>
                        <input type="checkbox" name="season[]" value="summer" {{ in_array('summer', $product->seasons->pluck('name')->toArray()) ? 'checked' : '' }}> 夏
                    </label>
                    <label>
                        <input type="checkbox" name="season[]" value="autumn" {{ in_array('autumn', $product->seasons->pluck('name')->toArray()) ? 'checked' : '' }}> 秋
                    </label>
                    <label>
                        <input type="checkbox" name="season[]" value="winter" {{ in_array('winter', $product->seasons->pluck('name')->toArray()) ? 'checked' : '' }}> 冬
                    </label>
                </div>
            </div>
        </div>
        <div class="product-detail__item">
            <p class="product-detail__item-name">商品説明</p>
            <textarea name="description" class="product-detail__input-description">{{ $product->description }}</textarea>
        </div>
        <div class="product-detail__button">
            <a href="/products" class="product-detail__button-back">戻る</a>
            <button type="submit" class="product-detail__button-edit">変更を保存</button>
        </div>
    </form>

    <!-- 削除ボタン用のフォーム -->
    <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
        @csrf
        @method('DELETE')
        <button type="submit" class="product-detail__button-delete">🗑️ 削除</button>
    </form>
</div>

@endsection

@section('js')
<script>
    // 画像プレビューの関数
    function previewImage(event) {
        var file = event.target.files[0]; // 選択したファイル
        console.log('Selected file:', file);  // 選択されたファイルをログに表示
        var reader = new FileReader();
        
        // 画像が選択されたとき、プレビュー表示
        reader.onload = function(e) {
            var preview = document.getElementById('previewImage'); // プレビュー画像要素
            console.log('Image preview URL:', e.target.result);  // プレビューURLをログに表示
            preview.src = e.target.result; // 選択された画像にプレビューを更新
        };
        
        if (file) {
            reader.readAsDataURL(file); // 選択した画像を読み込む
        }
    }
</script>
@endsection
