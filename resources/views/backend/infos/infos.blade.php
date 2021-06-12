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
        .dataTables_wrapper {
            overflow-x: auto;
        }
        /* width */
            ::-webkit-scrollbar {
            width: 20px;
            height: 10px;
            cursor: pointer!important;
            }

            /* Track */
            ::-webkit-scrollbar-track {
            box-shadow: inset 0 0 5px grey;
            border-radius: 10px;
            }

            /* Handle */
            ::-webkit-scrollbar-thumb {
            background: #b30000;
            border-radius: 5px;
            }

            /* Handle on hover */
            ::-webkit-scrollbar-thumb:hover {
            background: #8d0000;
            }
    </style>
    <div class="row" id="okreload">

        <div class="col-md-12" id="reloadId">
            <button type="button" class="btn btn-info waves-effect waves-light" title="Edit" data-toggle="modal"
                    data-target="#myModalSave">
                <i class="ion-plus"></i> Add New Info
            </button>
            <div id="reload-category">
                <div class="list text-center">
                    <h6 class="display-4" style="font-size: 20px;">Info List</h6>
                </div>
                <table id="myTable" class="table table-bordered dt-responsive nowrap"
                       style="border-collapse: collapse; border-spacing: 0; width: 100%;overflow-x:auto;">
                    <thead>
                    <tr class="text-center">
                        <th>#SL</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Logo</th>
                        <th>Facebook</th>
                        <th>Instagram</th>
                        <th>Linkedin</th>
                        <th>Youtube</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody class="tbodytags" id="loadnow">
                    @php
                        $i=0;
                    @endphp
                    @foreach($infos  as $info)
                        <tr class="text-center unqtags{{$info->info_id}}">
                            <td><b>{{$i+=1}}</b></td>
                            <td>{{$info->mobile}}</td>
                            <td>{{$info->email}}</td>
                            <td>{{$info->address}}</td>
                            <td class="cat_img">
                                <img src="{{$info->logo}}" class="img-fluid" alt="Info's logo">
                            </td>
                            <td>{{$info->facebook_url}}</td>
                            <td>{{$info->instagram_url}}</td>
                            <td>{{$info->linkedin_url}}</td>
                            <td>{{$info->youtube_url}}</td>
                            <td>
                                <button type="button"
                                        class="btn btn-sm btn-outline-primary waves-effect waves-light category-edit"
                                        data-id="{{$info->info_id}}" title="Edit"
                                        data-toggle="modal" data-target="#myModal">
                                    <i class="mdi mdi-border-color"></i> Edit
                                </button>
                                <a class="deletetag" data-id="{{$info->info_id}}">
                                    <button class="btn btn-outline-danger btn-sm category-delete" title="Delete"><i
                                            class="ti-trash"></i> Delete
                                    </button>
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
                        <label for="name" class="col-sm-6 col-form-label">Mobile</label>
                        <div class="col-sm-12">
                            <input class="form-control" type="text" id="name" name="mobile"
                                   placeholder="Mobile Number..."
                                   required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-6 col-form-label">Email</label>
                        <div class="col-sm-12">
                            <input class="form-control" type="email" id="name" name="email"
                                   placeholder="Email Here..."
                                   required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-6 col-form-label">Address</label>
                        <div class="col-sm-12">
                            <input class="form-control" type="text" id="name" name="address"
                                   placeholder="Address Here..."
                                   required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-6 col-form-label">Logo</label>
                        <div class="col-sm-12">
                            <input type="file" name="image" id="input-file-now" class="dropify" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-6 col-form-label">Facebook Url</label>
                        <div class="col-sm-12">
                            <input class="form-control" type="text" id="name" name="facebook_url"
                                   placeholder="Facebook Url Here..."
                                   required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-6 col-form-label">Instagram Url</label>
                        <div class="col-sm-12">
                            <input class="form-control" type="text" id="name" name="instagram_url"
                                   placeholder="Instagram Url Here..."
                                   required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-6 col-form-label">Linkedin Url</label>
                        <div class="col-sm-12">
                            <input class="form-control" type="text" id="name" name="linkedin_url"
                                   placeholder="Linkedin Url Here..."
                                   required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-6 col-form-label">Youtube Url</label>
                        <div class="col-sm-12">
                            <input class="form-control" type="text" id="name" name="youtube_url"
                                   placeholder="Youtube Url Here..."
                                   required>
                        </div>
                    </div>

                    <div class="form-group m-b-0">
                        <div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                Submit
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
                    <h5 class="modal-title mt-0" id="myModalLabel">Category Related Service Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    {!!Form::open(['class' => 'form-horizontal','id'=>'tagsupdate'])!!}
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-6 col-form-label">Mobile</label>
                        <div class="col-sm-12">
                            <input class="form-control" type="text" id="mobile" name="mobile"
                                   placeholder="Mobile Number..."
                                   required>
                        <input type="hidden"  name="category_id" id="category-edit-id" class="form-control" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-6 col-form-label">Email</label>
                        <div class="col-sm-12">
                            <input class="form-control" type="email" id="email" name="email"
                                   placeholder="Email Here..."
                                   required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-6 col-form-label">Address</label>
                        <div class="col-sm-12">
                            <input class="form-control" type="text" id="address" name="address"
                                   placeholder="Address Here..."
                                   required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-6 col-form-label">Logo</label>
                        <div class="col-sm-12">
                            <input type="file" name="image" id="logo" class="dropify"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-6 col-form-label">Facebook Url</label>
                        <div class="col-sm-12">
                            <input class="form-control" type="text" id="facebook" name="facebook_url"
                                   placeholder="Facebook Url Here..."
                                   required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-6 col-form-label">Instagram Url</label>
                        <div class="col-sm-12">
                            <input class="form-control" type="text" id="instagram" name="instagram_url"
                                   placeholder="Instagram Url Here..."
                                   required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-6 col-form-label">Linkedin Url</label>
                        <div class="col-sm-12">
                            <input class="form-control" type="text" id="linkedin" name="linkedin_url"
                                   placeholder="Linkedin Url Here..."
                                   required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-6 col-form-label">Youtube Url</label>
                        <div class="col-sm-12">
                            <input class="form-control" type="text" id="youtube" name="youtube_url"
                                   placeholder="Youtube Url Here..."
                                   required>
                        </div>
                    </div>
                    <div class="form-group m-b-0">
                        <div>
                            <button type="submit" class="btn btn-success waves-effect waves-light">
                                Update
                            </button>
                            <button type="reset" class="btn btn-secondary waves-effect m-l-5" data-dismiss="modal">
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
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/parsleyjs/parsley.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
        $('.dropify').dropify();
        $(document).ready(function () {
            $('form').parsley();
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
    <script type="text/javascript">
        $("#cat").select2({
            placeholder: "Select the Category"
        });
        $("#position").select2({
            placeholder: "Select the Position"
        });
    </script>
    <script type="text/javascript">   // Edit data
        $(document).ready(function () {
            $('#reload-category').on('click', '.category-edit', function () {
                let id = $(this).attr('data-id');

                $.ajax({
                    url: "{{url('infos')}}/" + id + '/edit',
                    method: "get",
                    data: {},
                    dataType: 'json',
                    success: function (data) {
                        let url = window.location.origin;
                        console.log('data', data);
                        var catdata = $('#tagsupdate').find('#mobile').val(data.mobile);
                        $('#tagsupdate').find('#email').val(data.email).focus();
                        $('#tagsupdate').find('#address').val(data.address).focus();
                        $('#tagsupdate').find('#facebook').val(data.facebook_url).focus();
                        $('#tagsupdate').find('#instagram').val(data.instagram_url).focus();
                        $('#tagsupdate').find('#linkedin').val(data.linkedin_url).focus();
                        $('#tagsupdate').find('#youtube').val(data.youtube_url).focus();
                        $('#tagsupdate').find('#category-edit-id').val(data.info_id);

                        if (data.image) {
                            $('#category-edit-form').find('#category-edit-image').html(`<img width="100%" height="200px"  src="${url}/${data.logo}"/>`);
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
        $("#cat2").select2({
            placeholder: positiondata
        });
        $("#position2").select2({
            placeholder: catdata
        });
    </script>

    <script>

        //save data
        $('#catservestore').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: "{{route('infos.store')}}",
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
                    setTimeout(function () {
                        $('#myModalSave').modal('hide');
                        $("#loadnow").load(location.href + " #loadnow>*", "");
                    }, 1000);
                    toastr.success('Data Inserted Successfully');

                    $('#tagstore').trigger('reset');
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
                            url: "{!! route('infos.destroy') !!}",
                            type: "get",
                            data: {
                                id: id,
                            },
                            success: function (data) {
                            }
                        });

                        $(this).closest('tr').hide();

                    }
                }
            )
        });


        //Update data
        $('#tagsupdate').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: "{{route('infos.updated')}}",
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

                    setTimeout(function () {
                        $('#myModal').modal('hide');
                        $("#loadnow").load(location.href + " #loadnow>*", "");
                    }, 1000);
                    toastr.success('Data Updated Successfully');
                    $('#tagsupdate').trigger('reset');
                }

            });

        });
    </script>
@endsection