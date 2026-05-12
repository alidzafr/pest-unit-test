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

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:25|string',
            'price' => 'required|max:25',
            'quantity' => 'required',
            'min_threshold' => 'required',
            'expiry_date' => 'required',
            'availability' =>'required'
        ]);

        Product::create($validated);
        return redirect()->route('product.index');
    }

    public function edit(Product $products)
    {
        return view('product.edit', ['products' => $products]);
    }

    public function update(Request $request, Product $products)
    {
        $validated = $request->validate([
            'name' => 'required|max:25|string',
            'price' => 'required|max:25'
        ]);

        Product::where('id', $products->id)->update($validated);
        return redirect()->route('product.index');
    }

    public function delete(Product $product)
    {
        Product::where('id', $product->id)->delete();
        return redirect()->route('product.index');
    }
}
