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
            function edit(){
        return view('backend.product.edit');
    }
    //كأني بقوله الفريبول الي اسمه ريكويست دا اوجت من كلاس الريكويست وكدا هوا شايل كل البيانات الي جيت في الفورم
            function store(Request $request){
                dd($request->all());  //دي ميثود بتحول الدا تابتاعتي الي راجعه ل اراي //dump and die
                //form data
                //validation
                //upload image
                //issert to database
                //redireect

       
    }

}
