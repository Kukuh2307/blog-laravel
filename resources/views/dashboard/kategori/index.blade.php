@extends('dashboard.layout.main')
@section('content')
<div class="container-fluid px-4">
    <div class="card mt-3">
        <div class="card-body px-4">
            <h1 class="mt-2 mb-4">Kategori</h1>

                @if (Session::get('info'))
                    <div class="alert alert-info">
                        {{ Session::get('info') }}
                    </div>
                @endif

                <a href="/dashboard/kategori/create" class="btn btn-outline-primary mb-2"tittle="tambah slide"><i class="fa-solid fa-plus"></i> Kategori Baru</a>

                <table class="table table-hover table-sm" id="myTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Slug</th>
                            <th>Opsi</th>
                        </tr>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($kategories as $kategori)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td class="col-6">{{ $kategori->nama }}</td>
                                    <td class="col-6">{{ $kategori->slug }}</td>
                                    <td class="col-2">
                                        <a href="/dashboard/kategori/{{ $kategori->id }}/edit" class="btn btn-warning btn-sm" title="edit kategori">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        
                                        <form action="/dashboard/kategori/{{ $kategori->id }}" method="POST" class="d-inline" onsubmit="return confirm('Anda yakin ingin menghapus kategori??')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="hapus kategori">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </thead>
                </table>
        </div>
    </div>
</div>
@endsection