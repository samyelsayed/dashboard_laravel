<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function index(){
        return view('backend.product.index');
    }
        function create(){
        return view('backend.product.create');
    }
            function edit(){
        return view('backend.product.edit');
    }
}
