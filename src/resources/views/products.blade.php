@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
<div class="list">
    <div class="list__header">
        <div class="header__title">
            <h2>商品一覧</h2>
        </div>
        <div class="header__button">
            <a href="/register" class="header__button-submit">＋ 商品を追加</a>
        </div>
    </div>
    <div class="list__content">
        <div class="search-form">
            <div class="search-form-name">
                <input type="search" name="" id="" class="search-form__input-name" placeholder="商品名で検索">
            </div>
            <div class="search-form__button-name">
                <button type="submit" class="search-form__button-submit-name">検索</button>
            </div>
            <div class="search-form__title">
                <p class="search-form__title-value">価格順で表示</p>
            </div>
            <div class="search-form__input">
                <input type="search" name="" id="" class="search-form__input-value">
            </div>
        </div>
        <div class="product-grid">
            @foreach($products as $product)
            <div class="product-item">
                <a href="{{ route('show', $product->id) }}">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                </a>
                <div class="product-info">
                    <span class="product-name">{{ $product->name }}</span>
                    <span class="product-price">¥{{ number_format($product->price) }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection