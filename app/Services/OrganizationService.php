<?php

namespace App\Services;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;


class OrganizationService
{
    /**
     * @return Collection<int,Organization>
     */
    public function findAll(): Collection
    {
        return Organization::query()->where('owner_id', Auth::id())->get();
    }

    public function create(string $title): Organization
    {
        $org =  Organization::query()->create([
            'title' => $title,
            'owner_id' => Auth::id()
        ]);

        $org->members()->attach(Auth::id(), ['role' => 'owner']);
        return $org;
    }

    public function update(int $id, string $title): bool
    {
        $org = Organization::query()->find($id);
        if($org->owner()->id == Auth::id()){
            return $org->update([
                    'title' => $title,
                    'owner_id' => Auth::id()
                ]);
        }
        return false;
    }

    public function delete(int $id): bool
    {
        $org = Organization::query()->find($id);
        if($org->owner()->id == Auth::id()){
            return $org->deleteOrFail();
        }
        return false;
    }

    public function addMember(int $orgId, int $userId, string $role = 'member'): bool
      {
          $org = Organization::query()->findOrFail($orgId);

          // Only owner can add
          if ($org->owner_id !== Auth::id()) {
              return false;
          }

          $org->members()->syncWithoutDetaching([$userId => ['role' => $role]]);
          return true;
      }

      public function removeMember(int $orgId, int $userId): bool
      {
          $org = Organization::query()->findOrFail($orgId);

          if ($org->owner_id !== Auth::id()) {
              return false;
          }

          // Don’t remove the actual owner from membership
          if ($userId === $org->owner_id) {
              return false;
          }

          $org->members()->detach($userId);
          return true;
      }

      public function changeRole(int $orgId, int $userId, string $role): bool
      {
          $org = Organization::query()->findOrFail($orgId);

          if ($org->owner_id !== Auth::id()) {
              return false;
          }

          return (bool) $org->members()->updateExistingPivot($userId, ['role' => $role]);
      }
}
