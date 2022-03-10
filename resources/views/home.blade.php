@extends('layouts.starlight')

@section('title')
    dashboard
@endsection
@section('dashboard')
active
@endsection

@section('breadcrumb')
   <nav class="breadcrumb sl-breadcrumb">
        {{-- <a class="breadcrumb-item" href="index.html">Starlight</a> --}}
      
        <span class="breadcrumb-item active">Dashboard</span>
      </nav>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (Auth::user()->role == 1)
                
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                     total: {{count($users) }}



                    <table class="table table-striped table-dark">
                                <thead>
                                <tr>
                                <th >Sl no.</th>
                                <td>Name</td>
                                <td>Email adreas</td>
                                <td>Created at</td>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($users as $user)


                                <tr>

                                <td>{{ $loop->index+1}}</td>
                                <td>{{ $user->name}}</td>
                                <td>{{ $user->email}}</td>
                                <td>{{ $user->created_at->diffForHumans()}}</td>

                                </tr>

                                @endforeach
                                </tbody>
                                </table>


                </div>
            </div>
            @else
                
            

            @endif
        </div>
    </div>
</div>
@endsection
