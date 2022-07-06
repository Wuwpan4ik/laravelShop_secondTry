<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsFilterRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index(ProductsFilterRequest $request) {

        $price_from = $request->price_from === null ? 0 : $request->price_from;
        $price_to = $request->price_to === null ? 10000000 : $request->price_to;

        $productsQuery = Product::with('category');

        $productsQuery->whereBetween('price', [$price_from, $price_to]);

        $productsQuery->when($request->hit, function ($productsQuery) {
            $productsQuery->hit();
        });

        $productsQuery->when($request->recommended, function ($productsQuery) {
            $productsQuery->recommended();
        });

        $productsQuery->when($request->new, function ($productsQuery) {
            $productsQuery->new();
        });

        $products = $productsQuery->paginate(9);
        return view('index', compact('products'));
    }

    public function categories() {
        $categories = Category::get();
        return view('categories', compact('categories'));
    }

    public function category($code) {
        $category_info = Category::where('code', $code)->addSelect('id', 'name', 'description')->first();
        $category = Product::with('category')->where('category_id', $category_info->id)->get();
        return view('category', compact('category', 'category_info'));
    }

    public function product($category, $product) {
        $product = Product::where('code', $product)->first();
        return view('product', compact('product'));
    }
}
