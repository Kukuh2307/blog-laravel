@extends('blog.layout.main')
@section('content')
    <!-- Blog entries-->
    <div class="col-lg-8">
        <!-- Featured blog post-->
        <div class="card mb-4 border-0">
            <a href="artikel/{{ $articles[0]->slug }}"><img class="card-img-top rounded-0" src="{{ asset('images/'. $articles[0]->gambar) }}" alt="{{ $articles[0]->slug }}" /></a>
            <div class="card-body">
                <div class="small text-muted">Diposting : {{ date("d M Y", strtotime($articles[0]->created_at)) }} - <br>Kategori <a href="/artikel?kategori={{ $articles[0]->category->slug }} " class="text-decoration-none">{{ $articles[0]->category->nama }}</a></div>
                <h2 class="card-title">{{ $articles[0]->judul }}</h2>
                <p class="card-text">{{ $articles[0]->kutipan }}</p>
                <a class="text-decoration-none" href="artikel/{{ $articles[0]->slug }}">Baca Selengkapnya →</a>
                <div class="mt-3">
                    @foreach ($articles[0]->tags as $tag)
                        <a href="/artikel?tag={{ $tag->slug }}" class="badge bg-secondary text-decoration-none link-light">{{ $tag->name }}</a>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Nested row for non-featured blog posts-->
        <div class="row">
            @foreach ($articles->skip(1) as $article)
                <div class="col-lg-6">
                    <div class="card mb-4 border-0">
                        <a href="artikel/{{ $article->slug }}"><img class="card-img-top rounded-0" src="{{ asset('images/'. $article->gambar) }}" alt="{{ $article->slug }}" /></a>
                        <div class="card-body">
                            <div class="small text-muted">Diposting : {{ date("d M Y", strtotime($article->created_at)) }} -<br>Kategori <a href="/artikel?kategori={{ $article->category->slug }} " class="text-decoration-none">{{ $article->category->nama }}</a></div>
                            <h2 class="card-title">{{ $article->judul }}</h2>
                            <p class="card-text">{{ $article->kutipan }}</p>
                            <a class="text-decoration-none" href="artikel/{{ $article->slug }}">Baca Selengkapnya →</a> <br>
                            @foreach ($article->tags as $tag)
                            <a href="/artikel?tag={{ $tag->slug }}" class="badge bg-secondary text-decoration-none link-light">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <hr>
        <!-- Pagination-->
        {{ $articles->links() }}
    </div>
@endsection
