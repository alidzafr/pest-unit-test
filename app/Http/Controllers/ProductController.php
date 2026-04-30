<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class ProductController extends Controller
{
    public function index()
    {
        // $products = Product::all();
        $products = Product::paginate(10);
        return view('product.index', compact('products'));
    }

    public function create() {}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:25|string',
            'price' => 'required|max:25'
        ]);

        Product::create($validated);
        return redirect()->route('product.index');
    }
}
