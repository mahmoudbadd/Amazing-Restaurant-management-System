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
          
          <h5 class="card-title mb-4 d-inline">Foods</h5>
          <a  href="{{ route('admins.create.foods') }}" class="btn btn-primary mb-4 text-center float-right">Create Foods</a>

          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">image</th>
                <th scope="col">price</th>
                <th scope="col">category</th>
                <th scope="col">Subcategory</th>
                <th scope="col">update</th>
                <th scope="col">delete</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($food as $allfood)
                <tr>
                    <th scope="row">{{ $allfood->id }}</th>
                    <td>{{ $allfood->name }}</td>
                    <td><img height="70" width="70" src="{{ asset('assets/img/'.$allfood->image.'') }}" ></td>
                    <td>${{ $allfood->price }}</td>
                    <td>{{ $allfood->category->name }}</td>
                    <td>{{ optional($allfood->subcategory)->name }}</td>
                    
                    {{-- <td>{{ $allfood->name??null }}</td> --}}
                    <td><a href="{{ route('foods.edit',$allfood->id) }}" class="btn btn-success  text-center ">update</a></td>
                     <td><a href="{{ route('admins.delete.food',$allfood->id) }}" class="btn btn-danger  text-center ">delete</a></td>
                  </tr>
                @endforeach
              
              
            </tbody>
          </table> 
        </div>
      </div>
    </div>
  </div>

@endsection