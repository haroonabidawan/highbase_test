<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    protected ProductService $service;

    private CategoryService $categoryService;

    public function __construct(ProductService $service, CategoryService $categoryService)
    {
        $this->service = $service;
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $dataTable): mixed
    {
        return $dataTable->render('admin.product.index');
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
                'html' => view('admin.product.form')
                    ->with('title', 'Create New Product')
                    ->with('actionRoute', route('admin.products.store'))
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
    public function store(ProductRequest $request)
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
                'html' => view('admin.product.form')
                    ->with('title', 'Edit Product')
                    ->with('item', $item)
                    ->with('actionRoute', route('admin.products.update', $item->id))
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
    public function update(ProductRequest $request, string $id)
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

    public function categoryAttributes($category)
    {
        if (request()->ajax()) {
            $category = $this->categoryService->findOrFail($category, ['attributes']);

            return $this->returnSuccessJsonResponse(data: [
                'html' => view('admin.product.attributes')
                    ->with('attributes', $category->attributes)
                    ->render(),
            ]);
        }
        abort(404);
    }
}
