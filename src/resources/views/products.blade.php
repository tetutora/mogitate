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
        <div class="list-image">
            <a href="" class="list-mage__item">
                <img src="../../storage/fruits-img/banana.png" alt="banana">
            </a>
        </div>
    </div>
</div>
@endsection