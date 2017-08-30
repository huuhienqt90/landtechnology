<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Repositories\CategoryResponsitory;
use Modules\Dashboard\Http\Requests\CategoryUpdateRequest;
use Modules\Dashboard\Http\Requests\CategoryStoreRequest;

class CategoryController extends Controller
{
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
        $categories = $this->categoryResponsitory->all();
        return view('dashboard::category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $categories = $this->categoryResponsitory->all();
        $category = $this->categoryResponsitory;
        $cateArr = [0 => 'Select an category'];
        if( $categories && $categories->count() ){
            foreach ($categories as $cat) {
                $cateArr[$cat->id] = $cat->name;
            }
        }
        return view('dashboard::category.create', compact('category', 'cateArr'));
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
        return view('dashboard::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $category = $this->categoryResponsitory->find($id);
        $categories = $this->categoryResponsitory->findAllNotWhere('id', $id);
        $cateArr = [0 => 'Select an category'];
        if( $categories && $categories->count() ){
            foreach ($categories as $cat) {
                $cateArr[$cat->id] = $cat->name;
            }
        }
        return view('dashboard::category.edit', compact('category', 'cateArr'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(CategoryUpdateRequest $request, $id = 0)
    {
        $category = $this->categoryResponsitory->find($id);
        if( $request->hasFile('image') ){
            $path = $request->file('image')->store('categories');
            $category->image = $path;
        }
        if( isset( $request->parent_id ) && $request->parent_id > 0 ){
            $category->parent_id = $request->parent_id;
        }

        $category->name = $request->name;
        $category->slug = str_slug($request->name);
        $category->status = $request->status;
        $category->created_by = auth()->user()->id;
        $category->updated_by = auth()->user()->id;
        $category->save();
        return redirect(route('dashboard.category.index'))->with('alert-success', 'Update category sucess!');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
