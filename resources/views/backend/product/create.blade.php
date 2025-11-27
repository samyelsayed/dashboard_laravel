@extends('backend.layouts.parent')
@section('title','create product')
@section('content')
<form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-row">
        <div class="col-6">
            <label for="name_en">Name En</label>
            <input type="text" name="name_en" id="name_en" class="form-control" placeholder="" aria-describedby="">
        </div>
        <div class="col-6">
            <label for="name_ar">Name Ar</label>
            <input type="text" name="name_ar" id="name_ar" class="form-control" placeholder="" aria-describedby="">
        </div>
    </div>

    <div class="form-row">
        <div class="col-4">
            <label for="Price">Price</label>
            <input type="number" name="price" id="price" class="form-control" placeholder="" aria-describedby="">
        </div>
        <div class="col-4">
            <label for="code">Code</label>
            <input type="number" name="code" id="code" class="form-control" placeholder="" aria-describedby="">
        </div>
            <div class="col-4"> 
        <label for="Quantity">Quantity</label>
        <input type="number" name="quantity" id="Quantity" class="form-control" placeholder="">
           </div>
    </div>


    <div class="form-row">
        <div class="col-4">
            <label for="Status">Status</label>
            <select name="status" id="Status" class="form-control">
                <option value="1">Active</option>
                <option value="0">Not Active</option>
            </select>
        </div>

        <div class="col-4">
            <label for="brand_id">Brands</label>
            <select name="brand_id" id="brand_id" class="form-control">
                @foreach ($brands as $brand)
                <option value="{{$brand->id}}">{{$brand->name_en}}</option>
                    
                @endforeach
            </select>
        </div>

        <div class="col-4">
            <label for="subcategory_id">Subcategories</label>
            <select name="subcategory_id" id="subcategory_id" class="form-control"  >
                                @foreach ($subcategories as $subcategorie)
                <option value="{{$subcategorie->id}}">{{$subcategorie->name_en}}</option>
                    
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="col-6">
            <label for="desc_en">Desc En</label>
            <textarea name="desc_en" id="desc_en" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <div class="col-6">
            <label for="desc_ar">Desc Ar</label>
            <textarea name="desc_ar" id="desc_ar" cols="30" rows="10" class="form-control"></textarea>
        </div>
    </div>

    <div class="form-row">
        <div class="col-12">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
    </div>

    <div class="form-row my-3">
        <div class="col-2">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </div>
</form>
@endsection