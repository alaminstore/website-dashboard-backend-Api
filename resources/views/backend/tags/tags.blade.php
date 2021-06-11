@extends('backend.home')
@section('title','Categories')
@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link href="assets/plugins/summernote/summernote.css" rel="stylesheet" />
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
        <div class="col-md-2">
        </div>
        <div class="col-md-7" id="reloadId">
            <button type="button" class="btn btn-info waves-effect waves-light" title="Edit" data-toggle="modal" data-target="#myModalSave">
                <i class="ion-plus"></i> Add New Tags
            </button>
            <div id="reload-category">
            <div class="list text-center">
                <h6 class="display-4" style="font-size: 20px;">Categories Information</h6>
            </div>
            <table id="myTable" class="table table-bordered dt-responsive nowrap"
                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                <tr class="text-center">
                    <th>#SL</th>
                    <th>Tags Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="tbodytags" id="loadnow">
                    @php
                        $i=0;
                    @endphp
                @foreach($tags  as $tag)
                    <tr class="text-center unqtags{{$tag->tag_id}}">
                        <td><b>{{$i+=1}}</b></td>
                        <td>{{$tag->tag}}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-primary waves-effect waves-light category-edit" data-id="{{$tag->tag_id}}" title="Edit" data-toggle="modal" data-target="#myModal">
                                <i class="mdi mdi-border-color"></i> Edit
                            </button>
                            <a class="deletetag" data-id="{{$tag->tag_id}}">
                                <button class="btn btn-outline-danger btn-sm category-delete" title="Delete"><i class="ti-trash"></i> Delete</button>
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
    <div id="myModalSave" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Modal Heading</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    {{-- <form action="{{ url('tags.store') }}" method="post" enctype="multipart/form-data"> --}}
                    {!!Form::open(['class' => 'form-horizontal','id'=>'tagstore'])!!}
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Tags</label>
                            <div class="col-sm-12">
                                <input class="form-control" type="text" id="name" name="tag" placeholder="Tag Name Here..." required>
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
                    {{-- </form> --}}
                </div>
            </div>
        </div>
    </div>


        <!--modal content Update -->
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="myModalLabel">Modal Heading</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        {{-- <form id="category-edit-form" action="{{ url('tags/updated') }}" method="post" enctype="multipart/form-data"> --}}
                            {!!Form::open(['class' => 'form-horizontal','id'=>'tagsupdate'])!!}
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Tags Name</label>
                                <div class="col-sm-12">
                                    <input class="form-control" type="text" id="category-edit-name" name="tag" placeholder="Tags Name Here..." required>
                                    <input type="hidden"  name="category_id" id="category-edit-id" class="form-control" >
                                </div>
                            </div>
                            <div class="form-group m-b-0">
                                <div>
                                    <button type="submit" class="btn btn-success waves-effect waves-light">
                                        Update
                                    </button>
                                    <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                            {!!Form::close()!!}
                            {{-- </form> --}}
                    </div>
                </div>
            </div>
        </div>

@endsection
@section('scripts')
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/parsleyjs/parsley.min.js"></script>

    <script>
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
        $(document).ready(function () {
            $('#reload-category').on('click', '.category-edit' , function () {
                let id =  $(this).attr('data-id');

                $.ajax({
                    url:"{{url('tags')}}/"+id+'/edit',
                    method:"get",
                    data:{},
                    dataType: 'json',
                    success:function(data){
                      let url = window.location.origin;
                        console.log('data',data);
                        $('#tagsupdate').find('#category-edit-name').val(data.tag).focus();
                        $('#tagsupdate').find('#category-edit-id').val(data.tag_id);


                        if(data.image)
                          {
                              $('#category-edit-form').find('#category-edit-image').html(`<img width="100%" height="200px"  src="${url}/${data.image}"/>`);
                          }

                        $('#category-modal').modal('show');
                    },
                    error: function (error) {
                        if(error.status == 404){
                            toastr.error('Not found!');
                        }
                    }
                });
            });

        });

    </script>

    <script>

        //save data
        $('#tagstore').on('submit', function (e) {
         e.preventDefault();
            $.ajax({
                url: "{{route('tags.store')}}",
                method: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    console.log(data);
                    toastr.options = {
                        "debug": false,
                        "positionClass": "toast-bottom-right",
                        "onclick": null,
                        "fadeIn": 300,
                        "fadeOut": 1000,
                        "timeOut": 5000,
                        "extendedTimeOut": 1000
                    };

                    // setTimeout(function () {
                    //     $('#myModalSave'). modal('hide');
                    // }, 1000);
                    setTimeout(function () {
                        $('#myModalSave'). modal('hide');
                        // $("#reloadId").load();
                        // $("#loadnow").load(location.href + " #loadnow");
                        $("#loadnow").load(location.href+" #loadnow>*","");
                    }, 1000);
                    toastr.success('Data Inserted Successfully');
                    // $('.tbodytags').prepend(`<tr class='unqtags` + data.tag_id + `'>
                    //         <td class="text-center"><b>` + parseInt(data.tag_id++) + `</b></td>
                    //         <td class="text-center">{{$tag->tag}}</td>

                    //         <td class="text-center">
                    //         <button type="button" class="btn btn-sm btn-outline-primary waves-effect waves-light category-edit" data-id="` + data.id + `" title="Edit" data-toggle="modal" data-target="#myModal">
                    //             <i class="mdi mdi-border-color"></i> Edit
                    //         </button>
                    //         <a class="deletetag" data-id="` + data.id + `">
                    //             <button class="btn btn-outline-danger btn-sm category-delete" title="Delete"><i class="ti-trash"></i> Delete</button>
                    //         </a>

                    //     </td>
                    //         </tr>`);
                    $('#tagstore').trigger('reset');
                }

            });

        });

       //Delete data
        $(document).on('click','.deletetag',function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                console.log('id: ',id);
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
                    url: "{!! route('tags.destroy') !!}",
                    type: "get",
                    data: {
                        id: id,
                    },
                    success: function(data) {
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
                url: "{{route('tags.updated')}}",
                method: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    console.log(data);
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
                        $('#myModal'). modal('hide');
                        // $("#reloadId").load();
                        // $("#loadnow").load(location.href + " #loadnow");
                        $("#loadnow").load(location.href+" #loadnow>*","");
                    }, 1000);
                    toastr.success('Data Updated Successfully');


                    // setTimeout(function () {
                    //     // location.reload();
                    //     $("#myTable").load();
                    // }, 00);

                //     $("#getCameraSerialNumbers").click(function () {

                // });
                    // $('.tbodytags').prepend(`<tr class=' blue unqtags` + data.tag_id + `'>
                    //         <td class="text-center"><b>` + parseInt(data.tag_id) + `</b></td>
                    //         <td class="text-center">{{$tag->tag}}</td>

                    //         <td class="text-center">
                    //         <button type="button" class="btn btn-sm btn-outline-primary waves-effect waves-light category-edit" data-id="` + data.id + `" title="Edit" data-toggle="modal" data-target="#myModal">
                    //             <i class="mdi mdi-border-color"></i> Edit
                    //         </button>
                    //         <a class="deletetag" data-id="` + data.id + `">
                    //             <button class="btn btn-outline-danger btn-sm category-delete" title="Delete"><i class="ti-trash"></i> Delete</button>
                    //         </a>

                    //     </td>
                    //         </tr>`);

                    $('#tagsupdate').trigger('reset');
                }

            });

        });
    </script>
@endsection