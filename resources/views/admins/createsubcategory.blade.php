@extends('layouts.admin')

@section('content')


<div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">


          <h5 class="card-title mb-5 d-inline">Create subcategory</h5>
      <form method="POST" action="{{ route('admins.store.subcategory') }}">
        @csrf
            <!-- Email input -->
            <div class="form-outline mb-4 mt-4">
              <input type="text" name="name" id="form2Example1" class="form-control" placeholder="name" />
             
        
            </div>

            <div class="form-outline mb-4 mt-4">

                <select name="category_id" id="category_id" class="form-select  form-control" aria-label="Default select example">
                  <option value="" selected>None</option>
                  @foreach($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endforeach
                  
                </select>
              </div>

           

            <br>
          

  
            <!-- Submit button -->
            <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

      
          </form>

        </div>
      </div>
    </div>
  </div>


  @endsection