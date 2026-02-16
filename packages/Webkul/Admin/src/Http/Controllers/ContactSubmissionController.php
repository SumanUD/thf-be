<?php

namespace Webkul\Admin\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Webkul\Admin\DataGrids\ContactSubmissionDataGrid;
use Webkul\Core\Repositories\ContactSubmissionRepository;

class ContactSubmissionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(protected ContactSubmissionRepository $contactSubmissionRepository) {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (request()->ajax()) {
            return datagrid(ContactSubmissionDataGrid::class)->process();
        }

        return view('admin::contacts.index');
    }

    /**
     * Show the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function view($id)
    {
        $contact = $this->contactSubmissionRepository->findOrFail($id);

        return view('admin::contacts.view', compact('contact'));
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
            $this->contactSubmissionRepository->delete($id);

            return new JsonResponse([
                'message' => 'Contact submission deleted successfully.',
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => 'Something went wrong while deleting the contact submission.',
            ], 500);
        }
    }
}
