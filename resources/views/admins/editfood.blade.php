@extends('layouts.admin')

@section('content')





          <h5 class="card-title mb-5 d-inline">update Food Items</h5>
      <form id="editForm" method="POST" action="{{ route('foods.update',$food->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
            <!-- Email input -->
            <div class="form-outline mb-4 mt-4">
              <label for="fname">{{ $food->name }} </label>
              <input type="text" name="name" id="form2Example1" class="form-control" placeholder="name"/>
              
             
            </div>
            <div class="form-outline mb-4 mt-4">
              <label for="fname">{{ $food->price }} </label>
              <input type="text" name="price" id="form2Example1" class="form-control" placeholder="price" />
             
            </div>
            <div class="form-outline mb-4 mt-4">
              <label for="fname">{{ $food->image }} </label>
              <input type="file" name="image" id="form2Example1" class="form-control"  />
             
            </div>
            <div >
              <label for="exampleFormControlTextarea1">{{ $food->description }}</label>
              <textarea name="description" class="form-control" id="description" rows="3"></textarea>
            </div>
           
            <div class="form-outline mb-4 mt-4">

              <select name="category_id" id="category_id" class="form-select  form-control" aria-label="Default select example">
                
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $food->category_id == $category->id ? 'selected' : '' }}>
                  {{ $category->name }}
              </option>
            @endforeach
                
              </select>
            </div>

            <div class="form-outline mb-4 mt-4">
              <label for="subcategory" id="subcategory-label" style="display: none;">Subcategory:</label>
              <select name="subcategory_id" id="subcategory_id" class="form-select  form-control" aria-label="Default select example">
                <option value="">Select a subcategory</option>
                {{-- @foreach($subcategories as $subcategory)
                <option value="{{ $subcategory->id }}" {{ $food->subcategory_id == $subcategory->id ? 'selected' : '' }}>
                  {{ $subcategory->name }}
              </option>
            @endforeach --}}
                
              </select>
            </div>

            <br>
          

  
            <!-- Submit button -->
            <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">update</button>

      
          </form>

        </div>
      </div>
    </div>
  </div>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script>
     $(document).ready(function() {
        // Function to load subcategories based on the selected category
        function loadSubcategories(categoryId) {
            // Make an AJAX request to fetch subcategories for the selected category
            $.get('/admin/get-subcategories/' + categoryId, function(data) {
                // Clear existing subcategory options
                $('#subcategory_id').empty();

                // Populate the subcategory dropdown with the fetched data
                $.each(data, function(index, subcategory) {
                    $('#subcategory_id').append('<option value="' + subcategory.id + '">' + subcategory.name + '</option>');
                });
            });
        }

        // Function to pre-fill form with existing data
        function prefillForm(data) {
            // Pre-fill the category dropdown
            $('#category_id').val(data.category_id);

            // Load subcategories based on the selected category
            loadSubcategories(data.category_id);

            
        }

        // Fetch existing data for the food item to be edited
        // Assuming you have a variable `$food` containing the existing food item data
        var existingFoodData = {!! json_encode($food) !!};

        // Pre-fill the form with existing data
        prefillForm(existingFoodData);

        // When the category dropdown changes
        $('#category_id').change(function() {
            // Get the selected category value
            var categoryId = $(this).val();

            // Toggle the visibility of the subcategory dropdown based on the selected category
            if (categoryId !== '') {
                $('#subcategory-label, #subcategory_id').show();

                // Load subcategories for the selected category
                loadSubcategories(categoryId);
            } else {
                // If no category is selected, hide the subcategory dropdown
                $('#subcategory-label, #subcategory_id').hide();
            }
        });

       
       
    });
    </script>

  @endsection