<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\CategoryResponsitory;
use Modules\Dashboard\Http\Requests\CategoryUpdateRequest;
use Modules\Dashboard\Http\Requests\CategoryStoreRequest;

class CategoryController extends DashboardController
{
    protected $menuActive = 'products';
    protected $subMenuActive = 'category';

    protected $categoryResponsitory;
    public function __construct(CategoryResponsitory $categoryResponsitory){
        $this->categoryResponsitory = $categoryResponsitory;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $categories = $this->categoryResponsitory->getCategoriesByUser(auth()->user()->id, 20);
        return $this->viewDashboard('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $categories = $this->categoryResponsitory->getParent();
        $category = $this->categoryResponsitory;
        $cateArr = [0 => 'Select a category'];
        if( $categories && $categories->count() ){
            foreach ($categories as $cat) {
                $cateArr[$cat->id] = $cat->name;
            }
        }
        return $this->viewDashboard('category.create', compact('category', 'cateArr'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CategoryStoreRequest $request)
    {
        $create = ['name' => $request->name, 'status' => $request->status, 'created_by' => auth()->user()->id, 'updated_by' => auth()->user()->id];
        if( $request->hasFile('image') ){
            $path = $request->file('image')->store('categories');
            $create['image'] = $path;
        }
        if( isset( $request->parent_id ) && $request->parent_id > 0 ){
            $create['parent_id'] = $request->parent_id;
        }
        $this->categoryResponsitory->create($create);
        return redirect(route('dashboard.category.index'))->with('alert-success', 'Create category sucess!');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return $this->viewDashboard('index');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $category = $this->categoryResponsitory->find($id);
        $categories = $this->categoryResponsitory->getParent();
        $cateArr = [0 => 'Select an category'];
        if( $categories && $categories->count() ){
            foreach ($categories as $cat) {
                $cateArr[$cat->id] = $cat->name;
            }
        }
        return $this->viewDashboard('category.edit', compact('category', 'cateArr'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(CategoryUpdateRequest $request, $id = 0)
    {
        $update = [
            'name' => $request->name,
            'status' => $request->status,
            'updated_by' => auth()->user()->id
        ];
        if( $request->hasFile('image') ){
            $path = $request->file('image')->store('categories');
            $update['name'] = $path;
        }
        if( isset( $request->parent_id ) && $request->parent_id > 0 ){
            $update['parent_id'] = $request->parent_id;
        }
        $this->categoryResponsitory->update($update, $id);
        return redirect(route('dashboard.category.index'))->with('alert-success', 'Update category sucess!');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $arItem = $this->categoryResponsitory->find($id);
        $this->categoryResponsitory->deleteProductCategories($id);
        $arItem->delete();
        return redirect(route('dashboard.category.index'))->with('alert-success', 'Delete category success');
    }
}
