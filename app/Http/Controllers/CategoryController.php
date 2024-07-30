<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\Collection\CategoryCollection;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $CategoryService;

    public function __construct(CategoryService $CategoryService)
    {
        $this->CategoryService = $CategoryService;
    }
    public function index(Request $request)
    {
      
        $categories = $this->CategoryService->getAll($request);
        
        if (!$categories) {
            return response()->json(['message' => 'No categories found.'], 404);
        }
        return response()->json([
            'message' => 'Categories retrieved successfully.',
            'categories' => new CategoryCollection($categories)
        ]);
    }


    public function store(CategoryRequest $request)
    {
        $category = $this->CategoryService->create($request->all());
     if (!$category) {
        return response()->json(['message' => 'Failed to create category.'], 500);
      }
      return response()->json([
        'message' => 'Category created successfully.',
        'category' => new CategoryResource($category)
      ]);
    }

   
    public function update(CategoryRequest $request, string $id)
    {
        $category = $this->CategoryService->update($request->all(), $id);
           $category=new CategoryResource(Category::find($id));

    
        return response()->json([
            'message' => 'Category updated successfully.',
            'category' => $category
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = $this->CategoryService->delete($id);
       
        return response()->json(['message' => 'Category deleted successfully.']);
    }
}
