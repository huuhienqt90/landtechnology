<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Repositories\CategoryResponsitory;

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
        return view('dashboard::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
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
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
