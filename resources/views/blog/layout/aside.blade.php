<!-- Side widgets-->
<div class="col-lg-4">
    <!-- Search widget-->
    <div class="card mb-4 border-0">
        <div class="card-header bg-transparent fw-bold fs-5" style="border-bottom: 2px solid black">Pencarian</div>
        <div class="card-body">
            <form action="/artikel">
                <div class="input-group">
                    <input type="text" name="cari" class="form-control border-0 border-bottom rounded-0" placeholder="Masukkan kata kunci pencarian">
                    <button type="submit" class="btn btn-light border-bottom"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
        </div>
    </div>
    <!-- Categories widget-->
    <div class="card mb-4 border-0">
        <div class="card-header bg-transparent fw-bold fs-5" style="border-bottom: 2px solid black">{{ $categoriesTittle }}</div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm">
                    @foreach ($categories as $categori)    
                    <ul class="list-unstyled mb-0">
                        <li class="mb-1">
                            <a href="/artikel?kategori={{ $categori->slug }}" class="text-decoration-none text-dark link-primary d-grid d-flex justify-content-between"><span>
                                {{ $categori->nama }}
                            </span><span>
                                @if ($categori->articles->count() !== null)
                                    {{ $categori->articles->count() }}
                                @endif   
                            </span></a>
                        </li>
                    </ul>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Side widget-->
    <div class="card mb-4">
        <div class="card-header">Side Widget</div>
        <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and feature the Bootstrap 5 card component!</div>
    </div>
</div>