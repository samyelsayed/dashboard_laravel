<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\traits\media;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    use media;

    public function index(){
        $products = Product::all();
        return response()->json(compact('products'),200);
    }


    public function create(){
        $brands = Brand::all();
        $Subcategories = Subcategory::select('id','name_en')->get();
        return response()->json(compact('brands', 'Subcategories'),200);
    }

    public function edit($id){
        // $products = Product::where('id',$id)->first();
        $brands = Brand::all();
        $Subcategories = Subcategory::select('id','name_en')->get();
        $products = Product::findOrFail($id);       //لو ما لقاها يرمي ايرور
        // $products = Product::find($id);
        return response()->json(compact('brands', 'Subcategories', 'product'), 200);
      }        //فايند يعني واحد بس

            function store(StoreProductRequest $request){




                // dd($request->all());  //دي ميثود بتحول الدا تابتاعتي الي راجعه ل اراي //dump and die
                //form data
                //validation
                //upload image
                //issert to database
                //redireect

                //upload image
                $photoName = $this->uploadPhoto($request->image,'products');
                    //البابليك باص دي بتجيب ابسليوت لحد مسار البابليك
                    $data =$request->except('image');
                    $data['image'] = $photoName;
                Product::create($data);
                return response()->json(['success' => true , 'message'=> "product created successfuly"]);
            }



 //الريكويست هيستقبل ايه ريكويست سواء جيت او بوست او اين كان وعلشان هوا كلاس علشان اتعامل معاه لازم اخد منه اوبجكت
     public function update(UpdateProductRequest $request, $id)
{
    // 1. استثناء الصورة مؤقتاً من البيانات
    $data = $request->except('_method', 'image');

    // 2. التحقق من وجود صورة جديدة
    if ($request->hasFile('image')) {
        // جلب اسم الصورة القديمة من الداتابيز
        $product = Product::find($id);
        $oldPhotoName = $product->image;

        // مسار الصورة القديمة على السيرفر
        $photoPath = public_path('/dist/image/products/') . $oldPhotoName;

        // حذف الصورة القديمة باستخدام الدالة التي أنشأتها
        $this->deletePhoto($photoPath);

        // رفع الصورة الجديدة وتخزين اسمها الجديد
        $photoName = $this->uploadPhoto($request->image, 'products');
        $data['image'] = $photoName;
    }

    // 3. تحديث البيانات في الداتابيز
    Product::where('id', $id)->update($data);

    // 4. إرجاع رد بصيغة JSON
    return response()->json([
        'success' => true,
        'message' => "Product Updated Successfully"
    ]);
} // تأكد أن هذا هو قوس الإغلاق الوحيد للدالة

            function destroy($id){
                 //drlete photo from folder
                //   $oldPhotoName = DB::table('products')->select('image')->where('id',$id)->first()->image;
                  $oldPhotoName = Product::find($id)->image;
                  $photoPath =public_path('/dist/image/products/').$oldPhotoName;
                  $this->deletePhoto($photoPath);
                //delete from database
                // DB::table('products')->where('id',$id)->delete();
                 Product ::where('id',$id)->delete();

              return response()->json(['success' => true , 'message'=> "Product Deleted Successfuly"]);            }


}
