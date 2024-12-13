<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'products_seasons', 'season_id', 'product_id');
    }

    public function getJapaneseNameAttribute()
    {
        $names = [
            'spring' => '春',
            'summer' => '夏',
            'autumn' => '秋',
            'winter' => '冬',
        ];

        return $names[$this->name] ?? $this->name; // 該当するキーがない場合はそのまま返す
    }
}
