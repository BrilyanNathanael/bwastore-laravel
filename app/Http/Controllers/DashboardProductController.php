<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DashboardProductController extends Controller
{
            /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::with(['galleries', 'category'])
                            ->where('users_id', Auth::user()->id)
                            ->get();

        return view('pages.dashboard-products', compact('products'));
    }

    public function details(Request $request, $id)
    {
        $product = Product::with(['galleries', 'user', 'category'])->findOrFail($id);
        $categories = Category::all();
        return view('pages.dashboard-products-details', compact('product', 'categories'));
    }

    public function uploadGallery(Request $request)
    {
        $data = $request->all();

        $data['photos'] = $request->file('photos')->store('assets/product', 'public');
        ProductGallery::create($data);

        return redirect()->route('dashboard-product-details', $request->products_id);
    }

    public function deleteGallery(Request $request, $id)
    {
        $item = ProductGallery::findOrFail($id);
        $item->delete();

        return redirect()->route('dashboard-product-details', $item->products_id);
    }

    public function create()
    {
        $categories = Category::all();

        return view('pages.dashboard-products-create', compact('categories'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $product = Product::create([
            'name' => $request->name,
            'users_id' => $request->users_id,
            'categories_id' => $request->categories_id,
            'price' => $request->price,
            'description' => $request->editor,
            'slug' => Str::slug($request->name),
        ]);

        $gallery = [
            'products_id' => $product->id,
            'photos' => $request->file('photo')->store('assets/product', 'public')
        ];

        ProductGallery::create($gallery);

        return redirect()->route('dashboard-product');
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        
        $item = Product::findOrFail($id);

        $data['slug'] = Str::slug($request->name);
        $data['description'] = $request->editor;
        $item->update($data);

        return redirect()->route('dashboard-product');
    }
}
