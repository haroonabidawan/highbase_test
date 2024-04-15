<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    protected CategoryService $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(CategoryDataTable $dataTable): mixed
    {
        return $dataTable->render('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return JsonResponse|void
     */
    public function create()
    {
        if (request()->ajax()) {
            $categories = $this->service->all()->pluck('name', 'id')->toArray();

            return $this->returnSuccessJsonResponse(data: [
                'html' => view('admin.category.form')
                    ->with('title', 'Create New Category')
                    ->with('actionRoute', route('admin.categories.store'))
                    ->with('actionMethod', 'POST')
                    ->with('categories', $categories)
                    ->render(),
            ]);
        }
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return JsonResponse|void
     */
    public function store(CategoryRequest $request)
    {
        if (request()->ajax()) {
            $validateData = $request->validated();
            $this->service->create($validateData);

            return $this->returnSuccessJsonResponse('New Record Created Successfully');
        }
        abort(404);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): void
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (request()->ajax()) {
            $item = $this->service->findOrFail($id);
            $categories = $this->service->all()->pluck('name', 'id')->toArray();

            return $this->returnSuccessJsonResponse(data: [
                'html' => view('admin.category.form')
                    ->with('title', 'Edit Category')
                    ->with('item', $item)
                    ->with('actionRoute', route('admin.categories.update', $item->id))
                    ->with('actionMethod', 'PATCH')
                    ->with('categories', $categories)
                    ->render(),
            ]);
        }
        abort(404);
    }

    /**
     * @return JsonResponse|void
     */
    public function update(CategoryRequest $request, string $id)
    {
        if (request()->ajax()) {
            $validateData = $request->validated();
            $this->service->update($id, $validateData);

            return $this->returnSuccessJsonResponse('Record Updated Successfully');
        }
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (request()->ajax()) {
            $this->service->delete($id);

            return $this->returnSuccessJsonResponse('Record Updated Successfully');
        }
        abort(404);
    }
}
