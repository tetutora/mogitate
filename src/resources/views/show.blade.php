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
                <img id="previewImage" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-detail__image-display">
                <div class="product-detail__image-edit">
                    <input type="file" name="image" id="imageInput" class="product-detail__input-image" onchange="previewImage(event)">
                </div>
            </div>
            <div class="product-detail__items">
                <!-- 商品名 -->
                <div class="product-detail__item">
                    <p class="product-detail__item-name">商品名</p>
                    <input type="text" name="name" value="{{ $product->name }}" class="product-detail__input-name" placeholder="商品名を入力">
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- 値段 -->
                <div class="product-detail__item">
                    <p class="product-detail__item-name">値段</p>
                    <input type="text" name="price" value="{{ $product->price }}" class="product-detail__input-price" placeholder="値段を入力">
                    @error('price')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- 季節 -->
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
                    @error('season')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- 商品説明 -->
        <div class="product-detail__item">
            <p class="product-detail__item-name">商品説明</p>
            <textarea name="description" class="product-detail__input-description" placeholder="商品の説明を入力">{{ $product->description }}</textarea>
            @error('description')
                <div class="error">{{ $message }}</div>
            @enderror
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
    function previewImage(event) {
        var file = event.target.files[0];
        var reader = new FileReader();
        reader.onload = function(e)
        {
            var preview = document.getElementById('previewImage');
            preview.src = e.target.result;
        };
        reader.readAsDataURL(file);
        @error('image')
            <div class="error">{{ $message }}</div>
        @enderror
    }
</script>
@endsection
