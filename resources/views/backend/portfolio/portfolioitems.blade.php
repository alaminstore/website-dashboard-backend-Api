@extends('backend.home')
@section('title','Portfolio Items')
@section('style')
    <link href="assets/plugins/summernote/summernote.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
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
            border-radius: 7%;
        }
        .hideportion{
            display:none;
        }
    </style>
    <div class="row" id="okreload">
        <div class="col-md-12" id="reloadId">


            &nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-secondary waves-effect waves-light" title="Edit" data-toggle="modal"
                    data-target="#myModalSave">
                <i class="ion-plus"></i>Add new Portfolio Item
            </button>



           <div id="reload-category">
            <div class="list text-center">
                <h6 class="display-4" style="font-size: 20px;">Portfolio Item List</h6>
            </div>
            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                <thead>
                <tr class="text-center">
                    <th>#SL</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Url</th>
                    <th>Client</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="tbodytags" id="loadnow">
                @php
                    $i=0;
                @endphp
                @foreach($portfolioitems  as $item)
                    <tr class="text-center unqtags{{$item->portfolio_item_id}}">
                        <td><b>{{$i+=1}}</b></td>
                        <td>{{$item->title}}</td>
                        <td class="cat_img">
                            <img src="{{$item->image}}" class="img-fluid" alt="portfolio Category Image">
                        </td>
                        <td><a href="{{$item->url}}" target="_blank">{{$item->url}}</a></td>
                        <td>
                            {{$item->getClient->name}}
                        </td>
                        <td>
                            <button type="button"
                                    class="btn btn-sm btn-outline-primary waves-effect waves-light category-edit"
                                    data-id="{{$item->portfolio_item_id}}" title="Edit"
                                    data-toggle="modal" data-target="#myModal">
                                <i class="mdi mdi-border-color"></i>
                            </button>
                            <a class="deletetag" data-id="{{$item->portfolio_item_id}}">
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
                    <h5 class="modal-title mt-0" id="myModalLabel">Portfolio Item Add</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    {!!Form::open(['class' => 'form-horizontal','id'=>'catservestore'])!!}
                    @csrf

                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-4 col-form-label">Portfolio Categories</label>
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
                            <input type="file" name="image" id="image" class="dropify" required/>
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
                            <select style="width: 200px" id="client_id" name="client_id">
                                <option></option>
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
                            <select class="position_list" id="position" name="position">
                                <option></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="portfolio_cat_icon" class="col-sm-4 col-form-label">Tags</label>
                        <div class="col-sm-8">
                            <select style="width: 200px" class="tag_id" id="tag_id" name="tag_id[]" multiple="multiple">
                                <option></option>
                                @foreach ($tags as $tag)
                                <option value="{{$tag->tag}}">{{$tag->tag}}</option>
                                @endforeach
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
                    <h5 class="modal-title mt-0" id="myModalLabel">Portfolio Item Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                {!!Form::open(['class' => 'form-horizontal','id'=>'tagsupdate'])!!}
                    @csrf
                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-4 col-form-label">Portfolio Categories</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="cat2" class="cat_selector" name="portfolio_category_id">
                                <option></option>
                                @foreach($portfolio_cat as $cat)
                                    <option value="{{$cat->portfolio_category_id}}">{{$cat->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
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
                            <input type="file" name="image" id="image" class="dropify" required/>
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
                            <select class="form-control" id="client_id2" name="client_id">
                                <option></option>
                                @foreach ($clients as $client)
                                <option value="{{$client->client_id}}">{{$client->name}}</option>
                                @endforeach
                            </select>
                            <div id="feedback"></div>
                        </div>
                    </div>
                    <div class="form-group row flex_css">
                        <label for="position" class="col-sm-4 col-form-label">Position</label>
                        <div class="col-sm-8">
                            <select class="position_list form-control" id="position2" name="position">
                                <option></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="portfolio_cat_icon" class="col-sm-4 col-form-label">Tags</label>
                        <div class="col-sm-8">
                            <select class="form-control" class="tag_id2" id="tag_id" name="tag_id[]" multiple="multiple">
                                <option></option>
                                @foreach ($tags as $tag)
                                <option value="{{$tag->tag}}">{{$tag->tag}}</option>
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

@endsection
@section('scripts')

    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="assets/plugins/parsleyjs/parsley.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.tag_id').select2();
            $('.tag_id2').select2();
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
            $('#datatable').DataTable();
        });
    </script>
    <script type="text/javascript">
        $("#cat").select2({
            placeholder: "Select the Category"
        });
        $("#position").select2({
            placeholder: "Select the Position"
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
                        let url = window.location.origin;
                        console.log('data', data);
                        $('#tagsupdate').find('#title').val(data.title);
                        $('#tagsupdate').find('#url').val(data.url).focus();
                        $('#tagsupdate').find('#category-edit-id').val(data.portfolio_item_id);
                        var clientid =  $('#tagsupdate').find('#ClientData').val(data.client_id);
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
        $("#cat").select2({
            placeholder: "Select Portfolio Category"
        });
        $("#ClientData").select2({
            placeholder: clientid
        });
        $("#cat2").select2({
            placeholder: clientid
        });
        $("#client_id2").select2({
            placeholder: clientid
        });
        $("#position2").select2({
            placeholder: clientid
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
                const $position_list = $(catservestore).parents('tr').find('.position_list');
                // const $position_list = $(this).parents('tr').find('.position_list');

                $.ajax({
                    method: 'get',
                    data: {
                        id
                    },
                    url: '{{ url('out-category-for-portfolio-position') }}/' + id,
                    success: function (result) {
                        console.log('result',result);
                        $('#myModalSave').find('#valuecat').val(result);
                        $('#catservestore').find('.position_list').empty();
                        $('#catservestore').find('.position_list').append(`<option value="">Search & Select</option>`);
                        // var position = $('#myModalSave').find('#valuecat').val(Object.values(result[0]));
                        $.each(result, function (key, value) {
                            $('#catservestore').find('.position_list').append(`<option value="${value}">PositionTest ${value}</option>`);
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
