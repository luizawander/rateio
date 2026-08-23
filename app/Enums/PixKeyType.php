<?php

namespace App\Enums;

enum PixKeyType: string
{
    case CPF = 'cpf';
    case CNPJ = 'cnpj';
    case EMAIL = 'email';
    case PHONE = 'phone';
    case RANDOM_KEY = 'random_key';

    public function label(): string
    {
        return match ($this) {
            self::CPF => 'CPF',
            self::CNPJ => 'CNPJ',
            self::EMAIL => 'E-mail',
            self::PHONE => 'Telefone',
            self::RANDOM_KEY => 'Chave Aleatória',
        };
    }

    public function isNumeric(): bool
    {
        return match ($this) {
            self::CPF, self::CNPJ, self::PHONE => true,
            self::EMAIL, self::RANDOM_KEY => false,
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
