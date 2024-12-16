<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    public function products(Request $request)
    {
        $products = Product::all();

        $search = $request->input('search');
        $priceOrder = $request->input('price_order');

        $products = Product::query()
        ->when($search, function ($query, $search)
        {
            return $query->where('name', 'like', "%{$search}%");
        })
        ->when($priceOrder, function ($query, $priceOrder)
        {
            return $query->orderBy('price', $priceOrder);
        },function ($query)
        {
            return $query->orderBy('created_at', 'desc');
        })
        ->paginate(6);

        return view('products', compact('products'));
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
        $content = $request->only
        ([
            'name', 'price', 'season', 'description'
        ]);

        $imagePath = null;
        if ($request->hasFile('image'))
        {
            $imagePath = $request->file('image')->store('products', 'public');
            // $imagePath = $request->file('image')->store('images', 'public');
        }

        $product = Product::create
        ([
            'name' => $content['name'],
            'price' => $content['price'],
            'image' => $imagePath,
            'description' => $content['description'],
        ]);

        if (isset($content['season']))
        {
            $seasonIds = Season::whereIn('name', $content['season'])->pluck('id');
            $product->seasons()->attach($seasonIds);
        }

        return redirect('/products');

    }

    public function update(ProductRequest $request, $productId)
    {
        $product = Product::findOrFail($productId);

        $content = $request->only(['name', 'price', 'description']);

        $product->update([
            'name' => $content['name'],
            'price' => $content['price'],
            'description' => $content['description'] ?? $product->description,
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
            $product->save();
        }

        $seasons = Season::whereIn('name', $request->input('season', []))->get();
        $product->seasons()->sync($seasons);

        return redirect()->route('show', $product->id);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image)
        {
            Storage::delete('public/' . $product->image);
        }

        $product->delete();

        return redirect()->route('products');
    }
}


