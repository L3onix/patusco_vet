<?php

namespace App\Enums;

enum PetAnimalTypes: string
{
    case DOG = 'cachorro';
    case CAT = 'gato';
    case BIRD = 'pássaro';
    case OTHER = 'outro';
}
