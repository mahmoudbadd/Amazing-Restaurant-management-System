@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">

          
          <div class="container">
            @if(Session::has('success'))
          <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('success') }}</p>
          @endif
          </div>

          <div class="container">
            @if(Session::has('delete'))
          <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('delete') }}</p>
          @endif
          </div>


          <h5 class="card-title mb-4 d-inline">Orders</h5>
        
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">email</th>
                <th scope="col">town</th>
                <th scope="col">country</th>
                <th scope="col">zipcode</th>
                <th scope="col">phone_number</th>
                <th scope="col">address</th>
                <th scope="col">total_price</th>
                <th scope="col">status</th>
                <th scope="col">change status</th>
                <th scope="col">delete</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($orders as $allorders)
                <tr>
                    <th scope="row">{{ $allorders->id }}</th>
                    <td>{{ $allorders->name }}</td>
                    <td>{{ $allorders->email }}</td>
                    <td>{{ $allorders->town }}</td>
                    <td>{{ $allorders->country }}</td>
                    <td>
                        {{ $allorders->zipcode }}
                    </td>
                    <td>{{ $allorders->phone_number }}</td>
                    <td>{{ $allorders->address }}</td>
                    <td>${{ $allorders->price }}</td>
    
                    <td>{{ $allorders->status }}</td>
                    <td><a href="{{ route('admins.edit.orders',$allorders->id) }}" class="btn btn-warning text-white text-center ">change status</a></td>
                     <td><a href="{{ route('admins.delete.orders',$allorders->id) }}" class="btn btn-danger  text-center ">delete</a></td>
                  </tr>
                @endforeach
             
              
            </tbody>
          </table> 
        </div>
      </div>
    </div>
  </div>

@endsection