<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    public function products()
    {
        return view('products');
    }

    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $content = $request->only([
            'name','price','image','season','description'
        ]);
        
        $imagePath = $request->file('image')->store('images', 'public');

        Product::create([
            'name' => $content['name'],
            'price' => $content['price'],
            'image' => $content,
            'season' => $content['season'],
            'description' => $content['description'],
        ]);

        
        return redirect('/products');
    }
}
