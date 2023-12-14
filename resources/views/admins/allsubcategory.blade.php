@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">

          
          <h5 class="card-title mb-4 d-inline">subcategory</h5>
          <a  href="{{ route('admins.create.subcategory') }}" class="btn btn-primary mb-4 text-center float-right">Create subcategory</a>

          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">category</th>
                <th scope="col">update</th>
                <th scope="col">delete</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($subcategory as $allsubcategory)
                <tr>
                    <th scope="row">{{ $allsubcategory->id }}</th>
                    <td>{{ $allsubcategory->name }}</td>
                    <td>{{ $allsubcategory->category->name }}</td>
                    <td><a href="{{ route('subcategories.edit',$allsubcategory->id) }}" class="btn btn-success  text-center ">update</a></td>
                     <td><a href="{{ route('admins.delete.subcategory',$allsubcategory->id) }}" class="btn btn-danger  text-center ">delete</a></td>
                  </tr>
                @endforeach
              
              
            </tbody>
          </table> 
        </div>
      </div>
    </div>
  </div>

@endsection