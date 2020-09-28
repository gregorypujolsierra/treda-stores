<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse|Response
     */
    public function show($id)
    {
        if (Store::where('id', $id)->exists()){
            $products = Product::where('store_id', $id)->get();
            $productsResponse = array();

            foreach ($products as $product) {
                if (!$product->image) {
                    $product->image = 'http://treda-stores/images/products/noImageAvailable.png';
                }
                $productArray = array(
                    'id' => $product->id,
                    'name' => $product->name,
                    'sku' => $product->sku,
                    'description' => $product->description,
                    'price' => $product->price,
                    'store_id' => $product->store_id,
                    'image' => base64_encode(file_get_contents($product->image)),
                    'created_at' => $product->created_at,
                    'updated_at' => $product->updated_at,
                );

                array_push($productsResponse, $productArray);
            }

            return response($productsResponse, 200);
        } else {
            return response()->json(
                [
                    'status' => 404,
                    'response' => array(
                        'message' => 'Store not found',
                    ),
                ],
                404,
            );
        }

    }
}
