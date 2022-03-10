@extends('layouts.starlight')
@section('title')
    dashboard
@endsection
@section('subcategory')
active
@endsection
@section('breadcrumb')
   <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{url('home')}}">Dashboard</a>
        <span class="breadcrumb-item active">subCategory</span>
      </nav>
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-8">
              
                <div class="card ">
  <div class="card-header text-white bg-info">
    
<div class="row">
  <div class="col-6">
    subCategory
  </div>
  <div class="col-6 text-right">
    <button id="delete_all" class="btn btn-danger">Delete all</button>
    </div>
</div>

  </div>
  <div class="card-body">
    <table class="table table-bordered table-dark">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">subcategory_name</th>
      <th scope="col">created_at</th>
      <th scope="col">updated_at</th>
    </tr>
  </thead>
  <tbody>
 
 
      @forelse ($subcategories as $cc)
      
    <tr>
      
      <td>{{$loop->index+1}}</td>
      <td>{{$cc->subcategory_name}}</td>
      <td>{{$cc->created_at}}</td>
      <td>
        @if ($cc->updated_at)

        {{$cc->updated_at->diffForHumans()}}

        @else
          -----
        @endif
        
      
      </td>
    
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
            <div class="col-4">

                <div class="card ">
  <div class="card-header text-white bg-info">Add sub-category</div>
  <div class="card-body">

    <form action="{{ url('subcategory/post') }}" method="POST">
        @csrf
  <div class="form-group">
    <label>category name</label>
    <select name="category_id" class="form-control" id="">
        <option value="">Select one</option>
        @foreach ($categories as $cccc)
            
        <option value="{{ ($cccc->id) }}">{{ ($cccc->category_name) }}</option>
        
        @endforeach
    </select>
  </div>
  <div class="form-group">
    <label>sub-category name</label>
    <input type="text" class="form-control" name="subcategory_name"  placeholder="Enter sub-category name">
    @error('subcategory_name')
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

{{--  --}}
{{--  --}}
{{--  --}}

    {{-- <div class="container">
        <div class="row">
            <div class="col-12">
              
                <div class="card ">
  <div class="card-header text-white bg-info">
    
<div class="row">
  <div class="col-6">
   deleted  Category
  </div>
  
</div>

  </div>
  <div class="card-body">
    <table class="table table-bordered table-dark">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">category_name</th>
      <th scope="col">created_at</th>
      <th scope="col">action</th>
    </tr>
  </thead>
  <tbody>
 
 
      @forelse ($deletedcategories as $dd)
      
    <tr>
      
      <td>{{$loop->index+1}}</td>
      <td>{{$dd->category_name}}</td>
      <td>{{$dd->created_at}}</td>
      
      <td>
        
            <a  href="{{url('category/restore')}}/{{$dd->id}}" type="button" class="btn btn-success">Restore</a>
            
        <a  href="{{url('category/force/delete')}}/{{$dd->id}}" type="button" class="btn btn-danger">Force Delete</a>
    
      </div>
    </td>
    
    
  </tr>
  @empty
  <tr class="text-center"><td class="text-danger" colspan="50">
    No data to show
  </td></tr>
  @endforelse  

  <td>{{$cc->created_at->diffForHumans}}</td> 
   
    
  </tbody>
</table>





  </div>
</div>

        </div> 
            
        </div>
    </div>
</div> --}}

@endsection
@section('footer_scripts')
<script>
  $(document).ready(function(){
    $('#delete_all').click(function(){
          Swal.fire({
  title: 'Are you sure?',
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColoxt: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
        window.location.href = "category/all/delete";
  }
})  
    });
   
  });  
</script>
@endsection