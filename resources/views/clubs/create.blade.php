@extends("layouts.master")

@section("web_title")
Tambah Klub
@endsection

@section("content")
<div class="row">
    <div class="col-lg-12">
        @if (session()->has("error"))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            {{ session()->get("error") }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tambah Klub</h5>

                <form method="POST" action="{{ route('clubs.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Logo (Opsional)</label>
                        <div class="col-sm-10">
                            <small>Maksimum 1MB</small>
                            <input name="logo" class="form-control" type="file" accept="image/png, image/jpeg"
                                id="formFile">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Nama Klub</label>
                        <div class="col-sm-10">
                            <input value="{{ old('name') }}" name="name" type="text" class="form-control"
                                placeholder="Masukkan nama klub" required>
                            @error("name")
                            <small class="form-text text-sm text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Kota/Daerah</label>
                        <div class="col-sm-10">
                            <input value="{{ old('city') }}" name="city" type="text" class="form-control"
                                placeholder="Masukkan kota/daerah klub" required>
                            @error("city")
                            <small class="form-text text-sm text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection