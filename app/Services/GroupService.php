<?php

namespace App\Services;

use App\Models\Group;

class GroupService
{
    public function create(array $data, int $creatorId): Group
    {
        $group = Group::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'type' => $data['type'],
            'created_by' => $creatorId,
        ]);

        $group->members()->attach($creatorId);

        return $group;
    }
}
