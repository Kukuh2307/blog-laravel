@extends('blog.layout.main')
@section('content')
<div class="row justify-content-center my-3">
    <div class="col-lg-4">
        <form action="" method="POST">
            @csrf
            <div class="px-2 text-center">
                <img src="{{ asset('blog') }}/assets/write.png" alt="" class="mt-4">
                <h3 class="mt-2">{{ config('app.name') }}</h3>

                {{-- email --}}
                <input type="email"name="email" class="form-control rounded py-2 px-3 mt-4 @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Masukkan email anda">
                @error('email')    
                    <div class="invalid-feedback text-start ps-3">
                        {{ $massage }}
                    </div>
                @enderror

                {{-- password --}}
                <input type="password"name="password" class="form-control rounded py-2 px-3 mt-4 @error('password') is-invalid @enderror" placeholder="Masukkan password anda">
                @error('password')
                <div class="invalid-feedback text-start ps-3">
                    
                </div>
                @enderror
                <div class="d-grid mb-3">
                    <button type="submit" name="submit" class="btn btn-primary rounded mt-4">Login</button>
                    <hr class="mb-5">
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
