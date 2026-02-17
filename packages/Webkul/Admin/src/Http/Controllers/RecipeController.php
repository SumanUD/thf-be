<?php

namespace Webkul\Admin\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Webkul\Admin\DataGrids\CMS\RecipeDataGrid;
use Webkul\CMS\Repositories\RecipeRepository;

class RecipeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(protected RecipeRepository $recipeRepository) {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (request()->ajax()) {
            return datagrid(RecipeDataGrid::class)->process();
        }

        return view('admin::cms.recipes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin::cms.recipes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate(request(), [
            'title' => 'required',
            'slug'  => 'required|unique:recipes,slug',
        ]);

        $data = request()->all();

        // Convert strings to arrays if they are provided as such from the form
        if (is_string($data['ingredients'] ?? null)) {
            $data['ingredients'] = array_filter(explode("
", str_replace("", "", $data['ingredients'])));
        }

        if (is_string($data['instructions'] ?? null)) {
            $data['instructions'] = array_filter(explode("
", str_replace("", "", $data['instructions'])));
        }

        $this->recipeRepository->create($data);

        session()->flash('success', 'Recipe created successfully.');

        return redirect()->route('admin.cms.recipes.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $recipe = $this->recipeRepository->findOrFail($id);

        return view('admin::cms.recipes.edit', compact('recipe'));
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
            'title' => 'required',
            'slug'  => 'required|unique:recipes,slug,' . $id,
        ]);

        $data = request()->all();

        if (is_string($data['ingredients'] ?? null)) {
            $data['ingredients'] = array_filter(explode("
", str_replace("", "", $data['ingredients'])));
        }

        if (is_string($data['instructions'] ?? null)) {
            $data['instructions'] = array_filter(explode("
", str_replace("", "", $data['instructions'])));
        }

        $this->recipeRepository->update($data, $id);

        session()->flash('success', 'Recipe updated successfully.');

        return redirect()->route('admin.cms.recipes.index');
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
            $this->recipeRepository->delete($id);

            return new JsonResponse([
                'message' => 'Recipe deleted successfully.',
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => 'Something went wrong while deleting the recipe.',
            ], 500);
        }
    }
}
