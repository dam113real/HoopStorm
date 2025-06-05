<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductDetailController extends Controller
{
    public function show(Product $product)
    {
        $product->load(['brand', 'category', 'product_images']);
        return Inertia::render('User/ProductDetail', [
            'product' => $product,
        ]);
    }
}
