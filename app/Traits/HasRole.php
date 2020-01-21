<?php

namespace App\Traits;

use App\Models\Module;
use App\Models\Role;

trait HasRole
{
    /**
     * Undocumented function
     *
     * @return void
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Undocumented function
     *
     * @return array
     */
    public function modules()
    {
        $ids = [];

        foreach ($this->roles as $role) {
            foreach ($role->modules as $module) {
                array_push($ids, $module->id);
            }
        }

        return Module::whereIn('id', $ids)->get();
    }

    /**
     * Undocumented function
     *
     * @param [type] $role
     * @return void
     */
    public function assignRole($role)
    {
        if (is_string($role)) {
            $role = Role::where('name', $role)->first();

            if ($role) {
                return $this->roles()->attach($role->id);
            }
        }

        if (is_array($role)) {
            $roles = Role::whereIn('name', $role)->pluck('id');

            if ($roles) {
                return $this->roles()->sync($roles);
            }
        }

        return null;
    }

    /**
     * Undocumented function
     *
     * @param [type] $role
     * @return void
     */
    public function removeRole($role)
    {
        if (is_string($role)) {
            $role = Role::where('name', $role)->first();

            if ($role) {
                return $this->roles()->detach($role->id);
            }
        }

        if (is_array($role)) {
            $roles = Role::whereIn('name', $role)->pluck('id');

            if ($roles) {
                return $this->roles()->detach($roles);
            }
        }

        return null;
    }

    /**
     * Undocumented function
     *
     * @param [type] $role
     * @return boolean
     */
    public function hasRole($role): bool
    {
        $roles = $this->roles()->pluck('name')->toArray();

        return in_array($role, $roles);
    }

    /**
     * Undocumented function
     *
     * @param [type] $permission
     * @return boolean
     */
    public function hasPermissionTo($permission, $module = 'default'): bool
    {
        return false;
    }
}
