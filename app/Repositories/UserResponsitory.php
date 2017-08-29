<?php

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use App\Models\User;

class UserResponsitory extends Repository {
    protected $model;

    public function model() {
        return 'App\Models\User';
    }

    public function verify($confirm_code, $id){
        $user = $this->where('confirm_code', $confirm_code)->where('id', $id)->first();
        if(count($user) == 0){
            return redirect()->route('seller.create')->with('error','Invalid code please try again');
        }
        else{
            $this->where('confirm_code', $confirm_code)
          ->where('id',$id)
          ->update(['confirm_code' => 'null', 'confirmed' => '1']);
          return redirect()->route('seller.dashboard');
        }
    }
}
