<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class productController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($params)
    {
        $products = DB::table('products')->where('id', $params)->orwhere('kategori', $params)->get();
        return response()->json(

            [
                "message" => "success",
                "data"    => $products
            ]
        );
    }

    /**
     * Show the form for creating a new resource.s
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.formUpload');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $request->validate([
            'kategori' => 'required',
            'namaProduk' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
            'fotoProduk' => 'required|mimes:jpeg,png,jpg,gif,svg|max:4096',


        ]);

        $namaFoto =  $request->kategori . $request->namaProduk . '-' . time() . '.' .  $request->fotoProduk->extension();

        $request->fotoProduk->move(public_path('images'), $namaFoto);


        $product = new product;

        $product->kategori = $request->kategori;
        $product->nama_produk = $request->namaProduk;
        $product->harga_produk = $request->harga;
        $product->deskripsi_produk = $request->deskripsi;
        $product->foto_produk = '/images' . '/' . $namaFoto;
        $product->save();

        return redirect('/product/show');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        $products = product::paginate(4);
        return view('product.products', compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product, $id)
    {
        $products = product::find($id);
        return view('product.productEdit', compact('products'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'kategori' => 'required',
            'namaProduk' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
            'fotoProduk' => 'mimes:jpeg,png,jpg,gif,svg|max:4096',


        ]);

        $namaFoto = null;

        if ($request->fotoProduk) {

            $namaFoto =  $request->kategori . '-' . $request->namaProduk . '-' . time() . '.' .  $request->fotoProduk->extension();

            $request->fotoProduk->move(public_path('images'), $namaFoto);
        }


        $product = product::find($id);
        $product->kategori = $request->kategori;
        $product->nama_produk = $request->namaProduk;
        $product->harga_produk = $request->harga;
        $product->deskripsi_produk = $request->deskripsi;
        if ($namaFoto) {
            $product->foto_produk = '/images' . '/' . $namaFoto;
        } else {
            $product->foto_produk = $product->foto_produk;
        }

        $product->save();

        return redirect('/product/show');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product, $id)
    {
        product::find($id)->delete();
        return redirect('/product/show');
    }
}
