<!-- Sidebar-->
<div class="bg-white" id="sidebar-wrapper">
    <div class="sidebar-heading border-bottom bg-dark text-white">Admin Dasboard</div>
    <div class="list-group list-group-flush">
        <a class="list-group-item list-group-item-action list-group-item-light p-3 {{ $tittle =='About' ? 'active' : '' }}" href="/dashboard">About</a>
        <a class="list-group-item list-group-item-action list-group-item-light p-3 {{ $tittle =='Slide' ? 'active' : '' }}" href="/dashboard/slide">Slide</a>
        <a class="list-group-item list-group-item-action list-group-item-light p-3 {{ $tittle =='Kategori' ? 'active' : '' }}" href="/dashboard/kategori">Kategori</a>
        <a class="list-group-item list-group-item-action list-group-item-light p-3 {{ $tittle =='Artikel' ? 'active' : '' }}" href="/dashboard/artikel">Artikel</a>
    </div>
</div>