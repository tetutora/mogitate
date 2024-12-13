<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function products()
    {
        $products = Product::with('seasons')->get();
        return view('products',compact('products'));
    }

    public function show($productId)
    {
        $product = Product::with('seasons')->findOrFail($productId);

        return view('show',compact('product'));
    }

    public function showRegisterForm()
    {
        return view('register');
    }

    public function store(ProductRequest $request)
    {
        $content = $request->only([
            'name', 'price', 'season', 'description'
        ]);
        $imagePath = null;
        if ($request->hasFile('image'))
        {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        Product::create([
            'name' => $content['name'],
            'price' => $content['price'],
            'image' => $imagePath,
            'description' => $content['description'],
        ]);

        return redirect('/products');

    }
}


