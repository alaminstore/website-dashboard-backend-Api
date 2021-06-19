@extends('backend.home')
@section('title','Terms & Policies')
<style>
    .textarea#description2 {
        min-height: 220px;
    }
</style>
@section('content')
    <div class="card m-b-20">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12" id="reloadId">
                    &nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-secondary waves-effect waves-light"
                                                    title="Edit" data-toggle="modal"
                                                    data-target="#myModalSave">
                        <i class="ion-plus"></i> Terms Policy
                    </button>
                    <div id="reload-category">
                        <div class="list text-center">
                            <h6 class="display-4" style="font-size: 20px;">Count List</h6>
                        </div>
                        <table id="myTable" class="table table-bordered dt-responsive nowrap"
                               style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr class="text-center">
                                <th>Title</th>
                                <th>Sub-Title</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody class="tbodytags" id="loadnow">
                            @foreach($terms as $term)
                                <tr class="text-center unqtags{{$term->terms_policie_id}}">
                                    <td>{{ \Illuminate\Support\Str::limit($term->title, 20, $end='...') }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($term->subtitle, 40, $end='...') }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($term->description, 40, $end='...') }}</td>
                                    <td>
                                        <button type="button"
                                                class="btn btn-sm btn-outline-info waves-effect waves-light viewData"
                                                data-id="{{$term->terms_policie_id}}">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                        <button type="button"
                                                class="btn btn-sm btn-outline-primary waves-effect waves-light category-edit"
                                                data-id="{{$term->terms_policie_id}}" title="Edit">
                                            <i class="mdi mdi-border-color"></i>
                                        </button>
                                        <a class="deletetag" data-id="{{$term->terms_policie_id}}">
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
    <div id="myModalSave" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Terms & Policies Add</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    {!!Form::open(['class' => 'form-horizontal','id'=>'catservestore'])!!}
                    @csrf
                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" id="title" name="title"
                                   placeholder="Title Here..."
                                   required>
                        </div>
                    </div>
                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-2 col-form-label">Sub-Title</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="subtitle"
                                   placeholder="Title Here..."
                                   required>
                        </div>
                    </div>

                    <div class="form-group row flex_Css">
                        <label for="description" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-md-10">
                            <textarea class="description_css form-control" name="description" id="description"
                                      placeholder="Description Here..." required></textarea>
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
                    <h5 class="modal-title mt-0" id="myModalLabel">Terms & Policies Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    {!!Form::open(['class' => 'form-horizontal','id'=>'tagsupdate'])!!}
                    @csrf
                    <div class="form-group row flex_Css">
                        <label for="name" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" id="title2" name="title"
                                   placeholder="Title Here..."
                                   required>

                        </div>
                    </div>
                    <input type="hidden" name="category_id" id="category-edit-id" class="form-control">
                    <div class="form-group row flex_Css">
                        <label for="name" class="col-sm-2 col-form-label">Sub-Title</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" id="subtitle" name="subtitle"
                                   placeholder="Title Here..."
                                   required>
                        </div>
                    </div>


                    <div class="form-group row flex_Css">
                        <label for="description" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-md-10">
                            <textarea class="description_css form-control" name="description" id="description2"
                                      placeholder="Description Here..." required>
                            </textarea>
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
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Terms & Policies Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body" style="background: #f5f5f5;">
                    <div class="Catname">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p><b>Title:</b></p>
                                </div>
                                <div class="col-sm-9">
                                    <div id="viewTitle"></div>
                                </div>
                            </div>
                        </div>
                    </div><br>
                    <div class="Catname">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p><b>Subtitle:</b></p>
                                </div>
                                <div class="col-sm-12">
                                    <div id="viewSub"></div>
                                </div>
                            </div>
                        </div>
                    </div><br>
                    <div class="Catname">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p><b>Description:</b></p>
                                </div>
                                <div class="col-sm-12">
                                    <div id="viewDesc"></div>
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
                    url: "{{url('terms')}}/" + id + '/edit',
                    method: "get",
                    data: {},
                    dataType: 'json',
                    success: function (response) {
                        let url = window.location.origin;
                        console.log('data', response);
                        $('#title2').val(response.data.title).focus;
                        $('#subtitle').val(response.data.subtitle);
                        $('#description2').val(response.data.description)
                        $('#category-edit-id').val(response.data.terms_policie_id);

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
                    url: "{{url('term-view')}}/" + id,
                    method: "get",
                    data: {},
                    dataType: 'json',
                    success: function (response) {
                        console.log('data', response);
                        $('#viewTitle').html(response.data.title);
                        $('#viewSub').html(response.data.subtitle);
                        $('#viewDesc').html(response.data.description);
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
                url: "{{route('terms.store')}}",
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
                            url: "{!! route('terms.destroy') !!}",
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
                url: "{{route('terms.updated')}}",
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
@endsection
