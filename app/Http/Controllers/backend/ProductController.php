<?php

namespace App\Http\Controllers\backend;
  //ال ريكويست هيستقبل ايه ريكويست سواء جيت او بوست او اين كان وعلشان هوا كلاس علشان اتعامل معاه لازم اخد منه اوبجكت
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
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
//الريكويست هيستقبل ايه ريكويست سواء جيت او بوست او اين كان وعلشان هوا كلاس علشان اتعامل معاه لازم اخد منه اوبجكت
    function update(Request $request , $id){
dd($request->all());
    }



    //كأني بقوله الفريبول الي اسمه ريكويست دا اوجت من كلاس الريكويست وكدا هوا شايل كل البيانات الي جيت في الفورم
            function store(Request $request){
             $rules= [
                'name_en'=>['required','string','max:256','min:2'], //بكتب اسم ال انبوت الي انا مسميه في الفورم و بحط الماكسيمم الي انا انا حاطة ف يالدا تا بيز و المينمم ولو مش محددها في الدات ابيز فدي حاجة ترجعلي
                'name_ar'=>['required','string','max:256','min:2'],
                'price'=>['required','numeric','max:99999.99','min:0.5'],
                'code'=>['required','integer','digits:5','unique:products,code'],
                'quantity'=>['nullable','integer','max:999','min:1'],  //nullable يعني تقبل انك تكتب فيها null واحنا في الداتا بيز كاتبين ان الديفولت بتاعها 1
                'desc_en'=>['required','string'],
                'desc_ar'=>['required','string'],
                'status'=>['required','string','between:0,1'],
                'subcategories_id'=>['required','integer','exists:subcategories,id'],  //بقوله ان الساب كاتجوري ايدي ال يهيجيلك لازم ييبقا موجود ف يجدول الصاب كاتجوري في عمود ال اي دي
                'brand_id'=>['required','integer','exists:brands,id'],
                'image'=>['required','max:1000','mimes:png,jpg,jpeg']  //ميمز بكتب الاكستنشن المسموح بية للصورة و ماكسيمم بكتب في اقصي حجم ليهها بالكيلو بايت

            ];
             $request->validate($rules);



                // dd($request->all());  //دي ميثود بتحول الدا تابتاعتي الي راجعه ل اراي //dump and die
                //form data
                //validation
                //upload image
                //issert to database
                //redireect

                $photoName = uniqid() . '.' .$request->image->extension(); //هيجيب الاكستنشن بتاع الصورة
                $request->image->move(public_path('/dist/image/products'),$photoName);   //بكتب المسار اي هرفعه فيه الصورة و الاسم الي هخزن بية الصورة
                    //البابليك باص دي بتجيب ابسليوت لحد مسار البابليك
                    $data =$request->except('_token','image','page');
                    $data['image'] = $photoName;
                DB::table('products')->insert($data);
                if($request->page =='back'){
                    return redirect()->back(); //يعني النيم متخزن جواها بايك ارجع للصفحة الي كنت
                }else{
                    return redirect()->route('products.index');
                }
    }

}
