@extends('backend.home')
@section('title','FAQS')
@section('content')
    <div class="card m-b-20">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12" id="reloadId">
                    &nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-secondary waves-effect waves-light"
                                                    title="Edit" data-toggle="modal"
                                                    data-target="#myModalSave">
                        <i class="ion-plus"></i> Add New Faqs
                    </button>
                    <div id="reload-category">
                        <div class="list text-center">
                            <h6 class="display-4" style="font-size: 20px;">FAQ List</h6>
                        </div>
                        <table id="myTable" class="table table-bordered dt-responsive nowrap"
                               style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr class="text-center">
                                <th>Question</th>
                                <th>Answer</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="loadnow">

                            @foreach($faqs  as $faq)
                                <tr class="text-center">

                                    <td>{!! \Illuminate\Support\Str::limit($faq->faq_question, 40, $end='...') !!}</td>
                                    <td>{!! \Illuminate\Support\Str::limit($faq->faq_answer, 60, $end='...') !!}</td>
                                    <td>
                                        <button type="button"
                                                class="btn btn-sm btn-outline-info waves-effect waves-light viewData"
                                                data-id="{{$faq->faq_id}}">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                        <button type="button"
                                                class="btn btn-sm btn-outline-primary waves-effect waves-light category-edit"
                                                data-id="{{$faq->faq_id}}" title="Edit">
                                            <i class="mdi mdi-border-color"></i>
                                        </button>
                                        <a class="deletetag" data-id="{{$faq->faq_id}}">
                                            <button class="btn btn-outline-danger btn-sm category-delete"
                                                    title="Delete"><i class="ti-trash"></i></button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody></table>
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
                    <h5 class="modal-title mt-0" id="myModalLabel"> Add new Question & Answer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
                </div>
                <div class="modal-body">
                    {!!Form::open(['class' => 'form-horizontal','id'=>'catservestore'])!!}
                    @csrf
                    <div class="form-group row">
                        <label for="name" style="padding-right: 0;" class="col-sm-2 col-form-label">Question</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="faq_question"
                                   placeholder="Question Here..."
                                   required>
                        </div>
                    </div>
                    <div class="form-group row flex_css">
                        <label for="description" style="padding-right: 0;" class="col-sm-2 col-form-label">Answer</label>
                        <div class="col-md-10">
                            <textarea class="description_css form-control" name="faq_answer" placeholder="Answer here..." required></textarea>
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
                    <h5 class="modal-title mt-0" id="myModalLabel">Update the Question & Answer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
                </div>
                <div class="modal-body">
                    {!!Form::open(['class' => 'form-horizontal','id'=>'tagsupdate'])!!}
                    @csrf
                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-2 col-form-label" style="padding-right: 0;">Question</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" id="faq_question" name="faq_question"
                                   placeholder="Question Here..."
                                   required>
                            <input type="hidden" name="category_id" id="category-edit-id" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row flex_css">
                        <label for="description" class="col-sm-2 col-form-label" style="padding-right: 0;">Answer</label>
                        <div class="col-md-10">
                            <textarea class="description_css form-control" name="faq_answer" id="faq_answer" placeholder="Answer here..."
                                      required></textarea>
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
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Faq Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
                </div>
                <div class="modal-body" style="background: #f5f5f5;">
                        <div class="Catname">
                            <p class="p-0"><b>Question:</b></p>
                            <div id="viewQues"></div>
                            <br>
                        </div>
                        <div class="Catname p-0">
                            <p class="p-0"><b>Answer:</b></p>
                            <div id="viewAns"></div>
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
    <script>
        $('.dropify').dropify();
    </script>
    <script>
        $("#catservestore").validate({
        rules: {
            faq_question: {
                required:true,
                maxlength: 200,
            },
            faq_answer: {
                required:true,
            },
        }
       });
        $("#tagsupdate").validate({
        rules: {
            faq_question: {
                required:true,
                maxlength: 200,
            },
            faq_answer: {
                required:true,
            },
        }
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
                    url: "{{url('faqs')}}/" + id + '/edit',
                    method: "get",
                    data: {},
                    dataType: 'json',
                    success: function (response) {
                        let url = window.location.origin;
                        console.log('data', response);
                        $('#faq_question').val(response.data.faq_question);
                        $('#faq_answer').val(response.data.faq_answer);
                        $('#category-edit-id').val(response.data.faq_id);
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
                    url: "{{url('faq-view')}}/" + id,
                    method: "get",
                    data: {},
                    dataType: 'json',
                    success: function (response) {
                        console.log('data', response);
                        $('#viewQues').html(response.data.faq_question);
                        $('#viewAns').html(response.data.faq_answer);
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
            var $form = $(this);
            if(! $form.valid()) return false;
            $.ajax({
                url: "{{route('faqs.store')}}",
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
                            url: "{!! route('faqs.destroy') !!}",
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
            var $form = $(this);
            if(! $form.valid()) return false;
            $.ajax({
                url: "{{route('faqs.updated')}}",
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
