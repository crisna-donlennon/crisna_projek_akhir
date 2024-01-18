<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function ProductView($id)
    {
        $product = Product::where('id', $id)->get();
        return view('product', compact('product')); // Assuming your home view is in the 'resources/views/home' directory
    }
    public function create()
    {
        return view('dashboard.createproduct', [
            'types' => Type::all()
        ]);
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'nama_product' => 'required|max:225',
            'type_id' => 'required',
            'gambar' => 'image|file',
            'deskripsi' => 'required',
            'stok' => 'required|numeric',
            'harga' => 'required'
        ]);

        if ($request->file('gambar')) {
            $validatedData['gambar'] = $request->file('gambar')->store('assets', 'public');
        }

        Product::create($validatedData);
        return redirect("/dashboard/product")->with('success', 'Successfully added a new Post!');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $types = Type::all();
        return view('dashboard.editproduct', compact(['product', 'types']));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_product' => 'required',
            'deskripsi' => 'required',
            'stok' => 'required|numeric',
            'harga' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Contoh validasi untuk gambar
            'type_id' => 'required|exists:types,id', // Memastikan type_id ada dalam tabel types
            // Tambahkan validasi lain sesuai kebutuhan
        ]);

        $product = Product::find($id);
        $product->nama_product = $request->input('nama_product');
        $product->deskripsi = $request->input('deskripsi');
        $product->stok = $request->input('stok');
        $product->harga = $request->input('harga');

        // Upload gambar (jika ada perubahan gambar)
        if ($request->hasFile('gambar')) {
            // hapus existing gambar
            if ($product->gambar) {
                Storage::disk('public')->delete($product->gambar);
            }
            // end of hapus existing gambar
            $gambarPath = $request->file('gambar')->store('assets', 'public');
            $product->gambar = $gambarPath;
        }

        $product->type_id = $request->input('type_id');
        // Update atribut lain sesuai kebutuhan

        $product->save();

        return redirect('/dashboard/product')->with('success', 'Produk berhasil diupdate');
    }









    public function delete($id)
    {
        $product = Product::find($id);

        if ($product) {
            $product->delete();
            return redirect('/dashboard/product')->with('success', 'Post deleted successfully');
        } else {
            return redirect('/dashboard/product')->with('error', 'Post not found');
        }
    }
}
