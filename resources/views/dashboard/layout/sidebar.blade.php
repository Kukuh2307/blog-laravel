<!-- Sidebar-->
<div class="bg-white" id="sidebar-wrapper">
    <div class="sidebar-heading border-bottom bg-dark text-white">Admin Dasboard</div>
    <div class="list-group list-group-flush">
        <a class="list-group-item list-group-item-action list-group-item-light p-3 {{ $tittle =='About' ? 'active' : '' }}" href="/dashboard">About</a>
        <a class="list-group-item list-group-item-action list-group-item-light p-3 {{ $tittle =='Slide' ? 'active' : '' }}" href="/dashboard/slide/create">Slide</a>
        <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Kategori</a>
        <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Artikel</a>
    </div>
</div>