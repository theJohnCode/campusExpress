<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class IndexController extends Controller
{
    public function home()
    {
        $banners = Banner::where(['status' => 'active','condition' => 'banner'])->orderBy('id','DESC')->limit(4)->get();

        $categories = Category::where(['status' => 'active','is_parent' => 1])->orderBy('id','DESC')->limit(10)->get();
        return view('frontend.index', compact('banners','categories'));
    }

    public function productCategory(Request $request, $slug)
    {
        $categories = Category::with('products')->where('slug',$slug)->first();

        $sort = '';
        if($request->sort != null){
            $sort = $request->sort;
        }
        if($categories == null){
            return view('errors.404');
        }else{
            switch ($sort) {
                case 'priceAsc':
                    $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('price', 'ASC')->paginate(12);
                    break;
                case 'priceDes':
                    $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('price', 'DESC')->paginate(12);
                    break;
                case 'discountAsc':
                    $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('offer_price', 'ASC')->paginate(12);
                    break;
                case 'discountDes':
                    $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('offer_price', 'DESC')->paginate(12);
                    break;
                case 'titleAsc':
                    $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('title', 'ASC')->paginate(12);
                    break;
                case 'titleDes':
                    $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('title', 'DESC')->paginate(12);
                    break;
                
                default:
                    $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->paginate(12);
                    break;
            }
        }
        $route = 'product-category';
        
        if($request->ajax()){
            $view = view('frontend.layouts._single-product',compact('products'))->render();
            return response()->json(['html' => $view]);
        }
        return view('frontend.pages.product.product-category', compact(['categories','route','products']));
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
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'username' => 'nullable|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'min:4|required|confirmed',
        ]);
        $data = $request->all();
        $check = $this->create($data);
        Session::put('user',$data['email']);
        Auth::login($check);
        if($check){
            return redirect()->route('home')->with('success','Registration Successfully');
        }else{
            return back()->with('error', 'Please check your credentials');
        }
    }

    private function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function logout()
    {
        Session::forget('user');
        Auth::logout();
        return redirect()->route('home')->with('success','Logout Successful');
    }

    public function userAccount()
    {
        $user = Auth::user();
        return view('frontend.useraccount.dashboard',compact('user'));
    }
}
