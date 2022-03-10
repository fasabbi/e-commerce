@extends('layouts.starlight')
@section('title')
cupon
@endsection
@section('cupon')
active
@endsection
@section('breadcrumb')
   <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{url('home')}}">Dashboard</a>
        <span class="breadcrumb-item active">Cupon</span>
      </nav>
@endsection

@section('content')

    <div class="container">
       
            <div class="row col-12">
              
                <div class="card ">
  <div class="card-header text-white bg-info">
    

  <div class="col-6">
    Cupon list


</div>

  </div>
  <div class="card-body">
    <table class="table table-bordered table-dark">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">cupon name</th>
      <th scope="col">discount amount(%)</th>
      <th scope="col">usage limit</th>
      <th scope="col">created at</th>
      <th scope="col">expire date</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
 
@forelse ($cupons as $cc)

<tr>

<td>{{$loop->index+1}}</td>
<td>{{$cc->cupon_name}}</td>
<td>{{$cc->discount_amount}}</td>
<td>{{$cc->usage_limit}}</td>
<td>{{$cc->created_at}}</td>
<td>{{$cc->expire_date}}</td>
<td>


<a href="{{route('cupon.edit', $cc->id)}}" class="btn btn-info">Edit
</a>


<form action="{{route('cupon.destroy', $cc->id)}}" method="POST">
@csrf
@method('DELETE')
<button class="btn btn-danger">Delete
</button>
</form>
  
 

</td>
</tr>
@empty
<tr class="text-center"><td class="text-danger" colspan="50">
  No data to show
</td></tr>
@endforelse 

</div>
    
  </tbody>
</table>
</div>
</div> 
</div> 

<br>
<br>

            <div class="col-4">

                <div class="card ">
  <div class="card-header text-white bg-info">cupon</div>
  <div class="card-body">

    <form action="{{ route('cupon.store') }}" method="POST">
        @csrf      
<div class="form-group">
    <label>Add Cupon</label>
<input type="text" class="form-control" name="cupon_name" 
 placeholder="Enter cupon">
</div>
<div class="form-group">
    <label>discount amount</label>
<input type="number" class="form-control" name="discount_amount"
 placeholder="discount(%)">
</div>
<div class="form-group">
    <label>expire date</label>
<input type="date" class="form-control" name="expire_date" 
 placeholder="expire date">
</div>
<div class="form-group">
    <label>usage limit</label>
<input type="number" class="form-control" name="usage_limit" 
 placeholder="usage limit">
</div>
{{-- @error('category_name')
<span class="text-danger">{{$message}}</span>
@enderror --}}
<button type="submit" class="btn btn-primary">Add cupon</button>
<br>
<br>
  @if (session('status'))
 <p class="alert alert-success">
  {{session('status')}}
      </p>
  @endif
</form>
  </div>
</div>
       
    </div>
</div>

{{--  --}}
{{--  --}}
{{--  --}}



@endsection
