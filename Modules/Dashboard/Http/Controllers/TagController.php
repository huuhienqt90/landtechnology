<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Repositories\TagReponsitory;
use Modules\Dashboard\Http\Requests\CreateTagRequest;
use Modules\Dashboard\Http\Requests\UpdateTagRequest;

class TagController extends DashboardController
{
    protected $menuActive = 'products';
    protected $subMenuActive = 'tag';
    protected $tagReponsitory;

    public function __construct(TagReponsitory $tagReponsitory) {
        $this->tagReponsitory = $tagReponsitory;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $tags = $this->tagReponsitory->all();
        return $this->viewDashboard('tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $tag = $this->tagReponsitory;
        return $this->viewDashboard('tag.create', compact('tag'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CreateTagRequest $request)
    {
        $create = ['name' => $request->name, 'slug' => $request->slug];
        $this->tagReponsitory->create($create);
        return redirect(route('dashboard.tag.index'))->with('alert-success', 'Create tag success!');
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
        $tag = $this->tagReponsitory->find($id);
        return $this->viewDashboard('tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(UpdateTagRequest $request, $id)
    {
        $update = [
            'name' => $request->name,
            'slug' => $request->slug
        ];
        $this->tagReponsitory->update($update, $id);
        return redirect(route('dashboard.tag.index'))->with('alert-success', 'Update tag success!');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $arItem = $this->tagReponsitory->find($id);
        $arItem->delete();
        return redirect(route('dashboard.tag.index'))->with('alert-success', 'Delete tag success');
    }
}
