<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $products = Product::paginate(config('app.default_pagination', 5));

        return view('products.index', compact(['products']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $stores = Store::all();

        return view('products.create', compact('stores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(ProductRequest $request)
    {
        $price = $request->get('price') ?? 0;
        $store_id = (int)$request->get('store') ?? null;

        $product = new Product(
            [
                'name' => $request->get('name'),
                'sku' => $request->get('sku'),
                'description' => $request->get('description'),
                'price' => $price,
            ]
        );

        $product->store_id = $store_id;

        if ($request->file('image')) {
            $path = Storage::disk('public')->put('images/products', $request->file('image'));
            $product->image = asset($path);
        }

        $product->save();

        return redirect()->route('products.index')->with($type = 'success', 'Product was created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|RedirectResponse|Factory|View
     */
    public function edit(int $id)
    {
        $product = Product::find($id);
        $stores = Store::all();

        return view('products.edit', compact(['product', 'stores']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductRequest $request
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(ProductRequest $request, int $id)
    {
        $name = $request->get('name');
        $sku = $request->get('sku');
        $price = $request->get('price') ?? 0;
        $store_id = (int)$request->get('store') ?? null;

        $product = Product::find($id);

        if ($product->sku != $sku) {
            $product->sku = $sku;
        }
        if ($product->name != $name) {
            $product->name = $name;
        }
        $product->description = $request->get('description');
        if ($request->file('image')) {
            $path = Storage::disk('public')->put('images/products', $request->file('image'));
            $product->image = asset($path);
        } else {
            $product->image = '';
        }
        $product->price = $price;
        $product->store_id = $store_id;

        $product->save();

        return redirect()->route('products.index')->with($type = 'success', 'Product was updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(int $id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route('products.index')->with($type = 'success', 'The product was deleted!');
    }
}
