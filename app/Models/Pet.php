<?php

namespace App\Models;

use App\Enums\PetAnimalTypes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'animal_type',
        'tutor_id',
    ];

    protected $casts = [
        'animal_type' =>  PetAnimalTypes::class
    ];

    public function tutor() {
        return $this->belongsTo(Tutor::class);
    }
}
