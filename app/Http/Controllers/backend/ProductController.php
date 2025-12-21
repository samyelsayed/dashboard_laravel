<?php

namespace App\Http\Controllers\backend;
  //ال ريكويست هيستقبل ايه ريكويست سواء جيت او بوست او اين كان وعلشان هوا كلاس علشان اتعامل معاه لازم اخد منه اوبجكت
use App\Http\traits\media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller

{
    use media;
    function index(){
        $products = DB::table('products')
        ->select('id','name_en','name_ar','price','quantity','status','code','created_at')
        ->get();
        // get بترجع الداتا من الداتا بيز كا اراي اوف اوبجكت اسمها كوليكشن
        return view('backend.product.index',compact('products'));
        // compact('products') هيحول متغير ل اراي
    }
        function create(){
            //لو عاوز اجيب بيانات من جدول معين بكتب السطر الي تحت "بكتب اسم الجدول و '*' معناها هات بياناتكل العواميد الي فية ويعدين جيت
            $brands = DB::table('brands')->select('*')->get();
            //بظهر للمستخدم اسم البراند او ال سيب كاتجوري لكن لما بسجل في الدا تا بيز بسجل ال اي دي
            $subcategories = DB::table('subcategories')->select('id','name_en')->Where('status','=',1)->get();
        return view('backend.product.create',compact('brands','subcategories'));
    }




   function edit($id){
                $product = DB::table('products')->where('id',$id)->first();
                $brands = DB::table('brands')->select('*')->get();
               $subcategories = DB::table('subcategories')->select('id','name_en')->Where('status','=',1)->get();
        return view('backend.product.edit',compact('product','brands','subcategories'));
    }




           //كأني بقوله الفريبول الي اسمه ريكويست دا اوجت من كلاس الريكويست وكدا هوا شايل كل البيانات الي جيت في الفورم
            function store(StoreProductRequest $request){




                // dd($request->all());  //دي ميثود بتحول الدا تابتاعتي الي راجعه ل اراي //dump and die
                //form data
                //validation
                //upload image
                //issert to database
                //redireect

                //upload image
                $photoName = $thids->uploadPhoto($request->image,'products');
                    //البابليك باص دي بتجيب ابسليوت لحد مسار البابليك
                    $data =$request->except('_token','image','page');
                    $data['image'] = $photoName;
                DB::table('products')->insert($data);
                return $this->redirectAccordingToReruest($request);
    }
            //الريكويست هيستقبل ايه ريكويست سواء جيت او بوست او اين كان وعلشان هوا كلاس علشان اتعامل معاه لازم اخد منه اوبجكت
            function update(UpdateProductRequest $request , $id){
              //validation

                    // is photo exists=> upload image
                    //علشان اتشك هل اليوزر رفع او عدل الصورة ولا لا بتشك علي كي ال ايمج  كان مكن اعمل كدا من خلا ل فانشكن از ست بس لارافيل فيها هيلبر اسمه هاذ
                    $data= $request->except('_token','_method','page','image');
                    if($request->hasFile('image')){
                        $oldPhotoName = DB::table('products')->select('image')->where('id',$id)->first()->image;
                        $photoPath =public_path('/dist/image/products/').$oldPhotoName;
                         $this->deletePhoto($photoPath);
                        // dd($oldPhotoName);
                        //upload new photo
                         $photoName = $thids->uploadPhoto($request->image,'products');
                          $data['image'] = $photoName;
                     }
                    // update database
                    DB::table('products')
                    ->where('id',$id)
                    ->update($data);
                    //redirect
                    return $this->redirectAccordingToReruest($request);
            }

            function destroy($id){
                 //drlete photo from folder
                  $oldPhotoName = DB::table('products')->select('image')->where('id',$id)->first()->image;
                  $photoPath =public_path('/dist/image/products/').$oldPhotoName;
                  $this->deletePhoto($photoPath);
                //delete from database
                DB::table('products')->where('id',$id)->delete();
                return redirect()->back()->with('success', 'Product deleted successfully');
            }

           private function redirectAccordingToReruest($request){

                if($request->page =='back'){         
                return redirect()->back()->with('success', 'Product updated successfully');
                    //يعني النيم متخزن جواها باك ارجع للصفحة الي كنت
                }else{
                    return redirect()->route('products.index')->with('success', 'Product updated successfully');
                }
            }

}
