<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('backend.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_category = Category::where('is_parent', 1)->orderBy('title', 'ASC')->get();
        return view('backend.category.create',compact('parent_category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'string|required',
            'summary' => 'string|nullable',
            'is_parent' => 'sometimes|in:1',
            'parent_id' => 'nullable|exists:categories,id',
            'status' => 'nullable|in:active,inactive',
        ]);

        $data = $request->all();
        $slug = Str::slug($request->input('title'));
        $slug_count = Category::where('slug', $slug)->count();

        if ($slug_count > 0) {
            $slug .= time() . '-' . $slug;
        }

        $data['slug'] = $slug;
        $data['is_parent'] = $request->input('is_parent',0);

        $status = Category::create($data);

        if ($status) {
            return redirect()->route('category.index')->with('success', 'Category created successfully');
        } else {
            return back()->with('error', 'Something went wrong');
        }
    }


    public function categoryStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('categories')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('categories')->where('id', $request->id)->update(['status' => 'inactive']);
        }
        return response()->json(['msg' => 'Status changed successfully', 'status' => true]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $parent_category = Category::where('is_parent', 1)->orderBy('title', 'ASC')->get();
        $category = Category::find($id);

        if ($category) {
            return view('backend.category.edit', compact(['category','parent_category']));
        } else {
            return back()->with('error', 'Data not found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if ($category) {

            $request->validate([
                'title' => 'string|required',
                'summary' => 'string|nullable',
                'is_parent' => 'sometimes|in:1',
                'parent_id' => 'nullable|exists:categories,id',
                'status' => 'nullable|in:active,inactive',
            ]);

            $data = $request->all();
           
            $data['is_parent'] = $request->input('is_parent', 0);

            $status = $category->fill($data)->save();

            if ($status) {
                return redirect()->route('category.index')->with('success', 'Category updated successfully');
            } else {
                return back()->with('error', 'Something went wrong');
            }
            
        } else {
            return back()->with('error', 'Data not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if ($category) {
            $status = $category->delete();
            if ($status) {
                return redirect()->route('category.index')->with('success', 'Category successfully deleted');
            } else {
                return redirect()->back()->with('error', 'Something went wrong!');
            }
        } else {
            return back()->with('error', 'Data not found');
        }
    }
}
