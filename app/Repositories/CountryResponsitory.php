<?php

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use App\Models\Country;

class CountryResponsitory extends Repository {
    protected $model;

    public function model() {
        return 'App\Models\Country';
    }

    public function arrCountries() {
    	$arrCountries = [];
    	$countries = Country::all();
    	foreach($countries as $country) {
    		$arrCountries[$country->id] = $country->name;
    	}
    	return $arrCountries;
    }

    public function getMaxCode() {
        return Country::max('code');
    }
}
