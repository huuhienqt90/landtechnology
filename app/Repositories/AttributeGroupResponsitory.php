<?php

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use App\Models\AttributeGroup;

class AttributeGroupResponsitory extends Repository {
    protected $model;

    public function model() {
        return 'App\Models\AttributeGroup';
    }

    public function getParent($groupID = 0, $parent = 0) {
        if( $groupID ) {
            return AttributeGroup::where('id', '!=', $groupID)->get();
        }
        return null;
    }

    public function listTypes(){
        return $arrTypes = [
            'select'    => 'Select',
            'text'      => 'Text',
            'color'     => 'Color',
            'checkbox'  => 'Checkbox',
            'radio'     => 'Radiobox'
        ];
    }
}
