<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

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

    public function userAuth()
    {
        return view('frontend.auth.auth');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:4',
        ]);
        if(Auth::attempt(['email' => $request->email,'password' => $request->password, 'status' => 'active'])){
            Session::put('user', $request->email);

            if (Session::get('url.intended')) {
                return Redirect::to(Session::get('url.intended'));
            }else{
                return redirect()->route('home')->with('success', 'Successfully login');
            }
        }else{
            return back()->with('error','Invalid email or password');
        }
    }

    public function register(Request $request)
    {
        dd($request->all());
    }
}
