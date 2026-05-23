<?php

namespace App\Services;

use App\Models\Category;

class CategoryService {
    public function createCategory($data){
        $category = Category::create($data);

        return success($category, 'تم إضافة الصنف بنجاح', 201);
    }

    public function updateCategory (Category $category, $data){
        $category->update($data);

        return success($category, 'تم تعديل الصنف بنجاح');
    }

    public function deleteCategory (Category $category){
        $category->delete();

        return success(null, 'تم حذف الصنف بنجاح');
    }

    public function getCategories ($service){
        if($service){
            $categories = Category::where('service', $service)->get();

            return success($categories, 'الأصناف المتاحة حسب الخدمة');
        }

        $categories = Category::all();

        return success($categories, 'الأصناف المتاحة');
    }

    public function getCategory (Category $category){
        return success($category, 'عرض الصنف');
    }
}
