@extends('layouts.app')

@section('content')


<div class="container-xxl py-5 bg-dark hero-header mb-5" style="margin-top: -25px">
    <div class="container text-center my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">My Orders</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center text-uppercase">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">My Orders</a></li>
            </ol>
        </nav>
    </div>
</div>


<div class="container">
                
    <div class="col-md-12">
        <table class="table">
            <thead>
              <tr>
                
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">town</th>
                <th scope="col">phone number</th>
                <th scope="col">price</th>
                <th scope="col">status</th>
                <th scope="col">Review</th>
              </tr>
            </thead>
            <tbody>
                @foreach ( $allOrders as $orders )
                <tr>
                    
                    <td>{{ $orders->name }}</td>
                    <td>{{ $orders->email }}</td>
                    <td>{{ $orders->town }}</td>
                    <td>{{ $orders->phone_number }}</td>
                    <td>${{ $orders->price }}</td>
                    <td>{{ $orders->status }}</td>
                    @if ($orders->status=="Delivered")
                    <td><a href="{{ route('users.review.create') }}" class="btn btn-success">review</a></td>
                    @else
                    <td>not available yet</td>
                    @endif
                    
                  </tr>
                @endforeach
              
              
            </tbody>
          </table>
    </div>
</div>


@endsection