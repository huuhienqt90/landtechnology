<?php

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use App\Models\Category;
use App\Models\ProductCategory;

class CategoryResponsitory extends Repository {
    protected $model;

    public function model() {
        return 'App\Models\Category';
    }

    /**
     * Find category where not
     */
    public function findAllNotWhere($column, $value){
        return Category::where($column, '!=', $value)->get();
    }

    /**
     * Delete product category
     */
    public function deleteProductCategories($categoryID = 0){
        if( $categoryID ){
            ProductCategory::where('category_id', $categoryID)->delete();
            return true;
        }else{
            return false;
        }
    }

    public function getArrayNameCategories(){
        $categories = Category::where('status','active')->get();
        $cateArr = [];
        if( $categories && $categories->count() ){
            foreach ($categories as $cat) {
                $cateArr[$cat->id] = $cat->name;
            }
        }
        return $cateArr;
    }

    public function getParent(){
        return Category::where('parent_id', 0)->get();
    }

    public function getCategoriesByUser($user_id, $take = 20)
    {
        $attrs = Category::whereHas('author', function($query){
            $query->where('is_admin', 1);
        })->orWhere('created_by', $user_id)->paginate($take);
        return $attrs;
    }
}
