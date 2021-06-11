@extends('backend.home')
@section('title','Categories')
@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
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
        <div class="col-md-5">
            <div id="">
                <div class="card m-b-20">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Add New Client</h4>
                        <br>
                        <form action="{{ url('clients/store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-12">
                                    <input class="form-control" type="text" id="name" name="name"
                                           placeholder="Client Name Here..." required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="portfolio_cat_icon" class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-12">
                                    <input type="file" class="form-control" name="image" id="portfolio_cat_icon"
                                           required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="portfolio_cat_icon" class="col-sm-6 col-form-label">Precedence</label>
                                <div class="col-sm-12">
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

                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- </div>
        <div class="list text-center">
            <h6 class="display-4">Categories List</h6>
        </div>
        <div id="reload-category">
        <div class="row"> --}}

        <div class="col-md-7">
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
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
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

                            <td>
                                <button type="button"
                                        class="btn btn-sm btn-outline-primary waves-effect waves-light category-edit"
                                        data-id="{{$client->client_id}}" title="Edit" data-toggle="modal"
                                        data-target="#myModal">
                                    <i class="mdi mdi-border-color"></i> Edit
                                </button>
                                <button class="btn btn-outline-danger btn-sm category-delete" title="Delete"
                                        onclick="deleteData({{$client->client_id}})"><i class="ti-trash"></i> Delete
                                </button>
                                <form id="delete-form-{{$client->client_id}}" method="post"
                                      action="{{route('clients.destroy', $client->client_id)}}" style="display: none">
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
                    <h5 class="modal-title mt-0" id="myModalLabel">Client's Info Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form id="category-edit-form" action="{{ route('clients.updated') }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-12">
                                <input class="form-control" type="text" id="category-edit-name" name="name"
                                       placeholder="Client Name Here..." required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="portfolio_cat_icon" class="col-sm-6 col-form-label">Precedence</label>
                            <div class="col-sm-12">
                                <select class="select_css" id="position2" name="precedence">
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
                            <div class="col-sm-12">
                                <input type="file" class="form-control" name="image" id="portfolio_cat_icon">
                            </div>
                        </div>
                        <div class="form-group" id="category-edit-image">

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
            $('#myTable').DataTable();
        });

    </script>
    <script>
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
                        $('#category-edit-form').find('#category-edit-name').val(data.name).focus();
                        $('#category-edit-form').find('#category-edit-id').val(data.client_id);
                        var positiondata = $('#category-edit-form').find('#position2').val(data.precedence);

                        if (data.image) {
                            $('#category-edit-form').find('#category-edit-image').html(`<img width="100%" height="200px"  src="${url}/${data.image}"/>`);
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
@endsection
