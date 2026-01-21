<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\traits\ApiTrait;
use App\Http\traits\media;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    use media , ApiTrait;

    public function index(){
        // $products = Product::all();
           $language = App::getLocale();
           $products = Product::select('id','name_'.$language. ' AS name','desc_'.$language. ' AS desc')->get();

        // return response()->json(compact('products'),200);
           return $this->data(compact('products'),__('message.all'),200);
    }


    public function create(){
        $brands = Brand::all();
        $Subcategories = Subcategory::select('id','name_en')->get();
        // return response()->json(compact('brands', 'Subcategories'),200);
          return $this->data(compact('brands', 'Subcategories'),200);
    }

    public function edit($id){
        // $products = Product::where('id',$id)->first();
        $brands = Brand::all();
        $Subcategories = Subcategory::select('id','name_en')->get();
        $product = Product::findOrFail($id);       //لو ما لقاها يرمي ايرور
        // $products = Product::find($id);
        return $this->data(compact('brands', 'Subcategories', 'product'), 200);
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
                return $this->SuccessMessage("product created successfuly",201);  //201 خاصة بان الكريت تم بنجاح
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
    return $this->SuccessMessage( "Product Updated Successfully" );
    } // تأكد أن هذا هو قوس الإغلاق الوحيد للدالة

            function destroy($id){
                 //drlete photo from folder
                //   $oldPhotoName = DB::table('products')->select('image')->where('id',$id)->first()->image;

            $product = Product::find($id);

            if($product){
                  $oldPhotoName = Product::find($id)->image;
                  $photoPath =public_path('/dist/image/products/').$oldPhotoName;
                  $this->deletePhoto($photoPath);
                //delete from database
                // DB::table('products')->where('id',$id)->delete();
                 Product ::where('id',$id)->delete();

              return $this->SuccessMessage("Product Deleted Successfuly");
            }else{
                    return $this->ErrorMessage(['id'=>'the id is invalid'],"Product id is invalid",422);  //422 دي بتاعت الفالديشن ايرور

            }

} }
