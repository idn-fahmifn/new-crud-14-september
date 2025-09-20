@extends('template.app')

@section('page-title')
    Daftar Produk
@endsection

@section('sub-title')
    Daftar produk yang ada di <span class="text-success">tokopaedi</span>
@endsection

@section('content')
    <div class="card p-2 mt-4">
        <div class="d-flex justify-content-between">
            <div class="">
                <div class="card-title h6">Data Produk</div>
                <span class="text-muted">sub title Lorem ipsum dolor sit amet.</span>
            </div>
            <div class="">
                {{-- button diambil dari dokumentasi modal --}}
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Tambah
                </button>
            </div>
        </div>

        {{-- menampilkan alert error --}}
        @if ($errors->any())
            <div class="alert alert-warning alert-dismissible fade show my-3" role="alert">
                <strong>Gagal!</strong>
                <ul>
                    @foreach ($errors->all() as $item)
                        <li>{{$item}}</li>
                    @endforeach
                </ul>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show my-3" role="alert">
                <strong>Yeay!</strong> {{session('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif



        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Pilihan</th>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                    <tr>
                        <td>{{ $item->nama_produk }}</td>
                        <td>{{ $item->kategori }}</td>
                        <td>
                            <form action="{{ route('produk.destroy', $item->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <a href="{{ route('produk.detail', $item->id) }}" class="btn text-info">Detail</a>
                                <button type="submit" class="btn text-danger" onclick="return confirm('yakin mau dihapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center p-4">Data Produk Kosong ! </td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Produk</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('kategori.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mt-2">
                            <label for="">Nama Produk</label>
                            <input type="text" required name="nama_produk" class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label for="">Kategori</label>
                            <select name="id_kategori" required class="form-control">
                                <option value="">-Pilih Kategori-</option>
                                @foreach ($kategori as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <label for="">Harga</label>
                            <input type="number" required name="harga" class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label for="">Stok</label>
                            <input type="number" required name="stok" class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label for="">Gambar Produk</label>
                            <input type="file" required name="gambar" class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label for="">Deskripsi</label>
                            <textarea name="deskripsi" required class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>

                </form>


            </div>
        </div>
    </div>
@endsection
