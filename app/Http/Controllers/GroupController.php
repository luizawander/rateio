<?php

namespace App\Http\Controllers;

use App\Enums\GroupType;
use App\Services\GroupService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class GroupController extends Controller
{
    public function index()
    {
        $groupTypes = GroupType::options();

        $groups = Auth::user()->groups()->with('members')->latest()->get();

        return view('groups.index', compact('groupTypes', 'groups'));
    }

    public function store(Request $request, GroupService $groupService)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'type' => ['required', Rule::enum(GroupType::class)],
            'custom_type' => ['required_if:type,outros', 'nullable', 'string', 'max:255'],
        ]);

        if ($validated['type'] === GroupType::OUTROS->value) {
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
