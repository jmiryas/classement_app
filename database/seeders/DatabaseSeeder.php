<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Classement;
use App\Models\Club;
use App\Models\Score;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $arema = Club::create([
            "name" => "Arema FC",
            "city" => "Kabupaten Malang",
            "logo" => "arema.png"
        ]);

        $bali_united = Club::create([
            "name" => "Bali United FC",
            "city" => "Kabupaten Gianyar",
            "logo" => "bali.png"
        ]);

        $borneo_samarinda = Club::create([
            "name" => "Borneo Samarinda",
            "city" => "Kota Samarinda",
            "logo" => "borneo.png"
        ]);

        $persebaya = Club::create([
            "name" => "Persebaya",
            "city" => "Kota Surabaya",
            "logo" => "persebaya.png"
        ]);

        $persib = Club::create([
            "name" => "Persib",
            "city" => "Kota Bandung",
            "logo" => "persib.png"
        ]);

        $persija = Club::create([
            "name" => "Persija",
            "city" => "Jakarta Pusat",
            "logo" => "persija.png"
        ]);

        // Persib vs Arema

        // 5_1 1_5

        $persib_vs_arema_code = hash("md5", $persib->id . "_" . $arema->id);
        $arema_vs_persib_code = hash("md5", $arema->id . "_" . $persib->id);

        Score::create([
            "first_club_id" => $persib->id,
            "second_club_id" => $arema->id,
            "first_club_score" => 3,
            "second_club_score" => 2,
            "first_score_code" => $persib_vs_arema_code,
            "second_score_code" => $arema_vs_persib_code
        ]);

        // Persija vs Arema

        $persija_vs_arema_code = hash("md5", $persija->id . "_" . $arema->id);
        $arema_vs_persija_code = hash("md5", $arema->id . "_" . $persija->id);

        Score::create([
            "first_club_id" => $persija->id,
            "second_club_id" => $arema->id,
            "first_club_score" => 2,
            "second_club_score" => 2,
            "first_score_code" => $persija_vs_arema_code,
            "second_score_code" => $arema_vs_persija_code
        ]);

        // Pertandingan Persib vs Arema = 3 : 2

        $persib_classement = Classement::create([
            "club_id" => $persib->id,
            "pertandingan_dimainkan" => 1,
            "menang" => 1,
            "seri" => 0,
            "kalah" => 0,
            "gol_memasukkan" => 3,
            "gol_kemasukkan" => 2,
            "selisih_gol" => 1,
            "poin" => 3 * 1 + 0
         ]);

         $arema_classement = Classement::create([
            "club_id" => $arema->id,
            "pertandingan_dimainkan" => 1,
            "menang" => 0,
            "seri" => 0,
            "kalah" => 1,
            "gol_memasukkan" => 2,
            "gol_kemasukkan" => 3,
            "selisih_gol" => -1,
            "poin" => 3 * 0 + 0
         ]);

         // Pertandingan Persija vs Arema = 2 : 2

        $persija_classement = Classement::create([
            "club_id" => $persija->id,
            "pertandingan_dimainkan" => 1,
            "menang" => 0,
            "seri" => 1,
            "kalah" => 0,
            "gol_memasukkan" => 2,
            "gol_kemasukkan" => 2,
            "selisih_gol" => 0,
            "poin" => 3 * 0 + 1
         ]);

        $arema_classement->update([
            "pertandingan_dimainkan" => $arema_classement->pertandingan_dimainkan + 1,
            "menang" => $arema_classement->menang + 0,
            "seri" => $arema_classement->seri + 1,
            "kalah" => $arema_classement->kalah + 0,
            "gol_memasukkan" => $arema_classement->gol_memasukkan + 2,
            "gol_kemasukkan" => $arema_classement->gol_kemasukkan + 2,
            "selisih_gol" => $arema_classement->selisih_gol + 0,
            "poin" => $arema_classement->poin + (3 * 0 + 1)
         ]);
    }
}
