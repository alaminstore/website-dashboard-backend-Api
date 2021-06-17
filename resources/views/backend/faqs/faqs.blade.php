@extends('backend.home')
@section('title','FAQS')
@section('content')

    <div class="row" id="okreload">
        {{-- <div class="col-md-2">
        </div> --}}
        <div class="col-md-12" id="reloadId">
            &nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-secondary waves-effect waves-light" title="Edit" data-toggle="modal"
                    data-target="#myModalSave">
                <i class="ion-plus"></i>Add New Faqs
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
                            <td>{!! \Illuminate\Support\Str::limit($faq->faq_answer, 50, $end='...') !!}</td>
                            <td>
                                <button type="button"
                                        class="btn btn-sm btn-outline-primary waves-effect waves-light category-edit"
                                        data-id="{{$faq->faq_id}}" title="Edit"
                                        data-toggle="modal" data-target="#myModal">
                                    <i class="mdi mdi-border-color"></i>
                                </button>
                                <a class="deletetag" data-id="{{$faq->faq_id}}">
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
                    <h5 class="modal-title mt-0" id="myModalLabel">Faqs Question & Answer Add</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    {!!Form::open(['class' => 'form-horizontal','id'=>'catservestore'])!!}
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Faqs Question</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" id="faq_question" name="faq_question"
                                   placeholder="Faq Question Here..."
                                   required>
                        </div>
                    </div>
                    <div class="form-group row flex_css">
                        <label for="description" class="col-sm-2 col-form-label">Faqs Answer</label>
                        <div class="col-md-10">
                            <textarea class="description_css form-control" name="faq_answer" id="faq_answer" required></textarea>
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
                    <h5 class="modal-title mt-0" id="myModalLabel">Faqs Question & Answer Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    {!!Form::open(['class' => 'form-horizontal','id'=>'tagsupdate'])!!}
                    @csrf
                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-2 col-form-label">Faq Question</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" id="faq_question" name="faq_question"
                                   placeholder="Faq Question Here..."
                                   required>
                            <input type="hidden"  name="category_id" id="category-edit-id" class="form-control" >
                        </div>
                    </div>
                    <div class="form-group row flex_css">
                        <label for="description" class="col-sm-2 col-form-label">Faqs Answer</label>
                        <div class="col-md-10">
                            <textarea class="description_css form-control" name="faq_answer" id="faq_answer" required></textarea>
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
                        $('#tagsupdate').find('#faq_question').val(data.faq_question);
                        $('#tagsupdate').find('#faq_answer').val(data.faq_answer);
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
                    }, 1000);
                    toastr.success('Data Updated Successfully');
                    $('#tagsupdate').trigger('reset');
                }

            });

        });
    </script>
@endsection
