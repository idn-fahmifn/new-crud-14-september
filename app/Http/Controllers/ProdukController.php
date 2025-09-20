<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $data = Produk::all();
        $kategori = Kategori::all();
        return view('produk.index', 
        compact('data', 'kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => ['string', 'required','min:3', 'max:20'],
            'harga' => ['numeric', 'required','min:1000', 'max:100000000'],
            'stok' => ['numeric', 'required','min:0', 'max:999'],
            'gambar' => ['file', 'required', 'max:10240', 'mimes:jpg,jpeg,png,svg,webv,heic'],
            'deskripsi' => ['required'],
            'id_kategori' => ['required','numeric'],
        ]);

        $simpan = [
            'nama_produk' => $request->input('nama_produk'),
            'harga' => $request->input('harga'),
            'stok' => $request->input('stok'),
            'deskripsi' => $request->input('deskripsi'),
            'id_kategori' => $request->input('id_kategori'),
        ];

        // kondisi ketika ada file yang diinputkan
        if($request->hasFile('gambar'))
        {
            $image = $request->file('gambar'); //mendapatkan file
            $path = 'public/images/barang'; //path untukl penyimpanan

            $nama = 'gambar_barang_'.Carbon::now()
            ->format('Ymdhis').'.'.$image
            ->getClientOriginalExtension(); //gambar_barang_tanggal.jpg

            $simpan['gambar'] = $nama; //data yang akan dikirimkan ke database diambil dari variable nama
            $image->storeAs($path, $nama); //menyimpan ke folder storage
        }

        Produk::create($simpan);
        return redirect()->route('produk.index')
        ->with('success', "Produk berhasil ditambahkan");
    }

    public function detail($id)
    {
        $data = Produk::findOrFail($id);
        return view('produk.detail', compact('data'));
    }

    public function edit(Request $request, $id)
    {
        $data = Kategori::findOrFail($id); //mencari data yang akan diedit
        $request->validate([
            'nama_kategori' => ['string', 'required','min:3', 'max:20'],
            'deskripsi' => ['required'],
        ]);
        $data->update([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi
        ]);
        return back()->with('success', 'Data berhasil dibuat');
    }

    public function destroy($id)
    {
        $data = Kategori::findOrFail($id); //mencari data yang akan dihapus
        $data->delete();
        return back()->with('success', 'Data berhasil dihapus');
    }
}
