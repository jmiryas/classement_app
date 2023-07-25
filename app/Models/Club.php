<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function classements() {
        return $this->hasMany(Classement::class);
    }

    public function scores() {
        return $this->hasMany(Score::class);
    }
}
