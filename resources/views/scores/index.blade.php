@extends("layouts.master")

@section("web_title")
Skor
@endsection

@section("content")
<div class="row">
    <div class="col-lg-12">
        @if (session()->has("success"))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            {{ session()->get("success") }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="card-title">Skor</h6>

                    <a href="{{ route('scores.create') }}" class="btn btn-sm btn-primary">Tambah Skor</a>
                </div>

                <table class="table table-responsive datatable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Pertandingan</th>
                            <th scope="col">Skor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($scores as $score)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $score->first_club->name }} vs {{ $score->second_club->name }}</td>
                            <td>{{ $score->first_club_score }} : {{ $score->second_club_score }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center">Tidak ada klub apapun</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection