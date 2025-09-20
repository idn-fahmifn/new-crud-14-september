@extends('template.app')

@section('page-title')
    {{ $data->nama_produk }}
@endsection

@section('sub-title')
    {{ $data->kategori->nama_kategori }}
@endsection

@section('content')
    <div class="card p-2 mt-4">
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
        <div class="d-flex justify-content-between">
            <div class="">
                <div class="card-title h5">Detail {{ $data->nama_produk }}</div>
                <span class="text-muted">{{ $data->kategori->nama_kategori }}</span>
            </div>
            <div class="">
                {{-- button diambil dari dokumentasi modal --}}
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Edit {{ $data->nama_kategori }}
                </button>
            </div>
        </div>
        <div class="table-responsive mt-4">
            <table class="table table-bordered">
                <tr>
                    <td>Nama Produk</td>
                    <td>{{ $data->nama_produk }}</td>
                    <td rowspan="4">
                        <img src="{{ asset('storage/images/barang/'.$data->gambar) }}" width="150" alt="Gambar Produk">
                    </td>
                </tr>
                <tr>
                    <td>Harga</td>
                    <td>IDR. {{ number_format($data->harga) }}</td>
                </tr>
                <tr>
                    <td>Stok</td>
                    <td> {{ $data->stok }}</td>
                </tr>
                <tr>
                    <td>Deskripsi</td>
                    <td> {{ $data->deskripsi }}</td>
                </tr>
                
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit {{ $data->nama_kategori }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('kategori.edit', $data->id) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <div class="form-group mt-2">
                            <label for="">Nama Kategori</label>
                            <input type="text" required name="nama_kategori"
                                value="{{ old('nama_kategori', $data->nama_kategori) }}" class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label for="">Deskripsi</label>
                            <textarea name="deskripsi" required
                                class="form-control">{{ old('deskripsi', $data->deskripsi) }}</textarea>
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