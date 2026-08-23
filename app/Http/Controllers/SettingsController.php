<?php

namespace App\Http\Controllers;

use App\Enums\Gender;
use App\Enums\PixKeyType;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SettingsController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(): View
    {
        return view('settings.index', [
            'genders' => Gender::options(),
            'pixKeyTypes' => PixKeyType::options(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'phone' => ['nullable', 'string', 'max:20'],
            'gender' => ['nullable', Rule::enum(Gender::class)],
            'birth_date' => ['nullable', 'date'],
            'pix_key_type' => ['nullable', Rule::enum(PixKeyType::class)],
            'pix_key' => ['nullable', 'string', 'max:255'],
            'email_notifications' => ['nullable'],
            'due_reminders' => ['nullable'],
            'weekly_summary' => ['nullable'],
        ]);

        $this->userService->updateProfile($user, $request->all());

        return redirect()->route('settings')->with('status', 'settings-updated');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $user = auth()->user();

        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'current_password.current_password' => 'A senha atual está incorreta.',
            'new_password.confirmed' => 'A confirmação da nova senha não coincide.',
            'new_password.min' => 'A nova senha deve ter pelo menos :min caracteres.',
        ]);

        $this->userService->updatePassword($user, $validated['new_password']);

        return redirect()->route('settings')->with('status', 'password-updated');
    }
}
