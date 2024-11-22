<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ListProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('list-product.index', compact('products'));
    }
}
