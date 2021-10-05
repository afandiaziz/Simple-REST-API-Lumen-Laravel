<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function read(Request $request)
    {
        if ($request->id) {
            $products = Products::findOrFail($request->id);
        } else {
            $products = Products::all();
        }
        return response()->json($products);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'condition' => 'required|in:new,old'
        ]);

        $data = $request->all();
        $execute = Products::create($data);
        return response()->json($execute);
    }

    public function update(Request $request, $id)
    {
        $product = Products::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product Not Found!']);
        }
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'condition' => 'required|in:new,old'
        ]);

        $product->fill($request->all());
        $product->save();

        return response()->json($product);
    }

    public function delete(Request $request, $id)
    {
        $product = Products::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product Not Found!']);
        }
        $product->delete();
        return response()->json(['message' => 'Product Deleted!']);
    }
}
