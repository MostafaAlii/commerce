<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
class CategoryController extends Controller {
    public function index() {
        $categories = Category::withCount('products')
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);
        return view('dashboard.admin.category.index', compact('categories'));
    }

    public function create() {
        $main_categories = Category::whereNull('parent_id')->get(['id', 'name']);
        return view('dashboard.admin.category.create', compact('main_categories'));
    }

    public function store(Request $request) {
        $input['name'] = $request->name;
        $input['status'] = $request->status;
        $input['parent_id'] = $request->parent_id;
        $category = Category::create($input);
        if ($request->hasFile('image')) {
            $fileName = 'category-' . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $category->storeImage($request->file('image')->storeAs('category', $fileName, 'upload_image'));
        }
        return redirect()->route('category.index')->with([
            'message' => 'Created successfully',
            'alert-type' => 'success'
        ]);
    }

    public function show($id) {
        return view('dashboard.admin.category.show');
    }

    public function edit($id) {
        $main_categories = Category::whereNull('parent_id')->get(['id', 'name']);
        $productCategory = Category::orderBy('id', 'DESC')->find($id);
        if (!$productCategory)
            return redirect()->route('category.index')->with(['error' => 'هذا القسم غير موجود ']);
        return view('dashboard.admin.category.edit', compact('main_categories', 'productCategory'));
    }

    public function update(Request $request, $id) {
        $category = Category::find($id);
            if (!$category)
                return redirect()->route('maincategory.index')->with(['error' => 'هذا القسم غير موجود']);
        $input['name'] = $request->name;
        $input['slug'] = null;
        $input['status'] = $request->status;
        $input['parent_id'] = $request->parent_id;
        $category->update($input);
        if ($request->hasFile('image')) {
            $fileName = 'category-' . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $category->updateImage($request->file('image')->storeAs('category', $fileName, 'upload_image'));
        }
        return redirect()->route('category.index')->with([
            'message' => 'Updated successfully',
            'alert-type' => 'success'
        ]);
    }

    public function destroy(Category $category) {
        $category->delete();
        return redirect()->route('category.index')->with([
            'message' => 'Deleted successfully',
            'alert-type' => 'success'
        ]);
    }
}


