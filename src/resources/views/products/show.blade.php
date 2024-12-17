@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')
<div class="product-detail">
    <!-- 商品名 -->
    <h2>{{ $product->name }}</h2>

    <!-- 商品画像 -->
    <div class="product-detail__image">
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
    </div>

    <!-- 商品情報 -->
    <div class="product-detail__info">
        <p><strong>価格:</strong> ¥{{ number_format($product->price) }}</p>
        <p><strong>季節:</strong>
            @foreach($product->seasons as $season)
                {{ $season->japanese_name }}{{ !$loop->last ? ',' : '' }}
            @endforeach
        </p>
        <p><strong>商品説明:</strong> {{ $product->description }}</p>
    </div>

    <!-- 戻るボタン -->
    <div class="product-detail__buttons">
        <a href="{{ route('products') }}" class="back-button">戻る</a>
    </div>
</div>
@endsection
