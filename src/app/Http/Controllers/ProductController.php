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
        return view('products');
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

        // 画像がアップロードされたか確認
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        // トランザクションを開始
        DB::beginTransaction();
        
        try {
            // 商品を作成
            $product = Product::create([
                'name' => $content['name'],
                'price' => $content['price'],
                'image' => $imagePath,
                'description' => $content['description'],
            ]);

            // 季節との関連付け
            if (!empty($content['season']) && is_array($content['season'])) {
                foreach ($content['season'] as $season) {
                    // $seasonが空でないことを確認
                    if (!empty($season)) {
                        // 季節を取得または作成
                        $seasonModel = Season::firstOrCreate(['name' => $season]);

                        // 商品と季節を関連付け
                        $product->seasons()->attach($seasonModel->id);
                    }
                }
            }

            // トランザクションをコミット
            DB::commit();

            // 成功した場合、商品の一覧ページなどにリダイレクト
            return redirect('/products');
        } catch (\Exception $e) {
            // エラーが発生した場合、トランザクションをロールバック
            DB::rollBack();

            // エラーメッセージを表示
            return back()->with('error', '商品登録中にエラーが発生しました: ' . $e->getMessage());
        }
    }
}
