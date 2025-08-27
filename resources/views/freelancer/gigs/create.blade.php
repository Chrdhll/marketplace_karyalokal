@extends('layouts.template')

@section('title', 'Tambah Jasa Baru')

@section('content')
    <section class="login_box_area section_gap mt-5">
        <div class="container py-8">
            <h1 class="text-2xl font-bold mb-4">Tambah Jasa (Gig) Baru</h1>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('freelancer.gigs.store') }}" method="POST" enctype="multipart/form-data">
                        @include('freelancer.gigs._form')

                        <div class="col-md-12 form-group mt-4">
                            <button type="submit" class="btn btn-primary">Simpan Jasa</button>
                            <a href="{{ route('freelancer.gigs.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
