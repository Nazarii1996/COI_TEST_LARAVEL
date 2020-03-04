<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Product\StoreProduct;
use App\Product;
use App\Prices;
use Image;
use App\Helpers\Privatbank;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProduct $request)
    {
        $product = new Product;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->user_id=\Auth::user()->id;;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save(public_path('images/' . $filename));
            $product->image = 'images/'.$filename;

        };
        $product->save();


        $prices = Privatbank::convert($product->price);

        foreach ($prices as $currency => $price) {
            $price_data = new Prices;
            $price_data->price = $price;
            $price_data->currency = $currency;
            $product->prices()->save($price_data);
        }

        $request->session()->flash('alert-success', 'Your product was added!');

        return redirect()->route("home");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product=Product::find($id);
        return view('product.show',['product'=>$product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {

        $product=Product::findOrFail($id);
        if($product->user_id!=\Auth::user()->id){
            return abort(404);

        }
        $product->prices()->delete();
        $product->delete();
        $request->session()->flash('alert-success', 'Your product was deleted!');

        return redirect()->route("home");
    }
}
