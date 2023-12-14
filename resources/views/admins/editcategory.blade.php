@extends('layouts.admin')

@section('content')


<div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">


          <h5 class="card-title mb-5 d-inline">Create category</h5>
      <form method="POST" action="{{ route('categories.update', $category->id) }}">
        @csrf
        @method('PUT')
            <!-- Email input -->
            <div class="form-outline mb-4 mt-4">
                <label for="name">Category Name:</label>
                <input type="text" name="name" id="name" value="{{ $category->name }}" required>
             
        
            </div>

            <br>
          

  
            <!-- Submit button -->
            <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">update</button>

      
          </form>

        </div>
      </div>
    </div>
  </div>


  @endsection