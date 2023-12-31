@extends("layouts.master")

@section("web_title")
Klasemen
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
                    <h6 class="card-title">Klasemen</h6>
                </div>

                <div class="row align-items-center justify-content-center mb-4">
                    <div class="col-12 col-md-6">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">PD</div>
                            </div>
                            <span>Permainan Dimainkan</span>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">M</div>
                            </div>
                            <span>Menang</span>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">S</div>
                            </div>
                            <span>Seri</span>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">K</div>
                            </div>
                            <span>Kalah</span>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">GM</div>
                            </div>
                            <span>Gol Memasukkan</span>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">GK</div>
                            </div>
                            <span>Gel Kemasukkan</span>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">SG</div>
                            </div>
                            <span>Selisih Gol</span>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Poin</div>
                            </div>
                            <span>Poin Didapatkan</span>
                        </div>
                    </div>
                </div>

                <table class="table table-responsive datatable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Klub</th>
                            <th scope="col">PD</th>
                            <th scope="col">M</th>
                            <th scope="col">S</th>
                            <th scope="col">K</th>
                            <th scope="col">GM</th>
                            <th scope="col">GK</th>
                            <th scope="col">SG</th>
                            <th scope="col">Poin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($classements as $classement)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $classement->club->name }}</td>
                            <td>{{ $classement->pertandingan_dimainkan }}</td>
                            <td>{{ $classement->menang }}</td>
                            <td>{{ $classement->seri }}</td>
                            <td>{{ $classement->kalah }}</td>
                            <td>{{ $classement->gol_memasukkan }}</td>
                            <td>{{ $classement->gol_kemasukkan }}</td>
                            <td>
                                @if ($classement->selisih_gol > 0)
                                <span class="text-success fw-bold">+{{ $classement->selisih_gol }}</span>
                                @else
                                <span class="text-danger fw-bold">{{ $classement->selisih_gol }}</span>
                                @endif
                            </td>
                            <td>
                                <span class="fw-bold">{{ $classement->poin }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center">Tidak ada klub apapun</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection