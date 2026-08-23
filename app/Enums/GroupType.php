<?php

namespace App\Enums;

enum GroupType: string
{
    case CASA = 'casa';
    case VIAGEM = 'viagem';
    case CASAL = 'casal';
    case OUTROS = 'outros';

    public function label(): string
    {
        return match ($this) {
            self::CASA => 'Casa',
            self::VIAGEM => 'Viagem',
            self::CASAL => 'Casal',
            self::OUTROS => 'Outros',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::CASA => 'heroicon-o-home',
            self::VIAGEM => 'heroicon-o-briefcase',
            self::CASAL => 'heroicon-o-heart',
            self::OUTROS => 'heroicon-o-light-bulb',
        };
    }

    public static function options(): array
    {
        $options = [];
        foreach (self::cases() as $case) {
            $options[$case->value] = $case->label();
        }

        return $options;
    }
}
