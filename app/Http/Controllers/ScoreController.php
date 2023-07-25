<?php

namespace App\Http\Controllers;

use App\Models\Classement;
use App\Models\Club;
use App\Models\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $scores = Score::with(["first_club", "second_club"])->orderBy("created_at", "DESC")->get();

        return view("scores.index", compact("scores"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clubs = Club::orderBy("name")->get();

        return view("scores.create", compact("clubs"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "first_club_id" => "required|exists:clubs,id",
            "second_club_id" => "required|exists:clubs,id",
            "first_club_score" => "required|numeric",
            "second_club_score" => "required|numeric",
        ]);

        if ($request->first_club_id == $request->second_club_id) {
            return redirect(route("scores.create"))->with("error", "Klub yang dipilih harus berbeda!");
        }

        $first_club_hash = hash("md5", $request->first_club_id . "_" . $request->second_club_id);
        $second_club_hash = hash("md5", $request->second_club_id . "_" . $request->first_club_id);

        $score = Score::where("first_score_code", $first_club_hash)
            ->orWhere("first_score_code", $second_club_hash)
            ->orWhere("second_score_code", $first_club_hash)
            ->orWhere("second_score_code", $second_club_hash)
            ->first();

        if ($score == null) {
            Score::create([
                "first_club_id" => $request->first_club_id,
                "second_club_id" => $request->second_club_id,
                "first_club_score" => $request->first_club_score,
                "second_club_score" => $request->second_club_score,
                "first_score_code" => $first_club_hash,
                "second_score_code" => $second_club_hash,
            ]);

            // Mengecek apakah klasemen sudah ada atau tidak

            $first_club_classement = Classement::where("club_id", $request->first_club_id)->first();
            $second_club_classement = Classement::where("club_id", $request->second_club_id)->first();

            $is_seri = $request->first_club_score == $request->second_club_score;
            $is_first_club_win = $request->first_club_score > $request->second_club_score;

            // Membuat klasemen untuk masing masing klub

            if ($first_club_classement == null) {
                if ($is_seri) {
                        Classement::create([
                            "club_id" => $request->first_club_id,
                            "pertandingan_dimainkan" => 1,
                            "menang" => 0,
                            "seri" => 1,
                            "kalah" => 0,
                            "gol_memasukkan" => $request->first_club_score,
                            "gol_kemasukkan" => $request->second_club_score,
                            "selisih_gol" => $request->first_club_score - $request->second_club_score,
                            "poin" => 3 * 0 + 1
                        ]);
                }

                if ($is_first_club_win) {
                    Classement::create([
                        "club_id" => $request->first_club_id,
                        "pertandingan_dimainkan" => 1,
                        "menang" => 1,
                        "seri" => 0,
                        "kalah" => 0,
                        "gol_memasukkan" => $request->first_club_score,
                        "gol_kemasukkan" => $request->second_club_score,
                        "selisih_gol" => $request->first_club_score - $request->second_club_score,
                        "poin" => 3 * 1 + 0
                    ]);
                } else {
                    Classement::create([
                        "club_id" => $request->first_club_id,
                        "pertandingan_dimainkan" => 1,
                        "menang" => 0,
                        "seri" => 0,
                        "kalah" => 1,
                        "gol_memasukkan" => $request->first_club_score,
                        "gol_kemasukkan" => $request->second_club_score,
                        "selisih_gol" => $request->first_club_score - $request->second_club_score,
                        "poin" => 3 * 0 + 0
                    ]);
                }
            } else {
                if ($is_seri) {
                    $first_club_classement->update([
                        "pertandingan_dimainkan" => $first_club_classement->pertandingan_dimainkan + 1,
                        "seri" => $first_club_classement->seri + 1,
                        "gol_memasukkan" => $first_club_classement->gol_memasukkan + $request->first_club_score,
                        "gol_kemasukkan" => $first_club_classement->gol_kemasukkan + $request->second_club_score,
                        "selisih_gol" => $first_club_classement->selisih_gol + ($request->first_club_score - $request->second_club_score),
                        "poin" => $first_club_classement->poin + 1
                    ]);
                }

                if ($is_first_club_win) {
                    $first_club_classement->update([
                        "pertandingan_dimainkan" => $first_club_classement->pertandingan_dimainkan + 1,
                        "menang" => $first_club_classement->menang + 1,
                        "gol_memasukkan" => $first_club_classement->gol_memasukkan + $request->first_club_score,
                        "gol_kemasukkan" => $first_club_classement->gol_kemasukkan + $request->second_club_score,
                        "selisih_gol" => $first_club_classement->selisih_gol + ($request->first_club_score - $request->second_club_score),
                        "poin" => $first_club_classement->poin + 3
                    ]);
                } else {
                    $first_club_classement->update([
                        "pertandingan_dimainkan" => $first_club_classement->pertandingan_dimainkan + 1,
                        "kalah" => $first_club_classement->kalah + 1,
                        "gol_memasukkan" => $first_club_classement->gol_memasukkan + $request->first_club_score,
                        "gol_kemasukkan" => $first_club_classement->gol_kemasukkan + $request->second_club_score,
                        "selisih_gol" => $first_club_classement->selisih_gol + ($request->first_club_score - $request->second_club_score),
                        "poin" => $first_club_classement->poin
                    ]);
                }
            }

            if ($second_club_classement == null) {
                if ($is_seri) {
                    Classement::create([
                        "club_id" => $request->second_club_id,
                        "pertandingan_dimainkan" => 1,
                        "menang" => 0,
                        "seri" => 0,
                        "kalah" => 1,
                        "gol_memasukkan" => $request->second_club_score,
                        "gol_kemasukkan" => $request->first_club_score,
                        "selisih_gol" => $request->second_club_score - $request->first_club_score,
                        "poin" => 3 * 0 + 1
                    ]);
                }

                // Jika klub 1 kalah (klub 2 menang)

                if (!$is_first_club_win) {
                    Classement::create([
                        "club_id" => $request->second_club_id,
                        "pertandingan_dimainkan" => 1,
                        "menang" => 1,
                        "seri" => 0,
                        "kalah" => 0,
                        "gol_memasukkan" => $request->second_club_score,
                        "gol_kemasukkan" => $request->first_club_score,
                        "selisih_gol" => $request->second_club_score - $request->first_club_score,
                        "poin" => 3 * 1 + 0
                    ]);
                } else {
                    Classement::create([
                        "club_id" => $request->second_club_id,
                        "pertandingan_dimainkan" => 1,
                        "menang" => 0,
                        "seri" => 0,
                        "kalah" => 1,
                        "gol_memasukkan" => $request->second_club_score,
                        "gol_kemasukkan" => $request->first_club_score,
                        "selisih_gol" => $request->second_club_score - $request->first_club_score,
                        "poin" => 3 * 0 + 0
                    ]);
                }
            } else {
                if ($is_seri) {
                    $second_club_classement->update([
                        "pertandingan_dimainkan" => $second_club_classement->pertandingan_dimainkan + 1,
                        "seri" => $second_club_classement->seri + 1,
                        "gol_memasukkan" => $second_club_classement->gol_memasukkan + $request->second_club_score,
                        "gol_kemasukkan" => $second_club_classement->gol_kemasukkan + $request->first_club_score,
                        "selisih_gol" => $second_club_classement->selisih_gol + ($request->second_club_score - $request->first_club_score),
                        "poin" => $second_club_classement->poin + 1
                    ]);
                }

                // Jika klub 1 kalah (klub 2 menang)

                if (!$is_first_club_win) {
                    $second_club_classement->update([
                        "pertandingan_dimainkan" => $second_club_classement->pertandingan_dimainkan + 1,
                        "menang" => $second_club_classement->menang + 1,
                        "gol_memasukkan" => $second_club_classement->gol_memasukkan + $request->second_club_score,
                        "gol_kemasukkan" => $second_club_classement->gol_kemasukkan + $request->first_club_score,
                        "selisih_gol" => $second_club_classement->selisih_gol + ($request->second_club_score - $request->first_club_score),
                        "poin" => $second_club_classement->poin + 3
                    ]);
                } else {
                    $second_club_classement->update([
                        "pertandingan_dimainkan" => $second_club_classement->pertandingan_dimainkan + 1,
                        "kalah" => $second_club_classement->kalah + 1,
                        "gol_memasukkan" => $second_club_classement->gol_memasukkan + $request->second_club_score,
                        "gol_kemasukkan" => $second_club_classement->gol_kemasukkan + $request->first_club_score,
                        "selisih_gol" => $second_club_classement->selisih_gol + ($request->second_club_score - $request->first_club_score),
                        "poin" => $second_club_classement->poin
                    ]);
                }
            }

            return redirect(route("scores.index"))->with("success", "Pertandingan berhasil ditambahkan!");
        } else {
            return redirect(route("scores.create"))->with("error", "Pertandingan tersebut sudah ada!");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function show(Score $score)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function edit(Score $score)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Score $score)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function destroy(Score $score)
    {
        //
    }
}
