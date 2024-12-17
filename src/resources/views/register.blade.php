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
            <!-- 商品名 -->
            <div class="register-form__item">
                <p class="register-form-name">商品名<span class="required">必須</span></p>
                <input type="text" name="name" value="{{ old('name') }}" class="register-form__input-name" placeholder="商品名を入力">
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <!-- 値段 -->
            <div class="register-form__item">
                <p class="register-form-name">値段<span class="required">必須</span></p>
                <input type="text" name="price" value="{{ old('price') }}" class="register-form__input-price" placeholder="値段を入力">
                @if ($errors->has('price'))
                    <div class="error">
                        @foreach ($errors->get('price') as $message)
                            <p>{{ $message }}</p>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- 商品画像 -->
            <div class="register-form__item">
                <p class="register-form-name">商品画像<span class="required">必須</span></p>
                <div id="imagePreview" class="register-form__image-preview"></div>
                <input type="file" name="image" id="imageInput" class="register-form__input-image" onchange="previewImage(event)">
                @error('image')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <!-- 季節 -->
            <div class="register-form__item">
                <p class="register-form-name">季節<span class="required">必須</span><span class="select">複数選択可</span></p>
                <label>
                    <input type="checkbox" name="season[]" value="spring" {{ is_array(old('season')) && in_array('spring', old('season')) ? 'checked' : '' }}> 春
                </label>
                <label>
                    <input type="checkbox" name="season[]" value="summer" {{ is_array(old('season')) && in_array('summer', old('season')) ? 'checked' : '' }}> 夏
                </label>
                <label>
                    <input type="checkbox" name="season[]" value="autumn" {{ is_array(old('season')) && in_array('autumn', old('season')) ? 'checked' : '' }}> 秋
                </label>
                <label>
                    <input type="checkbox" name="season[]" value="winter" {{ is_array(old('season')) && in_array('winter', old('season')) ? 'checked' : '' }}> 冬
                </label>
                @error('season')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <!-- 商品説明 -->
            <div class="register-form__item">
                <p class="register-form-name">商品説明<span class="required">必須</span></p>
                <textarea name="description" class="register-form__input-description" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
                @error('description')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <!-- ボタン -->
            <div class="register-form__button">
                <a href="/products" class="register-form__button-back">戻る</a>
                <button type="submit" class="register-form__button-register">登録</button>
            </div>
        </form>
    </div>
</div>

@section('scripts')
<script>
    function previewImage(event) {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            const imagePreview = document.getElementById('imagePreview');
            imagePreview.innerHTML = '';
            const img = document.createElement('img');
            img.src = e.target.result;
            img.alt = '商品画像プレビュー';
            img.style.maxWidth = '300px';
            imagePreview.appendChild(img);
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection

@endsection
