@extends('backend.home')
@section('title','Categories')
@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link href="assets/plugins/summernote/summernote.css" rel="stylesheet" />
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
    </style>
    <div class="row">
        <div class="col-md-5">
            <div id="">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Add New Service</h4>
                    <br>
                    <form action="{{ url('services/store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-12">
                                <input class="form-control" type="text" id="name" name="service_name" placeholder="Service Name Here..." required>
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

                    </form>
                </div>
            </div>
        </div>
        </div>
        <div class="col-md-7">
            <div id="reload-category">
            <div class="list text-center">
                <h6 class="display-4" style="font-size: 20px;">Categories Information</h6>
            </div>
            <table id="myTable" class="table table-bordered dt-responsive nowrap"
                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                <tr class="text-center">
                    <th>Service Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($services  as $service)
                    <tr class="text-center">

                        <td>{{$service->service_name}}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-primary waves-effect waves-light category-edit" data-id="{{$service->service_id}}" title="Edit" data-toggle="modal" data-target="#myModal">
                                <i class="mdi mdi-border-color"></i> Edit
                            </button>
                           <button class="btn btn-outline-danger btn-sm category-delete"  title="Delete" onclick="deleteData({{$service->service_id}})"><i class="ti-trash"></i> Delete</button>
                           <form id="delete-form-{{$service->service_id}}" method="post" action="{{route('services.destroy', $service->service_id)}}" style="display: none">
                               @csrf
                               @method('DELETE')
                           </form>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
    </div>

        <!--modal content -->
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="myModalLabel">Modal Heading</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <form id="category-edit-form" action="{{ route('services.updated') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Service Name</label>
                                <div class="col-sm-12">
                                    <input class="form-control" type="text" id="category-edit-name" name="service_name" placeholder="Service Name Here..." required>
                                    <input type="hidden"  name="category_id" id="category-edit-id" class="form-control" >
                                </div>
                            </div>

                            <div class="form-group m-b-0">
                                <div>
                                    <button type="submit" class="btn btn-success waves-effect waves-light">
                                        Update
                                    </button>
                                    <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                        Cancel
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

@endsection
@section('scripts')
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/parsleyjs/parsley.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            $('form').parsley();
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#reload-category').on('click', '.category-edit' , function () {
                let id =  $(this).attr('data-id');

                $.ajax({
                    url:"{{url('services')}}/"+id+'/edit',
                    method:"get",
                    data:{},
                    dataType: 'json',
                    success:function(data){
                      let url = window.location.origin;
                        console.log('data',data);
                        $('#category-edit-form').find('#category-edit-name').val(data.service_name).focus();
                        $('#category-edit-form').find('#category-edit-id').val(data.service_id);


                        if(data.image)
                          {
                              $('#category-edit-form').find('#category-edit-image').html(`<img width="100%" height="200px"  src="${url}/${data.image}"/>`);
                          }

                        $('#category-modal').modal('show');
                    },
                    error: function (error) {
                        if(error.status == 404){
                            toastr.error('Not found!');
                        }
                    }
                });
            });

        });

    </script>
@endsection
