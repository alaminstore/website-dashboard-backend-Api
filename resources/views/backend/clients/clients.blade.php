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
            height: 52px;
            width: 52px;
            border-radius: 5%;
        }
    </style>
    <div class="row">
        <div class="row">
            <div class="col-md-12">
                &nbsp;&nbsp;&nbsp;&nbsp;
                <button type="button" class="btn btn-secondary waves-effect waves-light clientBtn" title="Edit"
                        data-toggle="modal"
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
                            <th>Level</th>
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
                                <td>{{$client->newposition}}</td>
                                <td><a href="{{$client->url}}" target="_blank">{{$client->url}}</a></td>
                                <td>
                                    <button type="button"
                                        class="btn btn-sm btn-outline-info waves-effect waves-light viewData"
                                        data-id="{{$client->client_id}}" data-toggle="modal"
                                        data-target=".bs-example-modal-lg">
                                    <i class="fa fa-eye"></i>
                                    </button>
                                    <button type="button"
                                            class="btn btn-sm btn-outline-primary waves-effect waves-light category-edit"
                                            data-id="{{$client->client_id}}" title="Edit"
                                            data-toggle="modal" data-target="#myModal">
                                        <i class="mdi mdi-border-color"></i>
                                    </button>
                                    <a class="deletetag" data-id="{{$client->client_id}}">
                                        <button class="btn btn-outline-danger btn-sm category-delete" title="Delete"><i
                                                class="ti-trash"></i></button>
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
    <div id="myModalSave" class="modal fade"  role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Client's Info Add</h5>
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
                        <label for="portfolio_cat_icon" class="col-sm-2 col-form-label">Level</label>
                        <div class="col-sm-10">
                            <select style="width: 200px" id="position" name="precedence" required>
                                <option value="">Choose Level</option>
                                <option value="1">Level 1</option>
                                <option value="2">Level 2</option>
                                <option value="3">Level 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Precedence</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="number" id="newPosition" name="newposition"
                                   placeholder="Precedence Here..." required>
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
                        <label for="portfolio_cat_icon" class="col-sm-2 col-form-label">Image</label>
                        <div class="col-sm-10">
                            <input type="file" name="image" id="portfolio_cat_icon" class="dropify" required>
                        </div>
                    </div>

                    <div class="form-group m-b-0">
                        <div>
                            <button type="submit"  class="btn btn-primary waves-effect waves-light">
                                Save
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
    <!--modal content Update -->
    <div id="myModal" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                        <label for="portfolio_cat_icon" class="col-sm-2 col-form-label">Level</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="position2" name="precedence">
                                @php($i=1)
                                @for($i=1;$i<=3;$i++)
                                    <option value="{{$i}}">Level {{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Precedence</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="number" id="newPosition2" name="newposition"
                                   placeholder="Precedence Here..." required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="url" class="col-sm-2 col-form-label">Url</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" id="url2" name="url"
                                   placeholder="Url Here..." required>
                        </div>
                    </div>

                    <input type="hidden" name="category_id" id="category-edit-id" class="form-control">
                    <div class="form-group row">
                        <label for="portfolio_cat_icon" class="col-sm-2 col-form-label">Image</label>
                        <div class="col-sm-10">
                            <input type="file" name="image" id="image2" class="dropify">
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
    <div id="#viewModel" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Client Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body" style="background: #f5f5f5;">

                    <div class="Catname d-flex">
                        <p><b>Name:&nbsp;&nbsp;&nbsp;</b></p>
                        <div id="viewName"></div>
                        <br>
                    </div>
                    <div class="desc d-flex">
                        <p><b>Level:&nbsp;&nbsp;&nbsp;</b></p>
                        <div id="viewLevel"></div>
                    </div>
                    <div class="desc d-flex">
                        <p><b>Precedence:&nbsp;&nbsp;&nbsp;</b></p>
                        <div id="viewPrecedence"></div>
                    </div>
                    <div class="desc d-flex">
                        <p><b>Url:&nbsp;&nbsp;&nbsp;</b></p>
                        <div id="viewUrl"></div>
                    </div>
                    <div class="iconview">
                        <p><b>Image:&nbsp;&nbsp;&nbsp;</b></p>
                        <div id="viewImage" class="text-center"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="assets/plugins/parsleyjs/parsley.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
            $(".clientBtn").on('click', function () {
                $('.dropify-preview').hide();
            });
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
            placeholder: "Select the Position",
        });
    </script>
    <script type="text/javascript"> //edit
        $(document).ready(function () {
            $('#reload-category').on('click', '.category-edit', function () {
                let id = $(this).attr('data-id');
                $.ajax({
                    url: "{{url('clients')}}/" + id + '/edit',
                    method: "get",
                    data: {},
                    dataType: 'json',
                    success: function (data) {
                        console.log('data', data);
                        let url = window.location.origin;
                        console.log('data', data);
                        $('#tagsupdate').find('#category-edit-name').val(data.name).focus();
                        $('#tagsupdate').find('#category-edit-id').val(data.client_id);
                        $('#url2').val(data.url);
                        $('#position2').val(data.precedence);
                        $('#newPosition2').val(data.newposition);
                        //image clear(dropify)...
                        if (data.image) {
                            var img_url = '{!!URL::to('/')!!}' + "/" + data.image;
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
                        //end...

                        console.log(data.name);

                        $('#image').dropify();
                        //

                        $('#category-modal').modal('show');
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
                    url: "{{url('client-view')}}/" + id,
                    method: "get",
                    data: {},
                    dataType: 'json',
                    success: function (data) {
                        let url = window.location.origin;
                        console.log('data', data);
                        $('#viewName').html(data.name);
                        $('#viewLevel').html(data.precedence);
                        $('#viewUrl').html(`<a href="${data.url}" target="__blank">${data.url}</a>`);
                        $('#viewPrecedence').html(data.newposition);
                        $('#viewImage').html(`<img width="300" height="300"  src="${url}/${data.image}" class="dropify"/>`);

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

                    if (data.errorMessage) {
                        toastr.error(data.errorMessage);
                    } else {
                        toastr.success(data.message);
                        $('#myModalSave').modal('hide');
                        $('#catservestore').trigger('reset');
                        setTimeout(function () {
                            $("#loadnow").load(location.href + " #loadnow>*", "");
                        }, 1);
                    }
                    console.log(data.message);
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

                    if (data.errorMessage) {
                        toastr.error(data.errorMessage);
                    } else {
                        toastr.success(data.message);
                        $('#myModal').modal('hide');
                        $('#tagsupdate').trigger('reset');
                        setTimeout(function () {
                            $("#loadnow").load(location.href + " #loadnow>*", "");
                        }, 1);
                    }

                }

            });

        });
    </script>

    <script>
        $(document).on('change', '#position', function (e) {
            e.preventDefault();
            let id = $(this).val();
            console.log(id);

            $.ajax({
                method: 'get',
                data: {
                    id
                },
                url: '{{ url('client-level') }}/' + id,
                success: function (result) {

                    var value = Object.values(result);
                    var pass = parseInt(result) + 1;
                    console.log(typeof (result));
                    if (value.length == 0) {
                        $('#myModalSave').find('#newPosition').val("1");
                    } else {
                        $('#myModalSave').find('#newPosition').val(pass);
                        $('#myModalSave').find('#newPosition').val(pass);
                    }
                },
                error: function (err) {
                    console.log(err)
                }
            })

        });
        $(document).on('change', '#position2', function (e) {
            e.preventDefault();
            let id = $(this).val();
            console.log(id);

            $.ajax({
                method: 'get',
                data: {
                    id
                },
                url: '{{ url('client-level-update') }}/' + id,
                success: function (result) {

                    var value = Object.values(result);
                    var pass = parseInt(result) + 1;
                    console.log(typeof (result));
                    if (value.length == 0) {
                        $('#myModal').find('#newPosition2').val("1");
                    } else {
                        $('#myModal').find('#newPosition2').val(pass);
                        $('#myModal').find('#newPosition2').val(pass);
                    }
                },
                error: function (err) {
                    console.log(err)
                }
            })

        });
    </script>


    <script>

        $(document).ready(function () {
            $("#newPosition").on("change keyup paste", function () {
                let id = $(this).val();
                console.log(id);
                var value = $('#position').val();
                // alert(pos);

                $.ajax({
                    method: 'get',
                    data: {
                        id, value
                    },
                    url: '{{ url('get-precedence') }}/' + id + '/' + value,
                    success: function (result) {
                        console.log('keyup', result);
                        toastr.options = {
                            "debug": false,
                            "positionClass": "toast-bottom-right",
                            "onclick": null,
                            "fadeIn": 200,
                            "fadeOut": 3000,
                            "timeOut": 5000,
                            "extendedTimeOut": 1000
                        };

                        if (result.message) {
                            toastr.error(result.message);
                        }
                    },
                    error: function (err) {
                        console.log(err)
                    }
                })

            });
        });


        $(document).ready(function () {
            $("#newPosition2").on("change keyup paste", function () {
                // $(document).on('change', '#newPosition', function (e) {
                let id = $(this).val();
                console.log(id);
                var value = $('#position2').val();
                // alert(pos);

                $.ajax({
                    method: 'get',
                    data: {
                        id, value
                    },
                    url: '{{ url('get-precedence-update') }}/' + id + '/' + value,
                    success: function (result) {
                        console.log('keyup', result);
                        toastr.options = {
                            "debug": false,
                            "positionClass": "toast-bottom-right",
                            "onclick": null,
                            "fadeIn": 200,
                            "fadeOut": 1000,
                            "timeOut": 1000,
                            "extendedTimeOut": 1000
                        };

                        if (result.message) {
                            toastr.error(result.message);
                        }
                    },
                    error: function (err) {
                        console.log(err)
                    }
                })

            });
        });

    </script>

@endsection
