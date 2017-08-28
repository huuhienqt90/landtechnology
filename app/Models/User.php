<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'is_admin',
        'is_buyer',
        'is_seller',
        'status',
        'first_name',
        'last_name',
        'address1',
        'address2',
        'country',
        'postal_code',
        'region',
        'is_notify',
        'confirm_code',
        'confirmed',
        'created_by',
        'updated_by',
        'remember_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Belong to Role
     *
     * @return [type] [description]
     */
    public function roles() {
        return $this->belongsToMany('App\Models\Role', 'user_roles', 'user_id', 'role_id');
    }

    /**
     * Scope active
     *
     */
    public function scopeActive($query) {
        return $query->whereStatus('active');
    }

    /**
     * Scope buyer
     *
     */
    public function scopeBuyer($query) {
        return $query->whereIsBuyer('1');
    }

    /**
     * Scope seller
     *
     */
    public function scopeSeller($query) {
        return $query->whereIsSeller('1');
    }

    /**
     * Scope admin
     *
     */
    public function scopeAdmin($query) {
        return $query->whereIsAdmin('1');
    }

    /**
     * Scope notify
     *
     */
    public function scopeNotify($query) {
        return $query->whereNotify('1');
    }

    /**
     * Attach role
     *
     */
    public function attachRole($role) {
        if (is_object($role)) {
            $role = $role->getKey();
        }
        if (is_array($role)) {
            $role = $role['id'];
        }
        $this->roles()->attach($role);
    }

    /**
     * [detachRole description]
     *
     * @param  [type] $role [description]
     * @return [type]       [description]
     */
    public function detachRole($role) {
        if (is_object($role)) {
            $role = $role->getKey();
        }
        if (is_array($role)) {
            $role = $role['id'];
        }
        $this->roles()->detach($role);
    }

    /**
     * [attachRoles description]
     *
     * @param  [type] $roles [description]
     * @return [type]        [description]
     */
    public function attachRoles($roles) {
        foreach ($roles as $role) {
            $this->attachRole($role);
        }
    }

    /**
     * [detachRoles description]
     *
     * @param  [type] $roles [description]
     * @return [type]        [description]
     */
    public function detachRoles($roles) {
        foreach ($roles as $role) {
            $this->detachRole($role);
        }
    }

    /**
     * Check user is supper admin or not
     *
     * @return boolean
     */
    public function isSuperUser() {
        return (bool)$this->is_admin;
    }

    /**
     * Get roles
     *
     * @return list roles
     */
    public function getRoles() {
        $roles = [];
        if ($this->roles()) {
            $roles = $this->roles()->get();
        }
        return $roles;
    }

    /**
     * Get user full name
     */
    public function getFullName(){
        return $this->first_name. " " . $this->last_name;
    }
}
