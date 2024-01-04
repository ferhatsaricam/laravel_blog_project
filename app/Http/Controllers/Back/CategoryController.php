<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;

use Illuminate\Support\Str;

use function Laravel\Prompts\alert;

class CategoryController extends Controller
{
    public function index()
    {
        $categories= Category::all();
        return view ('back.categories.index', compact('categories'));
    }

    public function statusChange(Request $request)
    {
        $category = Category::findOrFail ($request->id);
        $category->status= $request->statu=="true" ? 1 : 0;
        $category->save();
    }

    public function create(Request $request)
    {
        $isExist=Category::whereSlug(Str::slug($request->category))->first();
        if($isExist)
        {
            toastr()->error($request->category.' adında bir kategori zaten var!');
            return redirect()->back();
        }
        $category=new Category;
        $category->name=$request->category;
        $category->slug = Str::slug($request->category);
        $category->save();

        toastr()->success('Kategori başarıyla oluşturuldu');
        return redirect()->back();

    }

    public function update(Request $request)
    {
        $isSlugExist=Category::whereSlug($request->slug)->whereNotIn('id', [$request->id])->first();
        $isNameExist=Category::whereName($request->category)->whereNotIn('id', [$request->id])->first();
        if($isSlugExist || $isNameExist)
        {
            toastr()->error($request->category.' bu isimde bir kategori ya da yol zaten var!');
            return redirect()->back();
        }
        $category=Category::find($request->id);
        $category->name=$request->category;
        $category->slug = Str::slug($request->slug);
        $category->save();

        return redirect()->back();

    }

    public function delete(Request $request)
    {
        $category = Category::findOrFail ($request->id);
        if($category->id==1){
            toastr()->error(' bu kategori silinemez!');
            return redirect()->back();
        }

        if($category->articleCount()>0){
            Article::where('category_id', $category->id)->update(['category_id'=>1]);
        }
        $category->delete();

        return redirect()->back();

    }

    public function getData(Request $request)
    {
        $category = Category::findOrFail ($request->id);
        return response()->json($category);
    }


}
