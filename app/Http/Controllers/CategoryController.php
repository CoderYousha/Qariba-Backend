<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;
    public function __construct(CategoryService $categoryService)
    {
        return $this->categoryService = $categoryService;
    }

    //Create Category Function
    public function store (CategoryRequest $categoryRequest){
        return $this->categoryService->createCategory($categoryRequest->all());
    }

    //Update Category Function
    public function update (Category $category, CategoryRequest $categoryRequest){
        return $this->categoryService->updateCategory($category, $categoryRequest->all());
    }

    //Delete Category Function
    public function destroy (Category $category){
        return $this->categoryService->deleteCategory($category);
    }

    //Get Categories Function
    public function view (Request $request){
        return $this->categoryService->getCategories($request->service);
    }

    //Get Category Function
    public function show (Category $category){
        return $this->categoryService->getCategory($category);
    }
}
