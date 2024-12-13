@extends('layouts.app')

@section('css')

@section('content')
<nav class="breadcrumb">
    <a href="{{ route('products') }}">商品一覧</a>
    &gt; <span>詳細</span>
</nav>
<div class="product-detail">
    <div class="product-detail__image">
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
        <div class="product-detail__image-edit">
            <input type="file" name="image" id="imageInput" class="register-form__input-image" onchange="previewImage(event)">
        </div>
    </div>
    <div class="product-detail__items">
        <div class="product-detail__item">
            <p class="product-detail__item-name">商品名</p>
            <input type="text" name="name" value="{{ old('name') }}" class="product-detail__input-name">
        </div>
        <div class="product-detail__item">
            <p class="product-detail__item-price">値段</p>
            <input type="text" name="price" value="{{ old('price') }}" class="product-detail__input-price">
        </div>
        <div class="register-form__item">
            <p class="register-form-name">季節</p>
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
        </div>
        <div class="product-detail__item">
            <p class="register-form-name">商品説明<span class="required">必須</span></p>
            <textarea name="description" class="register-form__input-description">{{ old('description') }}
            </textarea>
        </div>
        <div class="product-detail__button">
            <a href="/products" class="product-detail__button-back">戻る</a>
            <button type="submit" class="product-detail__button-edit">変更を保存</button>
            <button type="submit" class="product-detail__button-delete">🗑️</button>
        </div>
    </div>
</div>

@endsection