@extends('layouts.starlight')

@section('title')
    category
@endsection
@section('category')
{{-- after adding @yield('category')  to <a> class after sl-menu-link--}}
active
@endsection

@section('breadcrumb')
   <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{url('home')}}">Dashboard</a>
        <a class="breadcrumb-item" href="{{url('category')}}">Category</a>
        <span class="breadcrumb-item active">edit</span>
      </nav>
@endsection

@section('content')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-4">
              {{-- <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{url('category')}}">category</a></li>
    <li class="breadcrumb-item active" aria-current="page">edit</li>
  </ol>
</nav> --}}
                <div class="card ">
  <div class="card-header text-white bg-info">edit category</div>
  <div class="card-body">

    <form action="{{ url('category/post/edit') }}" method="POST">
        @csrf
  <div class="form-group">
    <label>category name</label>

    <input type="hidden" name="category_id" 
    value="{{$category_info->id}}">
    <input type="text" class="form-control" name="category_name"  placeholder="Enter category name" value="{{$category_info->category_name}}">
    @error('category_name')
        <span class="text-danger">{{$message}}</span>
    @enderror
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
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
    </div>
</div>



@endsection
