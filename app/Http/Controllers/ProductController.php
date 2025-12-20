<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display all products or filtered by category
     */
    public function index(Request $request)
    {
        $category = $request->get('category', 'all');
        
        // Ambil produk aktif dan filter berdasarkan kategori
        $products = Product::active()
            ->byCategory($category)
            ->get();
        
        return view('products.index', [
            'products' => $products,
            'activeCategory' => $category
        ]);
    }
    
    /**
     * Display single product
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->active()
            ->firstOrFail();
            
        return view('products.show', compact('product'));
    }
}