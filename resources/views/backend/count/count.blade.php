@extends('backend.home')
@section('title','Counts')
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
    <div class="row" id="okreload">
        <div class="col-md-12" id="reloadId">
            &nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-secondary waves-effect waves-light" title="Edit" data-toggle="modal"
                    data-target="#myModalSave">
                <i class="ion-plus"></i> Add New Count
            </button>
            <div id="reload-category">
                <div class="list text-center">
                    <h6 class="display-4" style="font-size: 20px;">Count List</h6>
                </div>
                <table id="myTable" class="table table-bordered dt-responsive nowrap"
                       style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr class="text-center">
                        <th>#SL</th>
                        <th>Parameter</th>
                        <th>Value</th>
                        <th>Position</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody class="tbodytags" id="loadnow">
                    @php
                        $i=0;
                    @endphp
                    @foreach($counts  as $count)
                        <tr class="text-center unqtags{{$count->count_id}}">
                            <td><b>{{$i+=1}}</b></td>
                            <td>{{$count->parameter}}</td>
                            <td>{{$count->value}}</td>
                            <td>{{$count->position}}</td>
                            <td>
                                <button type="button"
                                        class="btn btn-sm btn-outline-info waves-effect waves-light viewData"
                                        data-id="{{$count->count_id}}" data-toggle="modal"
                                        data-target=".bs-example-modal-lg">
                                    <i class="fa fa-eye"></i>
                                </button>
                                <button type="button"
                                        class="btn btn-sm btn-outline-primary waves-effect waves-light category-edit"
                                        data-id="{{$count->count_id}}" title="Edit"
                                        data-toggle="modal" data-target="#myModal">
                                    <i class="mdi mdi-border-color"></i>
                                </button>
                                <a class="deletetag" data-id="{{$count->count_id}}">
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
    <div id="myModalSave" class="modal fade" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Count Add</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    {!!Form::open(['class' => 'form-horizontal','id'=>'catservestore'])!!}
                    @csrf
                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-2 col-form-label">Parameter</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="parameter"
                                   placeholder="Parameter Here..."
                                   required>
                        </div>
                    </div>
                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-2 col-form-label">Value</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="value"
                                   placeholder="Value Here..."
                                   required>
                        </div>
                    </div>

                    <div class="form-group row flex_css">
                        <label for="portfolio_cat_icon" class="col-sm-2 col-form-label">Position</label>
                        <div class="col-sm-8">
                            <select style="width: 200px" id="position" name="position">
                                <option></option>
                                @php($i=1)
                                @for($i=1;$i<=3;$i++)
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
    <div id="myModal" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Count Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    {!!Form::open(['class' => 'form-horizontal','id'=>'tagsupdate'])!!}
                    @csrf
                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-2 col-form-label">Parameter</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="parameter" name="parameter"
                                   placeholder="Parameter Here..."
                                   required>
                            <input type="hidden"  name="category_id" id="category-edit-id" class="form-control" >
                        </div>
                    </div>
                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-2 col-form-label">Value</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="value" name="value"
                                   placeholder="Value Here..."
                                   required>
                        </div>
                    </div>

                    <div class="form-group row flex_css">
                        <label for="portfolio_cat_icon" class="col-sm-2 col-form-label">Position</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="position2" name="position">
                                @php($i=1)
                                @for($i=1;$i<=3;$i++)
                                    <option value="{{$i}}">Position {{$i}}</option>
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

    {{-- View Modal --}}
<div id="#viewModel" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
                     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title mt-0" id="myLargeModalLabel">Service Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body" style="background: #f5f5f5;">

            <div class="Catname d-flex">
                <p><b>Parameter:&nbsp;&nbsp;&nbsp;</b></p>
                <div id="viewParameter"></div>
                <br>
            </div>
            <div class="Catname d-flex">
                <p><b>Value:&nbsp;&nbsp;&nbsp;</b></p>
                <div id="viewValue"></div>
                <br>
            </div>
            <div class="Catname d-flex">
                <p><b>Position:&nbsp;&nbsp;&nbsp;</b></p>
                <div id="viewPosition"></div>
                <br>
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
                    url: "{{url('count')}}/" + id + '/edit',
                    method: "get",
                    data: {},
                    dataType: 'json',
                    success: function (data) {
                        let url = window.location.origin;
                        console.log('data', data);
                        $('#tagsupdate').find('#parameter').val(data.parameter).focus();
                        $('#tagsupdate').find('#value').val(data.value).focus();
                        $('#tagsupdate').find('#category-edit-id').val(data.count_id);
                        $('#position2').val(data.position);

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


            //View===============================================================
            $('#reload-category').on('click', '.viewData', function () {
                let id = $(this).attr('data-id');
                console.log('id--', id);
                $.ajax({
                    url: "{{url('count-view')}}/" + id,
                    method: "get",
                    data: {},
                    dataType: 'json',
                    success: function (data) {
                        let url = window.location.origin;
                        console.log('data', data);
                        $('#viewParameter').html(data.parameter);
                        $('#viewValue').html(data.value);
                        $('#viewPosition').html(data.position);

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
        $("#position2").select2();
    </script>

    <script>

        //save data
        $('#catservestore').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: "{{route('count.store')}}",
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
                            url: "{!! route('count.destroy') !!}",
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
                url: "{{route('count.updated')}}",
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
