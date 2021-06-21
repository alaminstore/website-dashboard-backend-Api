@extends('backend.home')
@section('title','Portfolio Items')
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
    <div class="card m-b-20">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12" id="reloadId">
                    &nbsp;&nbsp;&nbsp;&nbsp;<button type="button"
                                                    class="btn btn-secondary waves-effect waves-light clearData"
                                                    title="Edit" data-toggle="modal"
                                                    data-target="#myModalSave">
                        <i class="ion-plus"></i> Add new Portfolio Item
                    </button>


                    <div id="reload-category">
                        <div class="list text-center">
                            <h6 class="display-4" style="font-size: 20px;">Portfolio Item List</h6>
                        </div>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap"
                               style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                            <thead>
                            <tr class="text-center">
                                <th>Portfolio Category</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Level</th>
                                <th>Position</th>
                                <th>Url</th>
                                <th>Client</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody class="tbodytags" id="loadnow">
                            @foreach($portfolioitems  as $item)
                                <tr class="text-center unqtags{{$item->portfolio_item_id}}">
                                    <td>{{$item->getCategory->name}}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($item->title, 20, $end='...') }}</td>
                                    <td class="cat_img">
                                        <img src="{{$item->image}}" class="img-fluid" alt="portfolio Category Image">
                                    </td>
                                    <td>{{$item->level}}</td>
                                    <td>{{$item->position_one}}</td>
                                    <td><a href="{{$item->url}}" target="_blank">{{$item->url}}</a></td>
                                    <td>
                                        {{$item->getClient->name}}
                                    </td>
                                    <td>
                                        <button type="button"
                                                class="btn btn-sm btn-outline-info waves-effect waves-light viewData"
                                                data-id="{{$item->portfolio_item_id}}">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                        <button type="button"
                                                class="btn btn-sm btn-outline-primary waves-effect waves-light category-edit"
                                                data-id="{{$item->portfolio_item_id}}" title="Edit"
                                                data-toggle="modal" data-target="#myModal">
                                            <i class="mdi mdi-border-color"></i>
                                        </button>
                                        <a class="deletetag" data-id="{{$item->portfolio_item_id}}">
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
                </div>
            </div>
        </div>
    </div>
    <!--modal content  Save-->
    <div id="myModalSave" class="modal fade" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Portfolio Item Add</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    {!!Form::open(['class' => 'form-horizontal','id'=>'catservestore'])!!}
                    @csrf

                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-4 col-form-label">Portfolio Categories</label>
                        <div class="col-sm-8">
                            <select style="width: 200px" id="cat" class="cat_selector" name="portfolio_category_id"
                                    required>
                                <option value=""></option>
                                @foreach($portfolio_cat as $cat)
                                    <option value="{{$cat->portfolio_category_id}}">{{$cat->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-4 col-form-label">Title</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="title"
                                   placeholder="Title Here..."
                                   required>
                        </div>
                    </div>
                    <div class="form-group row flex_css">
                        <label for="image" class="col-sm-4 col-form-label">Image</label>
                        <div class="col-sm-8">
                            <input type="file" name="image" id="image" class="dropify" required/>
                        </div>
                    </div>
                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-4 col-form-label">Level</label>
                        <div class="col-sm-8">
                            <select class="cat_selector2 form-control" id="level" name="level" required>
                                <option value="">Select The Level</option>
                                <option value="1">Level 1</option>
                                <option value="2">Level 2</option>
                                <option value="3">Level 3</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-4 col-form-label">Url</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="url"
                                   placeholder="Url Here..."
                                   required>
                        </div>
                    </div>
                    <div class="form-group row flex_css">
                        <label for="portfolio_cat_icon" class="col-sm-4 col-form-label">Client</label>
                        <div class="col-sm-8">
                            <select style="width: 200px" id="client_id" name="client_id" required>
                                <option value=""></option>
                                @foreach ($clients as $client)
                                    <option value="{{$client->client_id}}">{{$client->name}}</option>
                                @endforeach
                            </select>
                            <div id="feedback"></div>
                        </div>
                    </div>
                    <div class="form-group row flex_css">
                        <label for="portfolio_cat_icon" class="col-sm-4 col-form-label">Position</label>
                        <div class="col-sm-8">
                            <select class="position_list" id="position" name="position" required>
                                <option value=""></option>
                                @php($i=1)
                                @for ($i=1;$i<=9;$i++)
                                    <option disabled value="{{$i}}">Position {{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="portfolio_cat_icon" class="col-sm-4 col-form-label">Tags</label>
                        <div class="col-sm-8">
                            <select style="width: 200px" class="tag_id" id="tag_id" name="tag_id[]" multiple="multiple"
                                    required>
                                <option value=""></option>
                                @foreach ($tags as $tag)
                                    <option value="{{$tag->tag_id}}">{{$tag->tag}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group m-b-0">
                        <div>
                            <button type="submit" id="submit" class="btn btn-primary waves-effect waves-light">
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
    <div id="myModal" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Portfolio Item Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    {!!Form::open(['class' => 'form-horizontal','id'=>'tagsupdate'])!!}
                    @csrf
                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-4 col-form-label">Portfolio Categories</label>
                        <div class="col-sm-8">
                            <select class="cat_selector2 form-control" id="cat2" name="portfolio_category_id" required>
                                <option disabled value="">Select Category...</option>
                                @foreach($portfolio_cat as $cat)
                                    <option value="{{$cat->portfolio_category_id}}">{{$cat->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="category_id" id="category-edit-id" class="form-control">
                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-4 col-form-label">Title</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="title" name="title"
                                   placeholder="Title Here..."
                                   required>
                        </div>
                    </div>
                    <div class="form-group row flex_css">
                        <label for="image" class="col-sm-4 col-form-label">Image</label>
                        <div class="col-sm-8">
                            <input type="file" name="image" id="image2" class="dropify"/>
                        </div>
                    </div>
                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-4 col-form-label">Level</label>
                        <div class="col-sm-8">
                            <select class="cat_selector2 form-control" id="level2" name="level" required>
                                <option disabled value="">Select Level</option>
                                <option value="1">Level 1</option>
                                <option value="2">Level 2</option>
                                <option value="3">Level 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-4 col-form-label">Url</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="url" name="url"
                                   placeholder="Url Here..."
                                   required>
                        </div>
                    </div>

                    <div class="form-group row flex_css">
                        <label for="portfolio_cat_icon" class="col-sm-4 col-form-label">Client</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="client_id2" name="client_id" required>
                                <option disabled value="">Select Client...</option>
                                @foreach ($clients as $client)
                                    <option value="{{$client->client_id}}">{{$client->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row flex_css">
                        <label for="portfolio_cat_icon" class="col-sm-4 col-form-label">Position</label>
                        <div class="col-sm-8">
                            <select class="position_list2 form-control" id="position2" name="position">
                                @php($i=1)
                                @for ($i=1;$i<=9;$i++)
                                    <option disabled value="{{$i}}">Position {{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="portfolio_cat_icon" class="col-sm-4 col-form-label">Tags</label>
                        <div class="col-sm-8">
                            <select style="width: 200px" class="" id="newTagId" name="tag_id[]" multiple="multiple" required>
                                <option value=""></option>
                                @foreach ($tags as $tag)
                                    <option value="{{$tag->tag_id}}">{{$tag->tag}}</option>
                                @endforeach
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

    {{-- View Modal --}}
    <div id="viewModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Portfolio Item Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body" style="background: #f5f5f5;">
                    <div class="Catname">
                        <div class="d-flex">
                            <div class="col-md-4 p-0">
                                <p><b>Portfolio Category:</b></p>
                            </div>
                            <div class="col-md-8 p-0">
                                <div id="viewCat"></div>
                            </div>
                        </div>
                    </div>
                    <div class="Catname">
                        <div class="d-flex">
                            <div class="col-md-4 p-0">
                                <p><b>Title:</b></p>
                            </div>
                            <div class="col-md-8 p-0">
                                <div id="viewTitle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="Catname">
                        <div class="d-flex">
                            <div class="col-md-4 p-0">
                                <p><b>Client Name:</b></p>
                            </div>
                            <div class="col-md-8 p-0">
                                <div id="viewClient"></div>
                            </div>
                        </div>
                    </div>
                    <div class="Catname">
                        <div class="d-flex">
                            <div class="col-md-4 p-0">
                                <p><b>Level:</b></p>
                            </div>
                            <div class="col-md-8 p-0">
                                <div id="viewLevel"></div>
                            </div>
                        </div>
                    </div>
                    <div class="Catname">
                        <div class="d-flex">
                            <div class="col-md-4 p-0">
                                <p><b>Position:</b></p>
                            </div>
                            <div class="col-md-8 p-0">
                                <div id="viewPosition"></div>
                            </div>
                        </div>
                    </div>
                    <div class="Catname">
                        <div class="d-flex">
                            <div class="col-md-4 p-0">
                                <p><b>Url:</b></p>
                            </div>
                            <div class="col-md-8 p-0">
                                <div id="viewUrl"></div>
                            </div>
                        </div>
                    </div>
                    <div class="Catname">
                        <div class="d-flex">
                            <div class="col-md-4 p-0">
                                <p><b>Tags:</b></p>
                            </div>
                            <div class="col-md-8 p-0">
                                <div class="viewTag"></div>
                            </div>
                        </div>
                    </div>
                    <div class="Catname">
                        <div class="col-md-4 p-0">
                            <p><b>Image:</b></p>
                        </div>
                        <div class="col-md-12">
                            <div id="viewImage" class="text-center"></div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.tag_id').select2();
        });
    </script>

    <script>
        $('.dropify').dropify();
        $(document).ready(function () {
            $('form').parsley();
        });
    </script>
    <script>
        $(document).ready(function () {
            $(".clearData").on('click', function () {
                $('.dropify-preview').hide();
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#datatable').DataTable();
        });
    </script>
    <script type="text/javascript">
        $("#cat").select2({
            placeholder: "Select the Portfolio Category",
        });
        $("#position").select2({
            placeholder: "Select the Portfolio Category First"
        });
        $("#client_id").select2({
            placeholder: "Select the Client"
        });

    </script>
    <script type="text/javascript">   // Edit data
        $(document).ready(function () {
            $('#reload-category').on('click', '.category-edit', function () {
                let id = $(this).attr('data-id');

                $.ajax({
                    url: "{{url('portfoliorestitemsedit')}}/" + id + '/edit',
                    method: "get",
                    data: {},
                    dataType: 'json',
                    success: function (data) {
                        // let url = window.location.origin;
                        console.log('data', data);
                        $('#tagsupdate').find('#title').val(data.title);
                        $('#tagsupdate').find('#url').val(data.url);

                        $('#tagsupdate').find('#category-edit-id').val(data.portfolio_item_id);
                        $('#client_id2').val(data.client_id);
                        var positiondata = $('#tagsupdate').find('#position2').val(data.position_one);
                        var catData = $('#cat2').val(data.portfolio_category_id);
                        $("#position2").select2({
                            placeholder: positiondata
                        });
                        $("#position2").select2({
                            placeholder: positiondata
                        });
                        $("#client_id2").select2();
                        $("#newTagId").select2();
                        $('#level2').val(data.level);
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

                        var tagId = [];
                        $.each(data.get_tag, function (key, value) {
                            //    console.log(value);
                            tagId.push(value.tag_id)
                        })
                        console.log(tagId);

                        $('#newTagId').val(tagId);
                        $('#newTagId').trigger('change');


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
                    url: "{{url('item-view')}}/" + id,
                    method: "get",
                    data: {},
                    dataType: 'json',
                    success: function (response) {
                        let url = window.location.origin;
                        // console.log('data', data);
                        $('#viewTitle').html(response.data.title);
                        $('#viewClient').html(response.data.get_client.name);
                        $('#viewUrl').html(`<a href="${response.data.url}" target="__blank">${response.data.url}</a>`);
                        $('#viewLevel').html(response.data.level);
                        $('#viewImage').html(`<img width="300" height="300"  src="${url}/${response.data.image}"/>`);
                        $('#viewCat').text(response.data.get_category.name);
                        $('#viewPosition').text(response.data.position_one);

                        $.each(response.data.get_tag, function (key, value) {
                            $('.viewTag').append(`<span>${value.tag}</span>,&nbsp;&nbsp;`);
                            // console.log(value);
                        })
                        $('#viewModal').modal('show');
                        console.log(response);


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
                url: "{{route('portfolio.store')}}",
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
                    }, 1);
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
                            url: "{!! route('portfolio.destroy') !!}",
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
                url: "{{route('portfolio.updated')}}",
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
            // console.log(id);
            const $position_list = $(catservestore).parents('tr').find('.position_list');
            // const $position_list = $(this).parents('tr').find('.position_list');

            $.ajax({
                method: 'get',
                data: {
                    id
                },
                url: '{{ url('out-category-for-portfolio-position') }}/' + id,
                success: function (result) {
                    // console.log('result',result);
                    $('#myModalSave').find('#valuecat').val(result);
                    $('#catservestore').find('.position_list').empty();
                    $('#catservestore').find('.position_list').append(`<option value="">Search & Select</option>`);
                    // var position = $('#myModalSave').find('#valuecat').val(Object.values(result[0]));
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
        //get portfolio category
        $(document).on('change', '.cat_selector2', function (e) {
            e.preventDefault();
            let id = $(this).val();
            // console.log(id);
            const $position_list = $(catservestore).parents('tr').find('.position_list2');
            // const $position_list = $(this).parents('tr').find('.position_list');

            $.ajax({
                method: 'get',
                data: {
                    id
                },
                url: '{{ url('out-cat-value') }}/' + id,
                success: function (result) {
                    // console.log('result',result);
                    $('#myModalSave').find('#valuecat').val(result);
                    $('#tagsupdate').find('.position_list2').empty();
                    $('#tagsupdate').find('.position_list2').append(`<option disabled value="">Select Here...</option>`);
                    // var position = $('#myModalSave').find('#valuecat').val(Object.values(result[0]));
                    $.each(result, function (key, value) {
                        $('#tagsupdate').find('.position_list2').append(`<option value="${value}">Position ${value}</option>`);
                    })
                },
                error: function (err) {
                    console.log(err)
                }
            })
            $('.hideportion').show();

        });
    </script>

@endsection
