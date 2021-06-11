@extends('backend.home')
@section('title','Categories')
@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link href="assets/plugins/summernote/summernote.css" rel="stylesheet"/>
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
        <div class="col-md-2">
        </div>
        <div class="col-md-7" id="reloadId">
            <button type="button" class="btn btn-info waves-effect waves-light" title="Edit" data-toggle="modal"
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
                        <th>Faqs Question</th>
                        <th>Faqs Answer</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody class="tbodytags" id="loadnow">
                    @php
                        $i=0;
                    @endphp
                    @foreach($faqs  as $faq)
                        <tr class="text-center unqtags{{$faq->faq_id}}">
                            <td><b>{{$i+=1}}</b></td>
                            <td>{{$faq->faq_question}}</td>
                            <td>{{$faq->faq_answer}}</td>
                            <td>
                                <button type="button"
                                        class="btn btn-sm btn-outline-primary waves-effect waves-light category-edit"
                                        data-id="{{$faq->faq_id}}" title="Edit"
                                        data-toggle="modal" data-target="#myModal">
                                    <i class="mdi mdi-border-color"></i> Edit
                                </button>
                                <a class="deletetag" data-id="{{$faq->faq_id}}">
                                    <button class="btn btn-outline-danger btn-sm category-delete" title="Delete"><i
                                            class="ti-trash"></i> Delete
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
                    <h5 class="modal-title mt-0" id="myModalLabel">Count Add</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    {!!Form::open(['class' => 'form-horizontal','id'=>'catservestore'])!!}
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-6 col-form-label">Faq Question</label>
                        <div class="col-sm-12">
                            <input class="form-control" type="text" id="faq_question" name="faq_question"
                                   placeholder="Faq Question Here..."
                                   required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-6 col-form-label">Faq Answer</label>
                        <div class="col-sm-12">
                            <input class="form-control" type="text" id="faq_answer" name="faq_answer"
                                   placeholder="Faq Answer Here..."
                                   required>
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
                    <h5 class="modal-title mt-0" id="myModalLabel">Count Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    {!!Form::open(['class' => 'form-horizontal','id'=>'tagsupdate'])!!}
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-6 col-form-label">Faq Question</label>
                        <div class="col-sm-12">
                            <input class="form-control" type="text" id="faq_question" name="faq_question"
                                   placeholder="Faq Question Here..."
                                   required>
                            <input type="hidden"  name="category_id" id="category-edit-id" class="form-control" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-6 col-form-label">Faq Answer</label>
                        <div class="col-sm-12">
                            <input class="form-control" type="text" id="faq_answer" name="faq_answer"
                                   placeholder="Faq Answer Here..."
                                   required>
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
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
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
                    url: "{{url('faqs')}}/" + id + '/edit',
                    method: "get",
                    data: {},
                    dataType: 'json',
                    success: function (data) {
                        let url = window.location.origin;
                        console.log('data', data);
                        $('#tagsupdate').find('#faq_question').val(data.faq_question).focus();
                        $('#tagsupdate').find('#faq_answer').val(data.faq_answer).focus();
                        $('#tagsupdate').find('#category-edit-id').val(data.faq_id);
                        var positiondata = $('#tagsupdate').find('#position2').val(data.position);

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
                    setTimeout(function () {
                        $('#myModalSave').modal('hide');
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
                            url: "{!! route('faqs.destroy') !!}",
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
