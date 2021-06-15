@extends('backend.home')
@section('title','Category Related Services')
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
    </style>
    <div class="row" id="okreload">
        <div class="col-md-12" id="reloadId">
            &nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-secondary waves-effect waves-light" title="Edit" data-toggle="modal"
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
                            <input type="file" name="image" id="input-file-now" class="dropify"/>
                        </div>
                    </div>
                    <div class="form-group row flex_css">
                        <label for="portfolio_cat_icon" class="col-sm-4 col-form-label">Position</label>
                        <div class="col-sm-8">
                            <select style="width: 200px" id="position" name="position">
                                <option></option>
                                @php($i=1)
                                @for($i=1;$i<=9;$i++)
                                    @if(\App\Models\CategoryRelatedServices::where('position', '=', $i)->exists())
                                        @continue
                                    @endif
                                    <option value="{{$i}}">Position {{$i}}</option>
                                @endfor
                            </select>
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
                                <option></option>
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
                    <div class="form-group row">
                        <label for="portfolio_cat_icon" class="col-sm-4 col-form-label">Position</label>
                        <div class="col-sm-12">
                            <select class="form-control" id="position2" name="position">
                                <option></option>
                                @php($i=1)
                                @for($i=1;$i<=9;$i++)
                                    @if(\App\Models\CategoryRelatedServices::where('position', '=', $i)->exists())
                                        <option disabled style="background: red" value="{{$i}}">Position {{$i}}</option>
{{--                                                                                @continue--}}
                                    @else
                                        <option value="{{$i}}">Position {{$i}}</option>
                                    @endif

                                @endfor
                            </select>
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
                        var catdata = $('#tagsupdate').find('#cat2').val(data.portfolio_category_id);
                        $('#tagsupdate').find('#category-edit-name').val(data.name);
                        $('#tagsupdate').find('#category-edit-id').val(data.category_related_service_id);
                        var positiondata = $('#tagsupdate').find('#position2').val(data.position);


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
                    $('#myModalSave').modal('hide');
                    setTimeout(function () {
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
                        console.log('result',result);
                        // $('#reloadId').find('#cat_input').val(result.portfolio_category_id);

                    },
                    error: function (err) {
                        console.log(err)
                    }
                })
                $('.hideportion').show();

            });
    </script>
@endsection
