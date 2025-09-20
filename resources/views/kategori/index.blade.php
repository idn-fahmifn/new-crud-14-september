@extends('template.app')

@section('page-title')
    Daftar Kategori Produk
@endsection

@section('sub-title')
    Daftar kategori produk yang ada di <span class="text-success">tokopaedi</span>
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
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                    <th>Pilihan</th>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                    <tr>
                        <td>{{ $item->nama_kategori }}</td>
                        <td>{{ Str::limit($item->deskripsi, 10, '...') }}</td>
                        <td>
                            <form action="" method="post">
                                @csrf

                                <a href="" class="btn text-info">Detail</a>
                                <button type="submit" class="btn text-danger">Hapus</button>

                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center p-4">Data Kategori Kosong ! </td>
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('kategori.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mt-2">
                            <label for="">Nama Kategori</label>
                            <input type="text" required name="nama_kategori" class="form-control">
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
