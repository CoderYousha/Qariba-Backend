<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubCategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use App\Services\SubCategoryService;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    protected $subCategoryService;
    public function __construct(SubCategoryService $subCategoryService)
    {
        $this->subCategoryService = $subCategoryService;
    }

    //Create Sub Category Function
    public function store (Category $category, SubCategoryRequest $subCategoryRequest){
        return $this->subCategoryService->createSubCategory($category, $subCategoryRequest->all());
    }

    //Update Sub Category Function
    public function update (SubCategory $subCategory, SubCategoryRequest $subCategoryRequest){
        return $this->subCategoryService->updateSubCategory($subCategory, $subCategoryRequest->all());
    }

    //Delete Sub Category Function
    public function destroy (SubCategory $subCategory){
        return $this->subCategoryService->deleteSubCategory($subCategory);
    }

    //Get Suub Categories Function
    public function view(Category $category, Request $request){
        return $this->subCategoryService->getSubCategories($category, $request->search);
    }

    //Get Sub Category Function
    public function show (SubCategory $subCategory){
        return $this->subCategoryService->getSubCategory($subCategory);
    }
}
