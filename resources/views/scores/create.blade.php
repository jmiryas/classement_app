@extends("layouts.master")

@section("web_title")
Tambah Skor
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
                <h5 class="card-title">Tambah Skor</h5>

                <form method="POST" action="{{ route('scores.store') }}">
                    @csrf

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Klub 1</label>
                        <div class="col-sm-10">
                            <select name="first_club_id" class="form-select" required>
                                @foreach ($clubs as $club)
                                <option value="{{ $club->id }}">{{ $club->name }}</option>
                                @endforeach
                            </select>
                            @error("first_club_id")
                            <small class="form-text text-sm text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Klub 2</label>
                        <div class="col-sm-10">
                            <select name="second_club_id" class="form-select" required>
                                @foreach ($clubs as $club)
                                <option value="{{ $club->id }}">{{ $club->name }}</option>
                                @endforeach
                            </select>
                            @error("second_club_id")
                            <small class="form-text text-sm text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Skor Klub 1</label>
                        <div class="col-sm-10">
                            <input value="{{ old('first_club_score') }}" name="first_club_score" type="number"
                                class="form-control" placeholder="Masukkan skor klub 1" required>
                            @error("first_club_score")
                            <small class="form-text text-sm text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Skor Klub 2</label>
                        <div class="col-sm-10">
                            <input value="{{ old('second_club_score') }}" name="second_club_score" type="number"
                                class="form-control" placeholder="Masukkan skor klub 1" required>
                            @error("second_club_score")
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