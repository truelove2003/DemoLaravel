<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all(); // or whatever logic to fetch categories
        return view('admin1.table_category', compact('categories'));
    }

    // Hiển thị danh sách các category
    public function create()
    {
        return view('admin1.form-category');
    }

    /**
     * Insert a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   
        public function insert(Request $request)
        {
            $request->validate([
                'name' => 'required|unique:categories',
            ]);
    
            $category = new Category();
            $category->name = $request->input('name');
            $category->save();
    
            return redirect()->route('categories.index')->with('success', 'Thêm Danh Mục Thành Công');
        }
    
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
{
    $category = Category::find($id);
    return view('admin1.edit-category', compact('category'));
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   // CategoryController.php

   public function update(Request $request, $id)
{
    $category = Category::find($id);
    if ($category) {
        $category->name = $request->input('name');
        // Cập nhật các thuộc tính khác nếu cần
        $category->save();
        return redirect()->route('categories.index')->with('success', 'Cập nhật danh mục thành công');
    } else {
        return redirect()->route('categories.index')->with('error', 'Danh mục không tồn tại');
    }
}
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
    
        return redirect('table-category')->with('success', 'Category deleted successfully');
    }
}
