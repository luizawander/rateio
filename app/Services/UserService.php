<?php

namespace App\Services;

use App\Enums\PixKeyType;
use App\Models\User;

class UserService
{
    /**
     *
     * @param User $user
     * @param array $data
     * @return User
     */
    public function updateProfile(User $user, array $data): User
    {
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => isset($data['phone']) ? preg_replace('/\D/', '', $data['phone']) : null,
            'gender' => $data['gender'] ?? null,
            'birth_date' => $data['birth_date'] ?? null,
            'pix_key_type' => $data['pix_key_type'] ?? null,
            'pix_key' => isset($data['pix_key']) && PixKeyType::tryFrom($data['pix_key_type'] ?? '')?->isNumeric()
                ? preg_replace('/\D/', '', $data['pix_key'])
                : ($data['pix_key'] ?? null),
            'email_notifications' => isset($data['email_notifications']),
            'due_reminders' => isset($data['due_reminders']),
            'weekly_summary' => isset($data['weekly_summary']),
        ]);

        return $user;
    }

    /**
     * Update user password.
     *
     * @param User $user
     * @param string $newPassword
     * @return User
     */
    public function updatePassword(User $user, string $newPassword): User
    {
        $user->update([
            'password' => \Illuminate\Support\Facades\Hash::make($newPassword),
        ]);

        return $user;
    }
}
