<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'role_user';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'role_id'
    ];

    /**
     * Get the role record associated with the user.
     */
    public function role()
    {
        return $this->hasOne('App\Models\Role');
    }

    /**
     * Get the user record associated with the role.
     */
    public function user(){
        return $this->hasOne('App\Models\User');
    }
}
