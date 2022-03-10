@extends('layouts.starlight')
@section('title')
    dashboard
@endsection
@section('setting')
active
@endsection
@section('breadcrumb')
   <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{url('home')}}">Dashboard</a>
        <span class="breadcrumb-item active">setting</span>
      </nav>
@endsection

@section('content')

<div class="container">
<div class="row">
<div class="col-6 m-auto">
<div class="card">
<div class="card-header text-white bg-info">setting</div>
<div class="card-body">

<form action="{{ route('settingpost') }}" method="POST" >
{{-- photo add korar jonno enctype likhte hoy --}}
@csrf

<div class="form-group">
<label>phone</label>
<input type="text" class="form-control" name="phone" 
value="{{$setting->where('setting_name','phone')->first()->setting_value}}">
</div>
<div class="form-group">
<label>email</label>
<input type="text" class="form-control" name="email" 
value="{{$setting->where('setting_name','email')->first()->setting_value}}">
</div>

<button type="submit" class="btn btn-primary">update setting</button>
<br>
<br>

</form>
</div>
</div>
</div>
</div>


@endsection
