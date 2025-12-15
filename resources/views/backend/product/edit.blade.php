@extends('backend.layouts.parent')
@section('title','Edit product')
@section('content')
<form action="{{route('products.update',$product->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')

    <div class="form-row">
        <div class="col-6">
            <label for="name_en">Name En</label>
            <input type="text" name="name_en" id="name_en" class="form-control" placeholder="" aria-describedby="" value="{{$product->name_en}}">
            @error('name_en')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-6">
            <label for="name_ar">Name Ar</label>
            <input type="text" name="name_ar" id="name_ar" class="form-control" placeholder="" aria-describedby="" value="{{$product->name_ar}}">
            @error('name_ar')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-row">
        <div class="col-4">
            <label for="Price">Price</label>
            <input type="number" name="price" id="price" class="form-control" placeholder="" aria-describedby="" value="{{$product->price}}">
            @error('price')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-4">
            <label for="code">Code</label>
            <input type="number" name="code" id="code" class="form-control" placeholder="" aria-describedby="" value="{{$product->code}}">
            @error('code')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
            <div class="col-4">
        <label for="Quantity">Quantity</label>
        <input type="number" name="quantity" id="Quantity" class="form-control" placeholder="" value="{{$product->quantity}}">
            @error('quantity')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
    </div>
    </div>


    <div class="form-row">
        <div class="col-4">
            <label for="Status">Status</label>
            <select name="status" id="Status" class="form-control">
                <option {{$product->status ==1 ? 'selected' : '' }} value="1">Active</option>
                <option {{$product->status ==0 ? 'selected' : '' }} value="0">Not Active</option>
            </select>
            @error('status')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-4">
            <label for="brand_id">Brands</label>
            <select name="brand_id" id="brand_id" class="form-control">
                @foreach ($brands as $brand)
                    <option {{$product->brand_id == $brand->id? 'selected' : ''}} value="{{ $brand->id }}">{{ $brand->name_en }}</option>
                @endforeach
                </select>
            @error('brand_id')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
            </div>

        <div class="col-4">
            <label for="subcatgories_id">Subcategories</label>
            <select name="subcatgories_id" id="subcatgories_id" class="form-control">
                @foreach ($subcategories as $subcategory)
                    <option {{$product->subcatgories_id  ==  $subcategory->id ? 'selected' : ''}}  value="{{ $subcategory->id }}">{{ $subcategory->name_en }}</option>
                @endforeach
            </select>
            @error('subcatgories_id')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-row">
        <div class="col-6">
            <label for="desc_en">Desc En</label>
            <textarea name="desc_en" id="desc_en" cols="30" rows="10" class="form-control"> {{$product->desc_en}}</textarea>
            @error('desc_en')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-6">
            <label for="desc_ar">Desc Ar</label>
            <textarea name="desc_ar" id="desc_ar" cols="30" rows="10" class="form-control"> {{$product->desc_ar}}</textarea>
            @error('desc_ar')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-row">
        <div class="col-12">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="form-control">
            @error('image')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-4">
            <img src="{{url('dist/image/products/'.$product->image)}}" alt="{{$product->name_en}}" width="100px" height="100px">
        </div>
        {{-- طلاما قولتله يو ار ال يبقا انا هبدا  من عند فولدر البابليك --}}
    </div>

    <div class="form-row my-3">
            <div class="div col-2">
                <button class="btn btn-warning" name="page" value="index">Update</button>
            </div>
            <div class="div col-2">
                <button class="btn btn-dark" name="page" value="back">Update & Return</button>
            </div>
    </div>
</form>
@endsection
