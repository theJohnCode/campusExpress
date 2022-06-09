<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function home()
    {
        $banners = Banner::where(['status' => 'active','condition' => 'banner'])->orderBy('id','DESC')->limit(4)->get();

        $categories = Category::where(['status' => 'active','is_parent' => 1])->orderBy('id','DESC')->limit(10)->get();
        return view('frontend.index', compact('banners','categories'));
    }

    public function productCategory($slug)
    {
        $categories = Category::with('products')->where('slug',$slug)->first();
        
        return view('frontend.pages.product.product-category', compact(['categories']));
    }

    public function productDetails($slug)
    {
        $product = Product::with('related_products')->where('slug', $slug)->first();
        
        if ($product) {
            return view('frontend.pages.product.product-detail',compact('product'));
        }
        else{
            return 'Product details not found';
        }
    }

}
