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
        <form action="{{ route('products') }}" method="get" id="sort-form" class="search">
            <div class="search-form">
                <div class="search-form-name">
                    <input type="search" name="search" class="search-form__input-name" placeholder="商品名で検索" value="{{ request('search') }}">
                </div>
                <div class="search-form__button-name">
                    <button type="submit" class="search-form__button-submit-name">検索</button>
                </div>
                <div class="search-form__title">
                    <p class="search-form__title-value">価格順で表示</p>
                </div>
                <div class="search-form__input">
                    <select name="price_order" class="search-form__input-value" onchange="this.form.submit()">
                        <option value="" disabled selected>価格で並べ替え</option>
                        <option value="desc" {{ request('price_order') == 'desc' ? 'selected' : '' }}>高い順に表示</option>
                        <option value="asc" {{ request('price_order') == 'asc' ? 'selected' : '' }}>安い順に表示</option>
                    </select>
                </div>
                <!-- タグ表示エリア -->
                @if(request('price_order'))
                    <div class="filter-tags">
                        <span class="filter-tag">{{ request('price_order') == 'asc' ? '安い順に表示' : '高い順に表示' }}
                            <button type="button" class="tag-clear" onclick="resetFilter()">×</button>
                        </span>
                    </div>
                @endif
            </div>
        </form>
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
    <div class="pagination-container">
        <div class="Pagination">
        {{ $products->links('vendor.pagination.pagination') }}
        </div>
    </div>
</div>
<script>
    function resetFilter() {
        const url = new URL(window.location.href);
        url.searchParams.delete('price_order'); // 'price_order' パラメータを削除
        window.location.href = url.toString(); // 新しいURLでリダイレクト
    }
</script>
@endsection
