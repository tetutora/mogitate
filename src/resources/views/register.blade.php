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
        <form action="/products" method="post">
            @csrf
            <div class="register-form__item">
                <p class="register-form-name">商品名<span class="required" >必須</span></p>
                <input type="text" name="" id="" class="register-form__input-name" placeholder="商品名を入力">
            </div>
            <div class="register-form__item">
                <p class="register-form-name">値段<span class="required" >必須</span></p>
                <input type="text" name="" id="" class="register-form__input-value" placeholder="値段を入力">
            </div>
            <div class="register-form__item">
                <p class="register-form-name">商品画像<span class="required" >必須</span></p>
                <input type="file" name="" id="" class="register-form__input-image">
            </div>
            <div class="register-form__item">
                <p class="register-form-name">季節<span class="required" >必須</span><span class="select">複数選択可</span></p>
                <label for="">
                    <input type="radio" name="" value="" class="register-form__input-season">春
                </label>
                <label for="">
                    <input type="radio" name="" value="" class="register-form__input-season">夏
                </label>
                <label for="">
                    <input type="radio" name="" value="" class="register-form__input-season">秋
                </label>
                <label for="">
                    <input type="radio" name="" value="" class="register-form__input-season">冬
                </label>
            </div>
            <div class="register-form__item">
                <p class="register-form-name">商品説明<span class="required" >必須</span></p>
                <textarea name="" id="" class="register-form__input-explain" placeholder="商品の説明を入力"></textarea>
            </div>
            <div class="register-form__button">
                <button type="submit" class="register-form__button-back">戻る</button>
                <button type="submit" class="register-form__button-register">登録</button>
            </div>
        </form>
    </div>

</div>
@endsection
