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

        $groups = Auth::user()->groups()->with('members')->latest()->get();

        return view('groups.index', compact('groupTypes', 'groups'));
    }

    public function store(Request $request, GroupService $groupService)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'type' => ['required', 'string', 'in:casa,viagem,casal,outros'],
            'custom_type' => ['required_if:type,outros', 'nullable', 'string', 'max:255'],
        ]);

        if ($validated['type'] === 'outros') {
            $validated['type'] = $validated['custom_type'];
            unset($validated['custom_type']);
        }

        $group = $groupService->create($validated, Auth::id());

        return response()->json([
            'success' => true,
            'group' => $group,
            'link' => url('/groups/' . $group->id),
        ]);
    }
}
