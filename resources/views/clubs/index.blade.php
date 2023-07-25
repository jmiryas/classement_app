@extends("layouts.master")

@section("web_title")
Klub
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
                    <h6 class="card-title">Klub</h6>

                    <a href="{{ route('clubs.create') }}" class="btn btn-sm btn-primary">Tambah Klub</a>
                </div>

                <table class="table table-responsive datatable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Logo</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Kota</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($clubs as $club)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>
                                @if ($club->logo != null)
                                <img src="{{ asset('images/' . $club->logo) }}" class="img-fluid" style="width: 50px;">
                                @else
                                <img src="{{ asset('images/picture.png') }}" class="img-fluid" style="width: 50px;">
                                @endif
                            </td>
                            <td>{{ $club->name }}</td>
                            <td>{{ $club->city }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada klub apapun</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection