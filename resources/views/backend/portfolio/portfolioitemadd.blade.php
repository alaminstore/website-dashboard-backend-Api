@extends('backend.home')
@section('title','Categories')
@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
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
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="modal-body">
                <form action="{{route('portfolio.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-sm-6 col-form-label">Title</label>
                    <div class="col-sm-12">
                        <input class="form-control" type="text" id="title" name="title"
                               placeholder="Title Here..."
                               required>
                    </div>
                    <div class="form-group row">
                        <input class="form-control" type="hidden"  name="portfolio_category_id"  value="{{$data}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="image" class="col-sm-6 col-form-label">Image</label>
                    <div class="col-sm-12">
                        <input type="file" name="image" id="image" class="dropify" required/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-6 col-form-label">Url</label>
                    <div class="col-sm-12">
                        <input class="form-control" type="text" id="url" name="url"
                               placeholder="Url Here..."
                               required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="portfolio_cat_icon" class="col-sm-6 col-form-label">Client</label>
                    <div class="col-sm-12">
                        <select style="width: 200px" id="client_id" name="client_id">
                            <option></option>
                            @foreach ($clients as $client)
                            <option value="{{$client->client_id}}">{{$client->name}}</option>
                            @endforeach
                        </select>
                        <div id="feedback"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="portfolio_cat_icon" class="col-sm-6 col-form-label">Position</label>
                    <div class="col-sm-12">
                        <select style="width: 200px" id="position" name="position">
                            <option></option>
                            @for($i=1;$i<=9;$i++)

                                @if(\App\Models\PortfolioPosition::where('portfolio_category_id','=',$data)
                                                                   ->where('position','=',$i)
                                                                   ->exists())
                                   <option disabled value="{{$i}}">Position {{$i}} <span style="color:red!important;">(not avilable)</span></option>

                                   @else
                                   <option value="{{$i}}">Position {{$i}}</option>
                                @endif
                            @endfor
                        </select>
                        <div id="feedback3"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="portfolio_cat_icon" class="col-sm-6 col-form-label">Tags</label>
                    <div class="col-sm-12">
                        <select style="width: 200px" class="tag_id" id="tag_id" name="tag_id[]" multiple="multiple">
                            <option></option>
                            @foreach ($tags as $tag)
                            <option value="{{$tag->tag}}">{{$tag->tag}}</option>
                            @endforeach
                        </select>
                        <div id="feedback2"></div>
                    </div>
                </div>

                <div class="form-group m-b-0">
                    <div>
                        <button type="submit" id="submit" class="btn btn-primary waves-effect waves-light">
                            Submit Here
                        </button>
                        <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                            Cancel
                        </button>
                    </div>
                </div>
            </form>
            </div>
        </div>

    </div>
    </div>




    <!--modal content Update -->


@endsection
@section('scripts')
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/parsleyjs/parsley.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
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
        $("#client_id").select2({
            placeholder: "Select the Client"
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
                        var catdata = $('#tagsupdate').find('#cat2').val(data.category_related_service_id);
                        $('#tagsupdate').find('#category-edit-name').val(data.name).focus();
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

        // //save data


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
                            success: function (data) {
                            }
                        });

                        $(this).closest('tr').hide();

                    }
                }
            )
        });


        //Update data
        // $('#tagsupdate').on('submit', function (e) {
        //     e.preventDefault();
        //     $.ajax({
        //         url: "{{route('portfolio.updated')}}",
        //         method: "POST",
        //         data: new FormData(this),
        //         dataType: 'JSON',
        //         contentType: false,
        //         cache: false,
        //         processData: false,
        //         success: function (data) {
        //             console.log('update', data);
        //             toastr.options = {
        //                 "debug": false,
        //                 "positionClass": "toast-bottom-right",
        //                 "onclick": null,
        //                 "fadeIn": 300,
        //                 "fadeOut": 1000,
        //                 "timeOut": 5000,
        //                 "extendedTimeOut": 1000
        //             };

        //             setTimeout(function () {
        //                 $('#myModal').modal('hide');
        //                 $("#loadnow").load(location.href + " #loadnow>*", "");
        //             }, 1000);
        //             toastr.success('Data Updated Successfully');
        //             $('#tagsupdate').trigger('reset');
        //         }
        //     });
        // });

        $("#submit").click(function(){
            var client_id = $("#client_id");
            var tag_id = $("#tag_id");
            var position = $("#position");
            if(client_id.val() ===""){
                document.getElementById("feedback").innerHTML="Client Vlue is required";
                document.getElementById("feedback").style.color="red";
            }
            if(tag_id.val() ===""){
                document.getElementById("feedback2").innerHTML="Tags Vlue is required";
                document.getElementById("feedback2").style.color="red";
            }
            if(position.val() ===""){
                document.getElementById("feedback3").innerHTML="Position Vlue is required";
                document.getElementById("feedback3").style.color="red";
            }
        })
    </script>
@endsection
