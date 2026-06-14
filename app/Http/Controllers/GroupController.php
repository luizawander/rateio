<?php

namespace App\Http\Controllers;

use App\Services\GroupService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function index()
    {
        $groupTypes = [
            'casa' => 'Casa',
            'viagem' => 'Viagem',
            'casal' => 'Casal',
            'outros' => 'Outros'
        ];

        return view('groups', compact('groupTypes'));
    }

    public function store(Request $request, GroupService $groupService)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'type' => ['required', 'string', 'in:casa,viagem,casal,outros'],
        ]);

        $group = $groupService->create($validated, Auth::id());

        return response()->json([
            'success' => true,
            'group' => $group,
            'link' => url('/groups/' . $group->id),
        ]);
    }
}
