<?php

namespace Webkul\Admin\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Webkul\Admin\DataGrids\CMS\BlogDataGrid;
use Webkul\CMS\Repositories\BlogRepository;

class BlogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(protected BlogRepository $blogRepository) {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (request()->ajax()) {
            return datagrid(BlogDataGrid::class)->process();
        }

        return view('admin::cms.blogs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin::cms.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate(request(), [
            'title'   => 'required',
            'slug'    => 'required|unique:blogs,slug',
            'content' => 'required',
        ]);

        $data = request()->all();

        $this->blogRepository->create($data);

        session()->flash('success', 'Blog created successfully.');

        return redirect()->route('admin.cms.blogs.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $blog = $this->blogRepository->findOrFail($id);

        return view('admin::cms.blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $this->validate(request(), [
            'title'   => 'required',
            'slug'    => 'required|unique:blogs,slug,' . $id,
            'content' => 'required',
        ]);

        $data = request()->all();

        $this->blogRepository->update($data, $id);

        session()->flash('success', 'Blog updated successfully.');

        return redirect()->route('admin.cms.blogs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        try {
            $this->blogRepository->delete($id);

            return new JsonResponse([
                'message' => 'Blog deleted successfully.',
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => 'Something went wrong while deleting the blog.',
            ], 500);
        }
    }
}
