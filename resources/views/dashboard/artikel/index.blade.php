@extends('dashboard.layout.main')
@section('content')
<div class="container-fluid px-4">
    <div class="card mt-3">
        <div class="card-body px-4">
            <h1 class="mt-2 mb-4">Artikel</h1>

                @if (Session::get('info'))
                    <div class="alert alert-info">
                        {{ Session::get('info') }}
                    </div>
                @endif

                <a href="/dashboard/artikel/create" class="btn btn-outline-primary mb-2"tittle="tambah slide"><i class="fa-solid fa-plus"></i> Artikel Baru</a>

                <table class="table table-hover table-sm" id="myTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Artikel</th>
                            <th>Kategori</th>
                            <th>Tag</th>
                            <th>opsi</th>
                        </tr>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($articles as $article)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $article->judul }}</td>
                                    {{-- category diperoleh dari relasi category pada model artikel --}}
                                    <td>{{ $article->category->nama }}</td>
                                    <td>
                                        @foreach ($article->tags as $tag)
                                            <button class="btn btn-sm btn-outline-dark mb-1" type="button">{{ $tag->name }}</button>
                                        @endforeach
                                    </td>
                                    <td class="col-1">
                                        <a href="/dashboard/artikel/{{ $article->id }}/edit" class="btn btn-warning btn-sm" title="edit kategori">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        
                                        <form action="/dashboard/artikel/{{ $article->id }}" method="POST" class="d-inline" onsubmit="return confirm('Anda yakin ingin menghapus artikel??')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="hapus artikel">
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