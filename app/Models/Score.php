<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function first_club() {
        return $this->belongsTo(Club::class, "first_club_id", "id");
    }

    public function second_club() {
        return $this->belongsTo(Club::class, "second_club_id", "id");
    }
}
