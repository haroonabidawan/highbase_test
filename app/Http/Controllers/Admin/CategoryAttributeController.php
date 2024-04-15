<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CategoryAttributeDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryAttributeRequest;
use App\Services\CategoryAttributeService;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;

class CategoryAttributeController extends Controller
{
    protected CategoryAttributeService $service;
    private CategoryService $categoryService;

    public function __construct(CategoryAttributeService $service, CategoryService $categoryService)
    {
        $this->service = $service;
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(CategoryAttributeDataTable $dataTable): mixed
    {
        return $dataTable->render('admin.category-attribute.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return JsonResponse|void
     */
    public function create()
    {
        if (request()->ajax()) {
            $categories = $this->categoryService->all()->pluck('name', 'id')->toArray();
            return $this->returnSuccessJsonResponse(data: [
                'html' => view('admin.category-attribute.form')
                    ->with('title', 'Create New CategoryAttribute')
                    ->with('actionRoute', route('admin.category-attributes.store'))
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
    public function store(CategoryAttributeRequest $request)
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
            $categories = $this->categoryService->all()->pluck('name', 'id')->toArray();

            return $this->returnSuccessJsonResponse(data: [
                'html' => view('admin.category-attribute.form')
                    ->with('title', 'Edit CategoryAttribute')
                    ->with('item', $item)
                    ->with('actionRoute', route('admin.category-attributes.update', $item->id))
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
    public function update(CategoryAttributeRequest $request, string $id)
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
