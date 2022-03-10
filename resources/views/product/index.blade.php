@extends('layouts.starlight')
@section('title')
    dashboard
@endsection
@section('product')
active
@endsection
@section('breadcrumb')
   <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{url('home')}}">Dashboard</a>
        <span class="breadcrumb-item active">Category</span>
      </nav>
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-8">
  
                <div class="card  ">
  <div class="card-header text-white bg-info">
    
<div class="row">
  <div class="col-6">
  Product list
  </div>
  
</div>

  </div>
  <div class="card-body">
    <table class="table table-bordered table-dark">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">category_name</th>
      <th scope="col">subcategory_name</th>
      <th scope="col">product_name</th>
      <th scope="col">product_price</th>
      <th scope="col">product quantity</th>
      <th scope="col">alert quantity</th>
      <th scope="col">added by</th>
      {{-- <th scope="col">created_at</th>
      <th scope="col">action</th> --}}
    </tr>
  </thead>
  <tbody>   

    @forelse ( $products as $bb)
    <tr>
      
<td>{{$loop->index+1}}</td>
<td>{{App\Models\Category::find($bb->category_id)->category_name}}</td>
<td>{{App\Models\subcategory::find($bb->subcategory_id)->subcategory_name}}</td> 
 {{--<td>{{App\Models\subcategory::find($bb->subcategory_id)->category_id}}</td>  --}}
<td>{{$bb->product_name}}</td>
<td>{{$bb->product_price}}</td>
<td>{{$bb->product_quantity}}</td>
<td>{{$bb->alert_quantity}}</td>
<td>{{App\Models\User::find($bb->user_id)->name}}</td>


      {{-- <td>{{$cc->created_at->diffForHumans}}</td> 
       <td>
         <a  href="{{url('category/edit')}}/{{$cc->id}}" type="button" class="btn btn-dark">Edit</a>
  <a  href="{{url('category/delete')}}/{{$cc->id}}" type="button" class="btn btn-danger">Delete</a>
</div>
</td> --}}
        
    
    </tr>
    @empty
    <tr class="text-center"><td class="text-danger" colspan="50">
          No data to show
        </td></tr>
    @endforelse 
  </tbody>
</table>


</div>
</div> 
</div>
</div>
</div>

<div class=" mt-5"> </div>

<div class="col-4 ml-5">

                <div class="card ">
  <div class="card-header text-white bg-info">Add product</div>
  <div class="card-body">

    <form action="{{ route('productpost') }}" method="POST" enctype="multipart/form-data">
      {{-- photo add korar jonno enctype likhte hoy --}}
        @csrf
          <div class="form-group">
          <label>Category name</label>
          <select class="form-control" name="category_id">
          <option value="">--choose one--</option>
          
          @foreach ($categories as $aa)
          <option value="{{$aa->id}}">{{$aa->category_name}}</option>
          @endforeach
          </select>
          </div>

          <div class="form-group">
          <label>Sub-category name</label>
          <select class="form-control" name="subcategory_id">
          <option value="">--choose one--</option>

          @foreach ($subcategories as $aa)    
                
            <optgroup label="Category---{{App\Models\Category::find($aa->category_id)->category_name}}">
            <option value="{{$aa->id}}">{{$aa->subcategory_name}}</option>
            </optgroup>

          @endforeach
          </select>
          </div>
  <div class="form-group">
    <label>product name</label>
    <input type="text" class="form-control" name="product_name">
      </div>
  <div class="form-group">
    <label>product price</label>
    <input type="text" class="form-control" name="product_price">
      </div>
  <div class="form-group">
    <label>product quantity</label>
    <input type="text" class="form-control" name="product_quantity">
      </div>
      <div class="form-group">
        <label>product short description</label>
        {{-- <input type="text" class="form-control" name=""> --}}
        <textarea class="form-control"  rows="4" name="product_short"></textarea>
      </div>
      
      <div class="form-group">
        <label>product long description</label>
        {{-- <input type="text" class="form-control" name=""> --}}
        <textarea class="form-control"  rows="4" name="product_long"></textarea>
      </div>
      <div class="form-group">
        <label>alert quantity</label>
        <input type="text" class="form-control" name="alert_quantity">
          </div>


      <div class="form-group">
        <label>Product photo</label>
        <input type="file" class="form-control" name="product_photo">
          </div>

<button type="submit" class="btn btn-primary">add product</button>
<br>
<br>

</form>
</div>
</div>
</div>
</div>
   

@endsection
