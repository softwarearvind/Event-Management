<?php

namespace App\Http\Controllers\Manager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;


class ProductController extends Controller
{
    public function index()
    {
    	$products = Product::with('images')->where('user_id', auth()->id())->latest()->get();
    	return view('manager.product.index',compact('products'));
    }

    public function create()
    {
    	return view('manager.product.create');
    }

    public function store(Request $request)
    {
    	$request->validate([
        'name' => 'required',
        'price' => 'required',
        'images' => 'required',
        'images.*' => 'image|mimes:jpg,png,jpeg'
    ]);

    $product = Product::create([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'user_id' => auth()->id(),
        'status' => 'pending'
    ]);

    // Multiple images
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $img) {
            $path = $img->store('products', 'public');

            $product->images()->create([
                'image' => $path
            ]);
        }
    }

    return redirect()->back()->with('success', 'Product sent for approval');
    }
}
