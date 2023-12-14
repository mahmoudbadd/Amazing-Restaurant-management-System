@extends('layouts.admin')

@section('content')


<div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">

            @if ($errors->any())
  <div class="alert alert-danger" role="alert">
    <ul>
        @foreach ($errors->all() as $foods)
        <li>{{$foods}}</li>
        @endforeach
       
    </ul>
  </div>
      
  @endif


          <h5 class="card-title mb-5 d-inline">Create Food Items</h5>
      <form method="POST" action="{{ route('admins.store.foods') }}" enctype="multipart/form-data">
        @csrf
            <!-- Email input -->
            <div class="form-outline mb-4 mt-4">
              <input type="text" name="name" id="form2Example1" class="form-control" placeholder="name" />
             
            </div>
            <div class="form-outline mb-4 mt-4">
              <input type="text" name="price" id="form2Example1" class="form-control" placeholder="price" />
             
            </div>
            <div class="form-outline mb-4 mt-4">
              <input type="file" name="image" id="form2Example1" class="form-control"  />
             
            </div>
            <div >
              <label for="exampleFormControlTextarea1">Description</label>
              <textarea name="description" class="form-control" id="description" rows="3"></textarea>
            </div>
           
            <br>
            <div class="form-outline mb-4 mt-4">
              <label for="category">Category:</label>
              <select name="category_id" id="category_id" class="form-select  form-control" aria-label="Default select example">
                <option value="" selected>None</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
                
              </select>
            </div>

            <div class="form-outline mb-4 mt-4">
              <label for="subcategory" id="subcategory-label" style="display: none;">Subcategory:</label>
              <select style="display: none" name="subcategory_id" id="subcategory_id" class="form-select  form-control" aria-label="Default select example">
                
               {{--  @foreach($subcategories as $subcategory)
                
                <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
               
            @endforeach --}}
                
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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        // When the category dropdown changes
        $('#category_id').change(function() {
            // Get the selected category value
            var categoryId = $(this).val();

            // Toggle the visibility of the subcategory dropdown based on the selected category
            if (categoryId !== '') {
                $('#subcategory-label, #subcategory_id').show();

                 // Make an AJAX request to fetch subcategories for the selected category
            $.get('/admin/get-subcategories/' + categoryId, function(data) {
                // Clear existing subcategory options
                $('#subcategory_id').empty();

                // Populate the subcategory dropdown with the fetched data
                $.each(data, function(index, subcategory) {
                        $('#subcategory_id').append('<option value="' + subcategory.id + '">' + subcategory.name  + '</option>');
                    });
            });

            } else {
                $('#subcategory-label, #subcategory_id').hide();
            }

           
        });
    });
</script>

  @endsection