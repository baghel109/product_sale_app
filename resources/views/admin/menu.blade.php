@extends('layouts.admin.layout')

@section('content')

<h2>Menu</h2>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary m-1" data-toggle="modal" data-target="#exampleModal">
   + Add Menu
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
              
                <form id="addMenuForm">
                  @csrf
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter menu name" aria-describedby="emailHelp">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">URL:</label>
                    <input type="text" class="form-control" id="url" name="url" placeholder="Enter Url" aria-describedby="emailHelp">
                    @error('url')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <input type="checkbox" class="form-control1" id="is_external" name="is_external" value="1" placeholder="is external" aria-describedby="emailHelp">
                    <label for="exampleInputEmail1">Is External</label>
                    @error('is_external')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Position:</label>
                    <select name="position" id="position">
                      <option value="main">Main</option>
                      <option value="quick_link_1">Quick Link 1</option>
                      <option value="quick_link_2">Quick Link 2</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Parent Id: (optional)</label>
                    <select id="parent_id" name="parent_id">
                    <option value="">None </option>
                      @foreach($menuList as $menu)
                        <option value="{{ $menu->id}}"> {{ $menu->name}}</option>
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
        <h5 class="modal-title" id="exampleModalLabel">Edit Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
              
                <form id="updateMenuForm">
                  @csrf
                  <input type="text" name="id" id="eid" />
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name:</label>
                    <input type="text" class="form-control" id="edit_name" name="name" placeholder="Enter menu name" aria-describedby="emailHelp">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">URL:</label>
                    <input type="text" class="form-control" id="edit_url" name="url" placeholder="Enter Url" aria-describedby="emailHelp">
                    @error('url')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <input type="checkbox" class="form-control1" id="edit_is_external" name="is_external" value="1" placeholder="is external" aria-describedby="emailHelp">
                    <label for="exampleInputEmail1">Is External</label>
                    @error('edit_is_external')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Position:</label>
                    <select name="position" id="edit_position">
                      <option value="main">Main</option>
                      <option value="quick_link_1">Quick Link 1</option>
                      <option value="quick_link_2">Quick Link 2</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Parent Id: (optional)</label>
                    <select id="edit_parent_id" name="parent_id">
                    <option value="">None </option>
                      @foreach($menuList as $menu)
                        <option value="{{ $menu->id}}"> {{ $menu->name}}</option>
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
          <th scope="col">Menu</th>
          <th scope="col">URL</th>
          <th scope="col">External</th>
          <th scope="col">Position</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
               {{-- {{ print_r($menus)}} --}}
              @foreach($menus as $menu)
                        <tr>
                            <th scope="row">{{ $menus->firstItem() + $loop->index }}</th>
                            <td>{{ $menu->name}}</td>
                            <td>{{ $menu->url}}</td>
                            <td>{{ $menu->is_external ? 'Yes': "no "}}</td>
                            <td>{{ $menu->position}}</td>
                            <td>
                                {{-- <a class="btn btn-info btn-xs" href="{{ route('admin.editMenu', $menu->id)}}">Edit</a> --}}
                                <button type="button" class="btn btn-primary m-1 editBtn" data-obj="{{ $menu}}" data-toggle="modal" data-target="#updateModal">
                                Edit</button>

                                <a href="{{ route('admin.deleteMenu', $menu->id)}}" class="btn btn-danger" onClick="return confirm(`Are you sure to delete this record ?`)">Delete</a>
                            </td>          
                        </tr>
               
              @endforeach   
       </tbody>
</table>

{{ $menus->links('pagination::bootstrap-5')}}

 


@endsection


@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
     $('#addMenuForm').submit(function(e){
      e.preventDefault();
        
        formData= $(this).serialize();
        $.ajax({
            url: "{{ route('admin.addMenu') }}",
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
      $('#edit_url').val(data.url) 
      if(data.is_external == 1){
        $('#edit_is_external').prop('checked', true);
      }else{
        $('#edit_is_external').prop('checked',false);
      }

      $('#edit_position').val(data.position);
      $('#edit_parent_id').val(data.parent_id);

    });


      // update work
      $('#updateMenuForm').submit(function(e){
      e.preventDefault();
        
        formData= $(this).serialize();
        $.ajax({
            url: "{{ route('admin.updateMenu') }}",
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