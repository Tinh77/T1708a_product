<?php
/**
 * Created by PhpStorm.
 * User: xuanhung
 * Date: 7/18/18
 * Time: 1:58 PM
 */

namespace App\Http\Controllers;


use App\Category;
use App\Product;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $categoryId = Input::get('categoryId');
        $keyword = Input::get("key");

        if ($categoryId == null || $categoryId == 0 ) {
            $products = Product::orderBy('created_at', 'desc')->paginate(5);
            return view('admin.product.list')
                ->with('products_in_view', $products)
                ->with('categories', $categories)
                ->with('categoryId', $categoryId);
        } else {
            $products = Product::where("name", "LIKE", "%".$keyword."%")
                ->where('categoryId', Input::get('categoryId'))
                ->orderBy('created_at', 'desc')->paginate(5);
            
            return view('admin.product.list')
                ->with('products_in_view', $products)
                ->with('categories', $categories)
                ->with('categoryId', $categoryId);
        }

    }
//    public function search(Request $request){
//        $search = $request::input("key");
////        dd($search);
//        $list_obj = Product::where(["name", "LIKE", "%".$search."%", "categoryId" => ])->get();
//        return view('admin.category.list')
//            ->with('list_obj', $list_obj);
//    }

    public function create(Request $request)
    {
        $categoryId = Category::all();
        return view('admin.product.form')->with('categories', $categoryId);
    }

    public function store()
    {
        $product = new Product();
        $product->name = Input::get('name');
        $product->price = Input::get('price');
        $product->categoryId = Input::get('categoryId');
        $product->description = Input::get('description');
        $product->image = Input::get('image');
        $product->save();
        return redirect('/admin/product/list');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        if ($product == null) {
            return view('404');
        }
        $categoryId = Category::all();
        return view('admin.product.edit')
            ->with('product_in_view', $product)
            ->with('categories', $categoryId);
    }

    public function update()
    {
        $product = Product::find(Input::get('id'));
        if ($product == null) {
            return view('404');
        }
        $product->name = Input::get('name');
        $product->price = Input::get('price');
        $product->categoryId = Input::get('categoryId');
        $product->description = Input::get('description');
        $product->image = Input::get('image');
        $product->save();
        return redirect('/admin/product/list');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product == null) {
            return view('404');
        }
    }
}