@extends('backend.home')
@section('title','Categories')
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
    <div class="card m-b-20">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    &nbsp;&nbsp;&nbsp;&nbsp;<button type="button"
                                                    class="btn btn-secondary waves-effect waves-light clearData"
                                                    title="Edit" data-toggle="modal" data-target="#myModalSave">
                        <i class="ion-plus"></i> Add New Portfolio Categories
                    </button>
                </div>

            </div>
            <div class="list text-center">
                <h6 class="display-4" style="font-size: 20px;">Categories List</h6>
            </div>
            <div id="reload-category">
                <div class="row">
                    <div class="col-md-12">

                        <table id="datatable" class="table table-bordered dt-responsive nowrap"
                               style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                            <thead>
                            <tr class="text-center">
                                <th>Name</th>
                                <th>Icon</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody class="tbodytags" id="loadnow">

                            @foreach($portfolio_cat  as $cat)
                                <tr class="text-center">

                                    <td>{{$cat->name}}</td>
                                    <td class="cat_img"><img src="{{$cat->icon}}" class="img-fluid"
                                                             alt="portfolio Category Image">
                                    </td>
                                    <td>{{ \Illuminate\Support\Str::limit($cat->description, 50, $end='...') }}</td>
                                    <td>
                                        <button type="button"
                                                class="btn btn-sm btn-outline-info waves-effect waves-light viewData"
                                                data-id="{{$cat->portfolio_category_id}}">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                        <button type="button"
                                                class="btn btn-sm btn-outline-primary waves-effect waves-light category-edit"
                                                data-id="{{$cat->portfolio_category_id}}" title="Edit">
                                            <i class="mdi mdi-border-color"></i>
                                        </button>
                                        <a class="deletetag" data-id="{{$cat->portfolio_category_id}}">
                                            <button class="btn btn-outline-danger btn-sm category-delete"
                                                    title="Delete"><i
                                                    class="ti-trash"></i></button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-1"></div>
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
                        <label for="name" class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="name" name="name"
                                   placeholder="Portfolio Category Name" required>
                        </div>
                    </div>
                    <div class="form-group row flex_css">
                        <label for="description" class="col-sm-3 col-form-label">Description</label>
                        <div class="col-sm-9">
                            <textarea class="description_css form-control" name="description" id="faq-question-answer" placeholder="Description here..."
                                      required></textarea>
                        </div>
                    </div>
                    <div class="form-group row flex_css">
                        <label for="portfolio_cat_icon" class="col-sm-3 col-form-label">Icon</label>
                        <div class="col-sm-9">
                            <input type="file" name="image" id="portfolio_cat_icon" class="dropify" required>
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

    <!--modal content  Update-->
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Portfolio Categories Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    {!!Form::open(['class' => 'form-horizontal','id'=>'tagsupdate'])!!}
                    @csrf
                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="category-edit-name" name="name"
                                   placeholder="Portfolio Category Name" required>
                            <input type="hidden" name="category_id" id="category-edit-id" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row flex_css">
                        <label for="description" class="col-sm-3 col-form-label">Description</label>
                        <div class="col-sm-9">
                            <textarea class="description_css form-control" name="description" id="description-edit" placeholder="Description here..."
                                      required> </textarea>
                        </div>
                    </div>
                    <div class="form-group row flex_css">
                        <label for="portfolio_cat_icon" class="col-sm-3 col-form-label">Icon</label>
                        <div class="col-sm-9" id="portfolio_cat_icon2">
                            <input type="file" name="image" id="icon2" class="dropify">
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

    <div id="viewModel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Portfolio Category Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body" style="background: #f5f5f5;">

                    <div class="Catname d-flex">
                        <p><b>Portfolio Category Name:&nbsp;&nbsp;&nbsp;</b></p>
                        <div id="viewName"></div>
                        <br>
                    </div>

                    <div class="desc">
                        <p><b>Portfolio Category Description:&nbsp;&nbsp;&nbsp;</b></p>
                        <div id="viewDescription"></div>
                    </div>
                    <div class="iconview">
                        <p><b>Portfolio Category Icon:&nbsp;&nbsp;&nbsp;</b></p>
                        <div id="viewIcon" class="text-center"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script>
        $("#catservestore").validate({
        rules: {
            name: {
                required:true,
                maxlength: 100,
            },
            description: {
                required:true,
            },
            image: {
                required:true,
            },
        }
      });
        $("#tagsupdate").validate({
            rules: {
            name: {
            required:true,
            maxlength: 100,
            },
            description: {
                required:true,
            },
        }
      });
    </script>
    <script>
        $('.dropify').dropify();
        $(document).ready(function () {
            $('#datatable').DataTable();
            $(".clearData").on('click', function () {
                $('.dropify-preview').hide();
            });
        });
    </script>
    <script type="text/javascript">  //edit
        $(document).ready(function () {
            $('#reload-category').on('click', '.category-edit', function () {
                let id = $(this).attr('data-id');

                $.ajax({
                    url: "{{url('portfolio-categories')}}/" + id + '/edit',
                    method: "get",
                    data: {},
                    dataType: 'json',
                    success: function (response) {
                        console.log(response);
                        $('#category-edit-name').val(response.data.name);
                        $('#category-edit-id').val(response.data.portfolio_category_id);
                        $('#description-edit').val(response.data.description);
                        if (response.data.icon) {
                            var img_url = '{!!URL::to('/')!!}' + "/" + response.data.icon;
                            console.log(img_url);
                            $("#icon2").attr("data-height", 100);
                            $("#icon2").attr("data-default-file", img_url);
                            $(".dropify-wrapper").removeClass("dropify-wrapper").addClass("dropify-wrapper has-preview");
                            $(".dropify-preview").css('display', 'block');
                            $('.dropify-render').html('').html('<img src=" ' + img_url + '" style="max-height: 100px;">')
                        } else {
                            $(".dropify-preview .dropify-render img").attr("src", "");
                        }
                        $("#icon2").dropify();
                        $('#myModal').modal('show');
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
                    url: "{{url('cat-view')}}/" + id,
                    method: "get",
                    data: {},
                    dataType: 'json',
                    success: function (response) {
                        let url = window.location.origin;
                        console.log(response.data.name);
                        $('#viewName').text(response.data.name);
                        $('#viewDescription').text(response.data.description);
                        $('#viewIcon').html(`<img width="300" height="300" class="img-fluid"  src="${url}/${response.data.icon}" class="dropify"/>`);
                        $('#viewModel').modal('show');
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
            var $form = $(this);
            if(! $form.valid()) return false;
            $.ajax({
                url: "{{route('portfoliocat.store')}}",
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

                    if(data.status == 0){
                    // toastr.error('Password must contain minimum 8 character!');
                    $.each(data.error,function(key,value){
                    toastr.error(value);
                    })
                    }else{
                        $('#myModalSave').modal('hide');
                        toastr.success('Data Inserted Successfully');
                        $('#catservestore').trigger('reset');
                        setTimeout(function () {
                            $("#loadnow").load(location.href + " #loadnow>*", "");
                        }, 1000);
                    }
                }

            });

        });

        //Delete data
        $(document).on('click', '.deletetag', function (e) {
            e.preventDefault();
            var $form = $(this);
            if(! $form.valid()) return false;
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
                            url: "{!! route('portfoliocat.destroy') !!}",
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
            var $form = $(this);
            if(! $form.valid()) return false;
            $.ajax({
                url: "{{route('portfoliocat.updated')}}",
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
                    if(data.status == 0){
                    // toastr.error('Password must contain minimum 8 character!');
                    $.each(data.error,function(key,value){
                    toastr.error(value);
                    })
                    }else{
                        $('#myModal').modal('hide');
                        setTimeout(function () {
                            $("#loadnow").load(location.href + " #loadnow>*", "");
                        }, 1);
                        toastr.success('Data Updated Successfully');
                        $('#tagsupdate').trigger('reset');
                    }
                }
            });

        });
    </script>
@endsection
