@extends('blog.layout.main')
@section('content')
    <!-- Blog entries-->
    <div class="col-lg-8">
        {{-- @dd($user); --}}
        @foreach ($user as $usr)
        {{-- @dd($usr->name); --}}
            <h1 class="fw-bolder mb-0">{{ $usr->name }}</h1>
        <header class="mb-4 ">
        </header>
        <figure class="mb-4">
            <img src="{{ asset('images/'.$usr->foto) }}" width="240px" alt="{{ $usr->name }}">
        </figure>
        <section class="mb-4">
            {!! $usr->words !!}
        </section>
        {{-- keahlian --}}
        <h1 class="mt-5 mb-4 fw-bold">Keahlian</h1>
        @foreach (explode(',',$usr->keahlian) as $skill)
            <span class="text-secondary me-3 h3">
                <i class="devicon-{{ strtolower($skill) }}-plain"></i>
            </span>
        @endforeach
        <h1 class="mt-5 mb-4 fw-bold">Telephone</h1>
        <h5 class="text-secondary mb-3"><i class="fa-solid fa-location-dot"></i><span class="ms-2">{{ $usr->alamat }}</span></h5>
        <h5 class="text-secondary mb-3"><i class="fa-solid fa-at"></i><span class="ms-2">{{ $usr->email }}</span></h5>
        <h5 class="text-secondary mb-3"><i class="fa-solid fa-phone"></i><span class="ms-2">{{ $usr->telephone }}</span></h5>
        @endforeach
    </div>
@endsection
