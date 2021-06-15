@extends('backend.home')
@section('title','Clients')
@section('style')
<link href="assets/plugins/summernote/summernote.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
@endsection
@section('content')
<style>
   .cat_img {
   height: 50px;
   width: 50px;
   }
   .cat_img img {
   height: 50px;
   width: 50px;
   border-radius: 50%;
   }
   .select_css {
   height: 40px;
   width: 465px !important;
   padding: 8px;
   opacity: .6;
   border-radius: 7px;
   }
</style>
<div class="row">
   <div class="row">
      <div class="col-md-12">
         <button type="button" class="btn btn-info waves-effect waves-light" title="Edit" data-toggle="modal"
            data-target="#myModalSave">
         <i class="ion-plus"></i> Add New Clients
         </button>
      </div>
   </div>
</div>
<div id="reload-category">
   <div class="row">
      <div class="col-md-12">
         <div id="reload-category">
            <div class="list text-center">
               <h6 class="display-4" style="font-size: 20px;">Client's Information</h6>
            </div>
            <table id="myTable" class="table table-bordered dt-responsive nowrap"
               style="border-collapse: collapse; border-spacing: 0; width: 100%;">
               <thead>
                  <tr class="text-center">
                     <th>Name</th>
                     <th>Image</th>
                     <th>Precedence</th>
                     <th>Url</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody id="loadnow">
                  @foreach($clients  as $client)
                  <tr class="text-center">
                     <td>{{$client->name}}</td>
                     <td class="cat_img"><img src="{{$client->image}}" class="img-fluid"
                        alt="portfolio Category Image">
                     </td>
                     <td>
                        @if ($client->precedence == 1)
                        Level 1
                        @elseif ($client->precedence == 2)
                        Level 2
                        @else
                        Level 3
                        @endif
                     </td>
                     <td>{{$client->url}}</td>
                     <td>
                        <button type="button"
                                class="btn btn-sm btn-outline-primary waves-effect waves-light category-edit"
                                data-id="{{$client->client_id}}" title="Edit"
                                data-toggle="modal" data-target="#myModal">
                                <i class="mdi mdi-border-color"></i>
                        </button>
                        <a class="deletetag" data-id="{{$client->client_id}}">
                            <button class="btn btn-outline-danger btn-sm category-delete" title="Delete"><i class="ti-trash"></i></button>
                        </a>
                    </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
<!--modal content  Save-->
<div id="myModalSave" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title mt-0" id="myModalLabel">Category Related Service Add</h5>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
         </div>
         <div class="modal-body">
            {!!Form::open(['class' => 'form-horizontal','id'=>'catservestore'])!!}
            @csrf
            <div class="form-group row">
               <label for="name" class="col-sm-2 col-form-label">Name</label>
               <div class="col-sm-10">
                  <input class="form-control" type="text" id="name" name="name"
                     placeholder="Client Name Here..." required>
               </div>
            </div>
            <div class="form-group row">
               <label for="portfolio_cat_icon" class="col-sm-2 col-form-label">Image</label>
               <div class="col-sm-10">
                  <input type="file" name="image" id="portfolio_cat_icon" class="dropify" required>
               </div>
            </div>
            <div class="form-group row">
               <label for="url" class="col-sm-2 col-form-label">Url</label>
               <div class="col-sm-10">
                  <input class="form-control" type="text" id="url" name="url"
                     placeholder="Url Here..." required>
               </div>
            </div>
            <div class="form-group row">
               <label for="portfolio_cat_icon" class="col-sm-2 col-form-label">Precedence</label>
               <div class="col-sm-10">
                  <select style="width: 200px" id="position" name="precedence">
                     <option></option>
                     <option value="1">Precedence 1</option>
                     <option value="2">Precedence 2</option>
                     <option value="3">Precedence 3</option>
                  </select>
               </div>
            </div>
            <div class="form-group m-b-0">
               <div>
                  <button type="submit" class="btn btn-primary waves-effect waves-light">
                  Save
                  </button>
                  <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                  Cancel
                  </button>
               </div>
            </div>
            {!!Form::close()!!}
         </div>
      </div>
   </div>
</div>
<!--modal content Update -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title mt-0" id="myModalLabel">Client's Info Update</h5>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
         </div>
         <div class="modal-body">
            {!!Form::open(['class' => 'form-horizontal','id'=>'tagsupdate'])!!}
               @csrf
               <div class="form-group row">
                  <label for="name" class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-10">
                     <input class="form-control" type="text" id="category-edit-name" name="name"
                        placeholder="Client Name Here..." required>
                  </div>
               </div>
               <div class="form-group row">
                  <label for="url" class="col-sm-2 col-form-label">Url</label>
                  <div class="col-sm-10">
                     <input class="form-control" type="text" id="url" name="url"
                        placeholder="Url Here..." required>
                  </div>
               </div>
               <div class="form-group row">
                  <label for="portfolio_cat_icon" class="col-sm-2 col-form-label">Precedence</label>
                  <div class="col-sm-10">
                     <select class="form-control" id="position2" name="precedence">
                        <option></option>
                        @php($i=1)
                        @for($i=1;$i<=3;$i++)
                        <option value="{{$i}}">Precedence {{$i}}</option>
                        @endfor
                     </select>
                  </div>
               </div>
               <input type="hidden" name="category_id" id="category-edit-id" class="form-control">
               <div class="form-group row">
                  <label for="portfolio_cat_icon" class="col-sm-2 col-form-label">Image</label>
                  <div class="col-sm-10">
                     <input type="file" name="image" id="portfolio_cat_icon" class="dropify">
                  </div>
               </div>
               {{--
               <div class="form-group" id="category-edit-image">
               </div>
               --}}
               <div class="form-group m-b-0">
                  <div>
                     <button type="submit" class="btn btn-success waves-effect waves-light">
                     Update
                     </button>
                     <button type="reset" class="btn btn-secondary waves-effect m-l-5"  data-dismiss="modal">
                     Cancel
                     </button>
                  </div>
               </div>
               {!!Form::close()!!}
         </div>
      </div>
   </div>
</div>
@endsection
@section('scripts')
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<script src="assets/plugins/parsleyjs/parsley.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script>
   $(document).ready(function () {
       $('#myTable').DataTable();
   });

</script>
<script>
   $('.dropify').dropify();
   $(document).ready(function () {
       $('form').parsley();
   });
</script>
<script type="text/javascript">
   $("#position").select2({
       placeholder: "Select the Position"
   });
</script>
<script type="text/javascript">
   $(document).ready(function () {
       $('#reload-category').on('click', '.category-edit', function () {
           let id = $(this).attr('data-id');

           $.ajax({
               url: "{{url('clients')}}/" + id + '/edit',
               method: "get",
               data: {},
               dataType: 'json',
               success: function (data) {
                   let url = window.location.origin;
                   console.log('data', data);
                   $('#tagsupdate').find('#category-edit-name').val(data.name).focus();
                   $('#tagsupdate').find('#category-edit-id').val(data.client_id);
                   $('#tagsupdate').find('#url').val(data.url);
                   var positiondata = $('#tagsupdate').find('#position2').val(data.precedence);

                   if (data.image) {
                       $('#tagsupdate').find('#category-edit-image').html(`<img width="100%" height="200px"  src="${url}/${data.image}"/>`);
                   }

                   $('#category-modal').modal('show');
               },
               error: function (error) {
                   if (error.status == 404) {
                       toastr.error('Not found!');
                   }
               }
           });
       });

   });

</script>
<script type="text/javascript">
   $("#position2").select2({
       placeholder: positiondata
   });
</script>
<script>

    //save data
    $('#catservestore').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: "{{route('clients.store')}}",
            method: "POST",
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                console.log('save', data);
                toastr.options = {
                    "debug": false,
                    "positionClass": "toast-bottom-right",
                    "onclick": null,
                    "fadeIn": 300,
                    "fadeOut": 1000,
                    "timeOut": 5000,
                    "extendedTimeOut": 1000
                };
                $('#myModalSave').modal('hide');
                setTimeout(function () {
                    $("#loadnow").load(location.href + " #loadnow>*", "");
                }, 1000);
                toastr.success('Data Inserted Successfully');

                $('#catservestore').trigger('reset');
            }

        });

    });

    //Delete data
    $(document).on('click', '.deletetag', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            console.log('id: ', id);
            //alert(role);
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',

            }).then(result => {
                    if (result.value) {
                        $.ajax({
                            url: "{!! route('clients.destroy') !!}",
                            type: "get",
                            data: {
                                id: id,
                            },
                        });
                        toastr.success('Data Deleted Successfully');
                        $(this).closest('tr').hide();

                    }
                }
            )
        });

    //Update data
    $('#tagsupdate').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: "{{route('clients.updated')}}",
            method: "POST",
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                console.log('update', data);
                toastr.options = {
                    "debug": false,
                    "positionClass": "toast-bottom-right",
                    "onclick": null,
                    "fadeIn": 300,
                    "fadeOut": 1000,
                    "timeOut": 5000,
                    "extendedTimeOut": 1000
                };
                $('#myModal').modal('hide');
                setTimeout(function () {
                    $("#loadnow").load(location.href + " #loadnow>*", "");
                }, 1000);
                toastr.success('Data Updated Successfully');
                $('#tagsupdate').trigger('reset');
            }

        });

    });
</script>

@endsection
