@extends('backend.home')
@section('title','Category Related Services')
@section('style')
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
    <div class="row" id="okreload">
        <div class="col-md-12" id="reloadId">
            &nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-secondary waves-effect waves-light"
                                            title="Edit" data-toggle="modal"
                                            data-target="#myModalSave">
                <i class="ion-plus"></i> Add New Category Services
            </button>
            <div id="reload-category">
                <div class="list text-center">
                    <h6 class="display-4" style="font-size: 20px;">Categories Related Services List</h6>
                </div>
                <table id="myTable" class="table table-bordered dt-responsive nowrap"
                       style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr class="text-center">
                        <th>#SL</th>
                        <th>Portfolio Category</th>
                        <th>Name</th>
                        <th>Icon</th>
                        <th>Level</th>
                        <th>Position</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody class="tbodytags" id="loadnow">
                    @php
                        $i=0;
                    @endphp
                    @foreach($catservices  as $catservice)
                        <tr class="text-center unqtags{{$catservice->category_related_service_id}}">
                            <td><b>{{$i+=1}}</b></td>
                            <td>{{$catservice->getPortfolioCategory->name}}</td>
                            <td>{{$catservice->name}}</td>
                            <td class="cat_img">
                                <img src="{{$catservice->icon}}" class="img-fluid" alt="portfolio Category Image">
                            </td>
                            <td>{{$catservice->level}}</td>
                            <td>{{$catservice->position}}</td>
                            <td>
                                <button type="button"
                                        class="btn btn-sm btn-outline-primary waves-effect waves-light category-edit"
                                        data-id="{{$catservice->category_related_service_id}}" title="Edit"
                                        data-toggle="modal" data-target="#myModal">
                                    <i class="mdi mdi-border-color"></i>
                                </button>
                                <a class="deletetag" data-id="{{$catservice->category_related_service_id}}">
                                    <button class="btn btn-outline-danger btn-sm category-delete" title="Delete"><i
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
                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-4 col-form-label">Portfolio Category</label>
                        <div class="col-sm-8">
                            <select style="width: 200px" id="cat" class="cat_selector" name="portfolio_category_id">
                                <option></option>
                                @foreach($portfolio_cat as $cat)
                                    <option value="{{$cat->portfolio_category_id}}">{{$cat->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-4 col-form-label">Name</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="name" name="name"
                                   placeholder="Category Service Name Here..."
                                   required>
                        </div>
                    </div>
                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-4 col-form-label">Icon</label>
                        <div class="col-sm-8">
                            <input type="file" name="image" id="input-file-now" class="dropify" required/>
                        </div>
                    </div>
                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-4 col-form-label">Level</label>
                        <div class="col-sm-8">
                            <select class="cat_selector2 form-control" id="level"  name="level">
                                <option value="1">Level 1</option>
                                <option value="2">Level 2</option>
                                <option value="3">Level 3</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-2 col-form-label">Position</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="number" id="position" name="position"
                                   placeholder="Position Here..." required>
                        </div>
                    </div>

                    <div class="form-group m-b-0">
                        <div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                Submit
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
                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-4 col-form-label">Portfolio Category</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="cat2" name="portfolio_category_id">
                                @foreach($portfolio_cat as $cat)
                                    <option value="{{$cat->portfolio_category_id}}">{{$cat->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-4 col-form-label">Name</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="category-edit-name" name="name"
                                   placeholder="Category Service Name Here..."
                                   required>
                            <input type="hidden" name="category_id" id="category-edit-id" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-4 col-form-label"> Update Icon</label>
                        <div class="col-sm-8">
                            <input type="file" name="image" id="category-edit-image" class="dropify"/>
                        </div>
                    </div>
                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-4 col-form-label">Level</label>
                        <div class="col-sm-8">
                            <select class="cat_selector2 form-control" id="level2"  name="level">
                                <option value="1">Level 1</option>
                                <option value="2">Level 2</option>
                                <option value="3">Level 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-2 col-form-label">Position</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="number" id="position2" name="position"
                                   placeholder="Position Here..." required>
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
    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
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
        $("#level").select2({
            placeholder: "Select the Level"
        });
    </script>
    <script type="text/javascript">   // Edit data
        $(document).ready(function () {
            $('#reload-category').on('click', '.category-edit', function () {
                let id = $(this).attr('data-id');
                $.ajax({
                    url: "{{url('catservices')}}/" + id + '/edit',
                    method: "get",
                    data: {},
                    dataType: 'json',
                    success: function (data) {
                        let url = window.location.origin;
                        console.log('data', data);
                        $('#tagsupdate').find('#cat2').val(data.portfolio_category_id);
                        $('#tagsupdate').find('#category-edit-name').val(data.name);
                        $('#tagsupdate').find('#category-edit-id').val(data.category_related_service_id);
                        $('#position2').val(data.position);
                        $('#level2').val(data.level);


                        if (data.icon) {
                            $('#category-edit-form').find('#category-edit-image').html(`<img width="100%" height="200px"  src="${url}/${data.icon}"/>`);
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

    <script>

        //save data
        $('#catservestore').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: "{{route('catservices.store')}}",
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
                        }, 1000);
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
                            url: "{!! route('catservices.destroy') !!}",
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
                url: "{{route('catservices.updated')}}",
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
    <script>
        //get portfolio category
        $(document).on('change', '.cat_selector', function (e) {
            e.preventDefault();
            let id = $(this).val();
            console.log(id);
            $.ajax({
                method: 'get',
                data: {
                    id
                },
                url: '{{ url('out-category-for-position') }}/' + id,
                success: function (result) {
                    console.log('result', result);
                    $('#myModalSave').find('#valuecat').val(result);
                    $('#catservestore').find('.position_list').empty();
                    $('#catservestore').find('.position_list').append(`<option value="">Search & Select</option>`);
                    $.each(result, function (key, value) {
                        $('#catservestore').find('.position_list').append(`<option value="${value}">Position ${value}</option>`);
                    })
                },
                error: function (err) {
                    console.log(err)
                }
            })
            $('.hideportion').show();

        });
    </script>
    <script>
        $(document).on('change', '#cat', function (e) {
            e.preventDefault();
            let id = $(this).val();
            console.log(id);

            $.ajax({
                method: 'get',
                data: {
                    id
                },
                url: '{{ url('related-level') }}/' + id,
                success: function (result) {

                    var value = Object.values(result);
                    var pass = parseInt(result) + 1;
                    console.log(typeof (result));
                    if (value.length == 0) {
                        $('#myModalSave').find('#position').val("1");
                    } else {
                        $('#myModalSave').find('#position').val(pass);
                        $('#myModalSave').find('#position').val(pass);
                    }
                },
                error: function (err) {
                    console.log(err)
                }
            })

        });
        $(document).on('change', '#cat2', function (e) {
            e.preventDefault();
            let id = $(this).val();
            console.log(id);

            $.ajax({
                method: 'get',
                data: {
                    id
                },
                url: '{{ url('related-level-update') }}/' + id,
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
            $("#position").on("change keyup paste", function () {
                let id = $(this).val();
                console.log(id);
                var value = $('#position').val();
                // alert(pos);

                $.ajax({
                    method: 'get',
                    data: {
                        id, value
                    },
                    url: '{{ url('get-position') }}/' + id + '/' + value,
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
                            // $('#catservestore').find('#position').val('');
                        }
                    },
                    error: function (err) {
                        console.log(err)
                    }
                })

            });
        });


        $(document).ready(function () {
            $("#position2").on("change keyup paste", function () {
                let id = $(this).val();
                console.log(id);
                var value = $('#position2').val();
                // alert(pos);

                $.ajax({
                    method: 'get',
                    data: {
                        id, value
                    },
                    url: '{{ url('get-position-update') }}/' + id + '/' + value,
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
