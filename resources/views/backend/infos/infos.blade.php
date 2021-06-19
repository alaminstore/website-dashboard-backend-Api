@extends('backend.home')
@section('title','Infos')
@section('content')
    <style>
        .cat_img {
            height: 50px;
            width: 50px;
        }

        .cat_img img {
            height: 52px;
            width: 52px;
            border-radius: 5%;
        }

        .dataTables_wrapper {
            overflow-x: auto;
        }

        textarea.form-control {
            height: 100px;
        }

    </style>
    <div class="card m-b-20">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12" id="reloadId">
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <button {{$limit>0? "disabled":''}} type="button"
                            class="btn btn-secondary waves-effect waves-light clearData addBtn" title="Edit"
                            data-toggle="modal"
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

                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Logo</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody class="tbodytags" id="loadnow">

                            @foreach($infos  as $info)
                                <tr class="text-center unqtags{{$info->info_id}}">
                                    <td>{{$info->mobile}}</td>
                                    <td>{{$info->email}}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($info->address, 30, $end='...') }}</td>
                                    <td class="cat_img">
                                        <img src="{{$info->logo}}" class="img-fluid" alt="Info's logo">
                                    </td>
                                    <td>
                                        <button type="button"
                                                class="btn btn-sm btn-outline-info waves-effect waves-light viewData"
                                                data-id="{{$info->info_id}}">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                        <button type="button"
                                                class="btn btn-sm btn-outline-primary waves-effect waves-light category-edit"
                                                data-id="{{$info->info_id}}" title="Edit"
                                                data-toggle="modal" data-target="#myModal">
                                            <i class="mdi mdi-border-color"></i>
                                        </button>
                                        <a class="deletetag" data-id="{{$info->info_id}}">
                                            <button class="btn btn-outline-danger btn-sm category-delete"
                                                    title="Delete"><i
                                                    class="ti-trash"></i>
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
      </div>

    <!--modal content  Save-->
    <div id="myModalSave" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Add New Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    {!!Form::open(['class' => 'form-horizontal','id'=>'catservestore'])!!}
                    @csrf
                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-4 col-form-label">Mobile</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="mobile"
                                   placeholder="Mobile Number..."
                                   required>
                        </div>
                    </div>
                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-4 col-form-label">Email</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="email" name="email"
                                   placeholder="Email Here..."
                                   required>
                        </div>
                    </div>
                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-4 col-form-label">Address</label>
                        <div class="col-sm-8">
                            <textarea name="address" class="form-control" cols="30" rows="10"
                                      placeholder="Address Here..." required></textarea>
                        </div>
                    </div>
                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-4 col-form-label">Logo</label>
                        <div class="col-sm-8">
                            <input type="file" name="image" id="input-file-now" class="dropify" required/>
                        </div>
                    </div>
                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-4 col-form-label">Facebook Url</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="facebook_url"
                                   placeholder="Facebook Url Here...">
                        </div>
                    </div>
                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-4 col-form-label">Instagram Url</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="instagram_url"
                                   placeholder="Instagram Url Here...">
                        </div>
                    </div>
                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-4 col-form-label">Linkedin Url</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="linkedin_url"
                                   placeholder="Linkedin Url Here..."
                            >
                        </div>
                    </div>
                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-4 col-form-label">Youtube Url</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="youtube_url"
                                   placeholder="Youtube Url Here...">
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
                    <h5 class="modal-title mt-0" id="myModalLabel">Update Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    {!!Form::open(['class' => 'form-horizontal','id'=>'tagsupdate'])!!}
                    @csrf
                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-4 col-form-label">Mobile</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="mobile" name="mobile"
                                   placeholder="Mobile Number..."
                                   required>
                            <input type="hidden" name="category_id" id="category-edit-id" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-4 col-form-label">Email</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="email" id="email" name="email"
                                   placeholder="Email Here..."
                                   required>
                        </div>
                    </div>
                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-4 col-form-label">Address</label>
                        <div class="col-sm-8">
                            <textarea name="address" style="height: 100px;" class="form-control" id="address" cols="30"
                                      rows="10" placeholder="Address Here..." required></textarea>
                        </div>
                    </div>
                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-4 col-form-label">Logo</label>
                        <div class="col-sm-8">
                            <input type="file" name="image" id="image2" class="dropify"/>
                        </div>
                    </div>
                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-4 col-form-label">Facebook Url</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="facebook" name="facebook_url"
                                   placeholder="Facebook Url Here...">
                        </div>
                    </div>
                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-4 col-form-label">Instagram Url</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="instagram" name="instagram_url"
                                   placeholder="Instagram Url Here...">
                        </div>
                    </div>
                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-4 col-form-label">Linkedin Url</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="linkedin" name="linkedin_url"
                                   placeholder="Linkedin Url Here...">
                        </div>
                    </div>
                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-4 col-form-label">Youtube Url</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="youtube" name="youtube_url"
                                   placeholder="Youtube Url Here...">
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

    {{-- View Modal --}}
    <div id="viewModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Details Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body" style="background: #f5f5f5;">

                    <div class="Catname">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p><b>Mobile:</b></p>
                                </div>
                                <div class="col-sm-9">
                                    <div id="viewMobile"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="Catname">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p><b>Email:</b></p>
                                </div>
                                <div class="col-sm-9">
                                    <div id="viewEmail"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="Catname">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p><b>Address:</b></p>
                                </div>
                                <div class="col-sm-9">
                                    <div id="viewAddress"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="Catname">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p><b>Facebook:</b></p>
                                </div>
                                <div class="col-sm-9">
                                    <div id="viewFb"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="Catname">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p><b>Instagram:</b></p>
                                </div>
                                <div class="col-sm-9">
                                    <div id="viewInsta"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="Catname">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p><b>Linkedin:</b></p>
                                </div>
                                <div class="col-sm-9">
                                    <div id="viewLdin"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="Catname">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p><b>Youtube:</b></p>
                                </div>
                                <div class="col-sm-9">
                                    <div id="viewYtb"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="Catname">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p><b>Image:</b></p><br>
                                </div>
                                <div class="col-sm-12">
                                    <div id="viewImage" class="text-center"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="assets/plugins/parsleyjs/parsley.min.js"></script>
    <script>
        $('.dropify').dropify();
        $(document).ready(function () {
            $('form').parsley();
            $(".clearData").on('click', function () {
                $('.dropify-preview').hide();
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
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
                        //===============================================
                        if (data.logo) {
                            var img_url = '{!!URL::to('/')!!}' + "/" + data.logo;
                            console.log(img_url);

                            $("#image2").attr("data-height", 100);
                            $("#image2").attr("data-default-file", img_url);
                            $(".dropify-wrapper").removeClass("dropify-wrapper").addClass("dropify-wrapper has-preview");
                            $(".dropify-preview").css('display', 'block');
                            $('.dropify-render').html('').html('<img src=" ' + img_url + '" style="max-height: 100px;">')
                        } else {
                            $(".dropify-preview .dropify-render img").attr("src", "");
                        }
                        $("#image2").dropify();
                        //===========================
                    },
                    error: function (error) {
                        if (error.status == 404) {
                            toastr.error('Not found!');
                        }
                    }
                });
            });


            //View===============================================================
            $('#reload-category').on('click', '.viewData', function () {
                let id = $(this).attr('data-id');
                console.log('id--', id);
                $.ajax({
                    url: "{{url('info-view')}}/" + id,
                    method: "get",
                    data: {},
                    dataType: 'json',
                    success: function (response) {
                        let url = window.location.origin;
                        console.log('data', response);
                        $('#viewMobile').html(response.data.mobile);
                        $('#viewEmail').html(response.data.email);
                        $('#viewAddress').html(response.data.address);
                        $('#viewImage').html(`<img width="300" height="300"  src="${url}/${response.data.logo}" class="dropify"/>`);
                        $('#viewFb').html(`<a href="${response.data.facebook_url}" target="__blank">${response.data.facebook_url}</a>`);
                        $('#viewInsta').html(`<a href="${response.data.instagram_url}" target="__blank">${response.data.instagram_url}</a>`);
                        $('#viewLdin').html(`<a href="${response.data.linkedin_url}" target="__blank">${response.data.linkedin_url}</a>`);
                        $('#viewYtb').html(`<a href="${response.data.youtube_url}" target="__blank">${response.data.youtube_url}</a>`);
                        $('#viewModal').modal('show');

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
                    console.log(data.range);
                    if (data.range == 1) {
                        // alert('dd')
                        $('.addBtn').attr('disabled', 'disabled');
                    }
                    toastr.options = {
                        "debug": false,
                        "positionClass": "toast-bottom-right",
                        "onclick": null,
                        "fadeIn": 300,
                        "fadeOut": 1000,
                        "timeOut": 5000,
                        "extendedTimeOut": 1000
                        // console.log();
                    };
                    $('#myModalSave').modal('hide');
                    setTimeout(function () {
                        $("#loadnow").load(location.href + " #loadnow>*", "");
                    }, 1);
                    $('#catservestore').trigger('reset');
                    toastr.success('Data Inserted Successfully');
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
                                console.log(data);
                                if (data == 0) {
                                    $('.addBtn').removeAttr('disabled')
                                }
                            }
                        });
                        setTimeout(function () {
                            $("#loadnow").load(location.href + " #loadnow>*", "");
                        }, 1000);
                        toastr.success('Data Deleted Successfully');
                        $(this).closest('tr').hide();

                        // console.log(typeof(result.range));


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
                    $('#myModal').modal('hide');
                    setTimeout(function () {

                        $("#loadnow").load(location.href + " #loadnow>*", "");
                    }, 1);
                    toastr.success('Data Updated Successfully');

                }
            });
        });
    </script>
@endsection
