<!-- Side widgets-->
<div class="col-lg-4">
    <!-- Search widget-->
    <div class="card mb-4">
        <div class="card-header">Search</div>
        <div class="card-body">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                <button class="btn btn-primary" id="button-search" type="button">Go!</button>
            </div>
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
                            <a href="" class="text-decoration-none text-dark link-primary d-grid d-flex justify-content-between"><span>
                                {{ $categori->nama }}
                            </span><span>0</span></a>
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