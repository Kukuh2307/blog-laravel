@extends('dashboard.layout.main')
@section('content')
<div class="container-fluid px-4">
    <div class="card mt-3">
        <div class="card-body px-4">
            <div class="d-flex justify-content-between col-lg">
                <h1 class="mt-2 mb-4">Edit Artikel</h1>
                <div class="mt-3">
                    <a href="/dashboard/artikel" class="btn btn-transparent text-primary mb-2"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
            <div class="col-lg">
                @if (Session::get('info'))
                    <div class="alert alert-info">
                        {{ Session::get('info') }}
                    </div>
                @elseif($errors->any())
                    <div class="alert alert-danger">
                        {{ 'Edit Artikel gagal' }}
                    </div>
                @endif
                <form action="/dashboard/artikel/{{ $article->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    {{-- judul --}}
                    <div class="mb-3">
                        <label for="judul" class="form-label">Nama Artikel</label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" id="artikel" name="judul" value="{{ old('judul',$article->judul) }}" onkeyup="getSlug()">
                        @error('judul')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- slug --}}
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug',$article->slug) }}" readonly>
                        @error('slug')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- kategori --}}
                    <div class="mb-3">
                        <label for="category" class="form-label">Kategori</label>
                        <select name="category_id" id="" class="form-select @error('category_id') is-invalid @enderror">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"{{ $article->category_id == $category->id ? 'selected' : '' }} >{{ $category->nama }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- gambar --}}
                    {{-- fungsi tampil gambar berada di bagian main --}}
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input type="hidden" value="{{ $article->gambar }}" name="gambarLama">
                        @if ($article->gambar)
                            <img src="{{ asset('images/'.$article->gambar) }}" class="img-fluid tampil-gambar mb-3 col-lg-5 d-block" width="500px" alt="">
                        @else
                            <img src="" alt="" width="500px" class="img-fluid tampil-gambar mb-3 col-lg-5 d-block">
                        @endif

                        <input type="file" class="form-control @error('judul') is-invalid @enderror" name="gambar" id="gambar" onchange="tampilGambar()">
    
                        @error('gambar')    
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Tag --}}
                    <div class="mb-3">
                        <label for="tag" class="form-label">Tag (Pisahkan dengan koma)</label>
                        <input type="text" class="form-control @error('tag') is-invalid @enderror" id="tokenfield" name="tag" value="{{ old('tag',$tags) }}">
                        @error('tag')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- isi --}}
                    <div class="mb-3">
                        <label for="isi" class="form-label">Isi</label>
                        @error('isi')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <textarea name="isi" class="form-control" id="editor">{{ old('isi',$article->isi) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa-solid fa-save"></i> Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function getSlug(){
        $.get('{{ url('/slug-artikel') }}', {'judul': $('#artikel').val()},
            function (data){
                $('#slug').val(data.slug)
            }
        )
    }
</script>
@endsection