<?php

namespace App\Enums;

enum Gender: string
{
    case FEMININO = 'feminino';
    case MASCULINO = 'masculino';
    case PREFER_NOT_TO_SAY = 'prefer_not_to_say';
    case OTHER = 'other';

    public function label(): string
    {
        return match ($this) {
            self::FEMININO => 'Feminino',
            self::MASCULINO => 'Masculino',
            self::PREFER_NOT_TO_SAY => 'Prefiro não informar',
            self::OTHER => 'Outro',
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
