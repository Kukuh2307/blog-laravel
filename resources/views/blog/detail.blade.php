@extends('blog.layout.main')
@section('content')
    <!-- Blog entries-->
    <div class="col-lg-8">
        <header class="mb-4 ">
            <h1 class="fw-bolder mb-1">{{ $article->judul }}</h1>
            <div class="text-muted fst-italic mb-2">
                Diposting  {{ date("d M Y", strtotime($article->created_at)) }} oleh {{ $article->user->name }} - Kategori <a href="/artikel?kategori={{ $article->category->slug }}" class="text-decoration-none">
                    {{ $article->category->nama }}
                </a>
            </div>
            @foreach ($article->tags as $tag)
            <a href="/artikel?tag={{ $tag->slug }}" class="badge bg-secondary text-decoration-none link-light">{{ $tag->name }}</a>
            @endforeach
        </header>
        <figure class="mb-4">
            <img src="{{ asset('images/'.$article->gambar) }}" width="700px" alt="{{ $article->slug }}">
        </figure>
        <section class="mb-4">
            {!! $article->isi !!}
            <a href="/artikel" class="text-decoration-none mb-3"><i class="fa-solid fa-arrow-left"></i> Kembali ke Artikel</a>
        </section>
    </div>
@endsection
