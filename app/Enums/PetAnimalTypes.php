<?php

namespace App\Enums;

enum PetAnimalTypes: string
{
    case DOG = 'cachorro';
    case CAT = 'gato';
    case BIRD = 'pássaro';
    case OTHER = 'outro';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function labels(): array
    {
        return array_map(fn ($case) => ucfirst($case->value), self::cases());
    }
}
