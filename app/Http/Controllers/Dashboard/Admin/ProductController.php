<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Product, Category, ProductImage};
use Illuminate\Support\Facades\{DB};
class ProductController extends Controller {
    public function index() {
        $products = Product::with('category')
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);
        return view('dashboard.admin.products.index', compact('products'));
    }

    public function create() {
        $categories = Category::whereStatus(true)->get(['id', 'name']);
        return view('dashboard.admin.products.create', compact('categories'));
    }

    public function store(Request $request) {
        try {
            $input['name'] = $request->name;
            $input['description'] = $request->description;
            $input['price'] = $request->price;
            $input['quantity'] = $request->quantity;
            $input['category_id'] = $request->category_id;
            $input['featured'] = $request->featured;
            $input['status'] = $request->status;
            $product = Product::create($input);
            if ($request->hasFile('image')) {
                $fileName = 'product-' . time() . '.' . $request->file('image')->getClientOriginalExtension();
                $product->storeImage($request->file('image')->storeAs('product', $fileName, 'upload_image'));
            }
            toastr()->success('تم الحفظ بنجاح');
            return redirect()->route('products.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'حدث خطا حاول مره اخرى']);
        }
        
    }
    
    public function addImages($product_id){
        $product = Product::findOrFail($product_id);
        return view('dashboard.admin.products.media', compact('product'))->with('id', $product_id);
    }

    public function saveProductImages(Request $request ){
        $file = $request->file('dzfile');
        $filename = uploadImage('productGallery', $file);
        return response()->json([
            'name' => $filename,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function saveProductImagesDB(Request $request){
        try {
            if ($request->has('document') && count($request->document) > 0) {
                foreach ($request->document as $image) {      
                    ProductImage::create([
                        'product_id' => $request->product_id,
                        'photo' => $image,
                    ]);
                }
            }
            return redirect()->route('products.index')->with(['success' => 'تم التحديث بنجاح']);
         }catch(\Exception $ex){
             return redirect()->back()->with([$ex]);
         }
    }

    public function destroyMedia($product_id, $image_id) {
        $image = ProductImage::where('product_id', $product_id)->find($image_id);
        if (!$image) 
            return redirect()->route('products.images', ['id' => $product_id])->with('error', 'the image not found');
        $image->delete();
        return redirect()->route('products.images', ['id' => $product_id])->with('success', 'Image Delete Successfully');
    }
    public function destroy(string $id) {
        try {
            DB::beginTransaction();
            $banner = Product::findOrFail($id);
            $banner->delete();
            $banner->deleteImage();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'حدث خطا حاول مره اخرى']);
        }
        toastr()->success('تم الحذف بنجاح');
        return redirect()->route('products.index');
    }
}
