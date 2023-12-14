@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">

          
          <h5 class="card-title mb-4 d-inline">category</h5>
          <a  href="{{ route('admins.create.category') }}" class="btn btn-primary mb-4 text-center float-right">Create category</a>

          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">update</th>
                <th scope="col">delete</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($category as $allcategory)
                <tr>
                    <th scope="row">{{ $allcategory->id }}</th>
                    <td>{{ $allcategory->name }}</td>
                    <td><a href="{{ route('categories.edit',$allcategory->id) }}" class="btn btn-success  text-center ">update</a></td>
                     <td><a href="{{ route('admins.delete.category',$allcategory->id) }}" class="btn btn-danger  text-center ">delete</a></td>
                  </tr>
                @endforeach
              
              
            </tbody>
          </table> 
        </div>
      </div>
    </div>
  </div>

@endsection