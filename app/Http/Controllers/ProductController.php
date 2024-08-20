<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function create_product() {
	return view('create_product');
    }

    public function store_product(Request $request) {
	$request->validate([
		'name' => 'required',
		'price' => 'required',
		'description' => 'required',
		'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
		'stock' => 'required'
	]);


	$file = $request->file('image');
	$path = time() . '_' . $request->name . '.' . $file->getClientOriginalExtension();
	
	Storage::disk('local')->put('public/' . $path, file_get_contents($file));

	Product::create([
		'name' => $request->name,
		'price' => $request->price,
		'description' => $request->description,
		'image' => $path,
		'stock' => $request->stock
	]);

	return Redirect::route('index_product');
    }

    public function index_product() {
	$products = Product::all();

	return view('index_product', compact('products'));
    }

    public function show_product(Product $product) {
	return view('show_product', compact('product'));
    }

    public function edit_product(Product $product) {
	return view('edit_product', compact('product'));
    }

    public function update_product(Request $request, Product $product) {
	$request->validate([
		'name' => 'required',
		'description' => 'required',
		'price' => 'required',
		'stock' => 'required',
		'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
	]);

	if ($request->hasFile('image')) {
		$file = $request->file('image');
		$path = time() . '_' . $request->name . '.' . $file->getClientOriginalExtension();
		Storage::disk('local')->put('public/' . $path, file_get_contents($file));
		$product->image = $path;
	}
	
	$product->name = $request->name;
	$product->description = $request->description;
	$product->price = $request->price;
	$product->stock = $request->stock;
	$product->save();
	
	return Redirect::route('index_product');
	
    }

    public function delete_product(Product $product) {
	$product->delete();
	return Redirect::route('index_product');
    }
}
