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
          
          <h5 class="card-title mb-4 d-inline">Bookings</h5>
        
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">email</th>
                <th scope="col">date_booking</th>
                <th scope="col">num_people</th>
                <th scope="col">special_request</th>
                <th scope="col">status</th>
                <th scope="col">created_at</th>
                <th scope="col">change status</th>
                <th scope="col">delete</th>
              </tr>
            </thead>
            <tbody>
                @foreach ( $booking as  $allbooking)

                <tr>
                    <th scope="row">{{ $allbooking->id }}</th>
                    <td>{{ $allbooking->name }}</td>
                    <td>{{ $allbooking->email }}</td>
                    <td>{{ $allbooking->date }}</td>
                    <td>{{ $allbooking->num_people }}</td>
                    <td>{{ $allbooking->req }}</td>
                    <td>{{ $allbooking->status }}</td>
                    <td>{{ $allbooking->created_at }}</td>
                    <td><a href="{{ route('admins.edit.booking',$allbooking->id) }}" class="btn btn-warning text-white  text-center ">change status</a></td>
                     <td><a href="{{ route('admins.delete.booking',$allbooking->id) }}" class="btn btn-danger  text-center ">delete</a></td>
                  </tr>
                  
                    
                @endforeach
              
            </tbody>
          </table> 
        </div>
      </div>
    </div>
  </div>

@endsection
