<?php

namespace App\Services;

use App\Models\Category;
use App\Models\SubCategory;

class SubCategoryService {
    public function createSubCategory (Category $category, $data){
        $data['category_id'] = $category->id;
        $subCategory = SubCategory::create($data);

        return success($subCategory, 'تم إنشاء الصنف الفرعي بنجاح', 201);
    }

    public function updateSubCategory (SubCategory $subCategory, $data){
        $subCategory->update($data);

        return success($subCategory, 'تم تعديل الصنف الفرعي بنجاح');
    }

    public function deleteSubCategory (SubCategory $subCategory){
        $subCategory->delete();

        return success(null, 'تم حذف الصنف الفرعي بنجاح');
    }

    public function getSubCategories (Category $category, $search){
        $subCategories = $category->subCategories()->where('sub_category', 'LIKE', '%' . $search . '%')->orderBy('created_at', 'desc')->get();

        return success($subCategories, "عرض الأصناف الفرعية");
    }

    public function getSubCategory (SubCategory $subCategory){
        return success($subCategory, 'عرض الصنف الفرعي');
    }
}