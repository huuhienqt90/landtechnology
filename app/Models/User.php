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
        'email_paypal',
        'username',
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
     * Has many user metas
     *
     * @return [type] [description]
     */
    public function metas() {
        return $this->hasMany('App\Models\UserMeta');
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

    public function getAvatarByEmail($size=64){
        $gravatar_link = 'http://www.gravatar.com/avatar/' . md5($this->email) . '?s='.$size;
        return '<img src="' . $gravatar_link . '" />';
    }

    public function getBalances(){
        $balances = $this->metas->where('key', 'balances');
        if( $balances->count() && is_numeric($balances->first()->value)){
            return number_format($balances->first()->value, 2);
        }else{
            return number_format(0, 2);
        }
    }
}
