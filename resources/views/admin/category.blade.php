@extends('layouts.admin.layout')

@section('content')

<h2>Category</h2>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary m-1" data-toggle="modal" data-target="#exampleModal">
   + Add Category
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
              
                <form id="addCategoryForm">
                  @csrf
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter category name" aria-describedby="emailHelp">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Parent Id: (optional)</label>
                    <select id="parent_id" name="parent_id" class="form-control">
                    <option value="">None </option>
                      @foreach($categoryList as $cat)
                        <option value="{{ $cat->id}}"> {{ $cat->name}}</option>
                      @endforeach
                    </select>
                  </div>
                
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"> Create</button>
      </div>

      </form>

    </div>
  </div>
</div>


{{-- update Modal --}}

<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
              
                <form id="updateCategoryForm">
                  @csrf
                  <input type="text" name="id" id="eid" />
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name:</label>
                    <input type="text" class="form-control" id="edit_name" name="name" placeholder="Enter category name" aria-describedby="emailHelp">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Parent Id: (optional)</label>
                    <select id="edit_parent_id" name="parent_id">
                    <option value="">None </option>
                      @foreach($categoryList as $cat)
                        <option value="{{ $cat->id}}"> {{ $cat->name}}</option>
                      @endforeach
                    </select>
                  </div>
                
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary updateBtn"> Update</button>
      </div>

      </form>

    </div>
  </div>
</div>



{{-- table display --}}
 <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>.
          <th scope="col">Parent Category</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
               {{-- {{ print_r($menus)}} --}}
              @foreach($category as $cat)
                        <tr>
                            <th scope="row">{{ $category->firstItem() + $loop->index }}</th>
                            <td>{{ $cat->name}}</td>
                            <td>{{ $cat->parent_id ? getCategoryName($cat->parent_id) : '-'}}</td>
                            <td>
                                <button type="button" class="btn btn-primary m-1 editBtn" data-obj="{{ $cat}}" data-toggle="modal" data-target="#updateModal">
                                Edit</button>

                                <a href="{{ route('admin.deleteCategory', $cat->id)}}" class="btn btn-danger" onClick="return confirm(`Are you sure to delete this record ?`)">Delete</a>
                            </td>          
                        </tr>
               
              @endforeach   
       </tbody>
</table>

{{ $category->links('pagination::bootstrap-5')}}

 


@endsection


@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
     $('#addCategoryForm').submit(function(e){
      e.preventDefault();
        
        formData= $(this).serialize();
        $.ajax({
            url: "{{ route('admin.addCategory') }}",
            type: "POST",
            data: formData,

            success:function(res){
                console.log('Success');
                console.log(res);
                if(res.success == true){
                    location.reload();
                }
            },

            error:function(xhr){
                console.log('Error');
                console.log(xhr.responseText);
            }
        });
    });


    // edit work
    $('.editBtn').click(function(){
      data  = $(this).data('obj');

      $('#eid').val(data.id)
      $("#edit_name").val(data.name)
      $('#edit_parent_id').val(data.parent_id);

    });


      // update work
      $('#updateCategoryForm').submit(function(e){
      e.preventDefault();
        
        formData= $(this).serialize();
        $.ajax({
            url: "{{ route('admin.updateCategory') }}",
            type: "PUT",
            data: formData,
            success:function(res){
                Swal.fire({
                  icon: 'success',
                  title: 'Success',
                  text: res.message
              }).then(() => {
                  location.reload();
              });
            },

            error:function(xhr){
                {{-- console.log('Error');
                console.log(xhr.responseText); --}}

                Swal.fire({
            icon: 'error',
            title: 'Error',
            text: xhr.responseJSON?.message || 'Something went wrong'
        });
            }
        });
    });
  

    

  </script>

@endpush