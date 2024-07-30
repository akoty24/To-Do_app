<?php
namespace App\Services;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class CategoryService
{
    public function getAll($request)
    {
        $perPage = $request->per_page ? $request->per_page : 15;
        $categories = Category::filter($request->all())->orderBy('id','asc')->paginate($perPage);
        return $categories;
    }
    public function getone($id)
    {
         $category = Category::find($id);
         return $category;
    }
    public function create(array $data){
        $category = Category::create([
            'name' => $data['name'],
        ]);
        return $category;
    }

    public function update(array $data,$id){
    $category = Category::find($id);
    $category->name = $data['name'];
    $category->save();

    }

    public function delete($id){
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Failed to delete category.'], 500);
        }
        $category->delete();

    }


  
}
