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
    <div class="row">
        <div class="col-md-12">
            <div id="">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Portfolio Categories</h4>
                    <br>
                    <form action="{{ url('portfolio-categories/store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-12">
                                <input class="form-control" type="text" id="name" name="name" placeholder="Portfolio Category Name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-sm-4 col-form-label">Description</label>
                            {{-- <textarea id="elmxx" name="description"></textarea> --}}
                            {{-- <div class="summernote">Hello Summernote</div> --}}
                            <textarea class="summernote" name="description" id="faq-question-answer">
                                {{old('description')}}
                            </textarea>
                        </div>
                        <div class="form-group row">
                            <label for="portfolio_cat_icon" class="col-sm-2 col-form-label">Icon</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="image" id="portfolio_cat_icon" required>
                            </div>
                        </div>
                        <div class="form-group m-b-0">
                            <div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    Save
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
    </div>
    <div class="list text-center">
        <h6 class="display-4">Categories List</h6>
    </div>
    <div id="reload-category">
    <div class="row">

        <div class="col-md-12">
            <table id="myTable" class="table table-bordered dt-responsive nowrap"
                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                <tr class="text-center">
                    <th>Name</th>
                    <th>Icon</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($portfolio_cat as $cat)
                    <tr class="text-center">

                        <td>{{$cat->name}}</td>
                        <td class="cat_img"><img src="{{$cat->icon}}" class="img-fluid" alt="portfolio Category Image">
                        </td>
                        <td>{!! \Illuminate\Support\Str::limit($cat->description, 80, $end='...') !!}</td>

                        <td>
                            <button type="button" class="btn btn-sm btn-outline-primary waves-effect waves-light category-edit" data-id="{{$cat->portfolio_category_id}}" title="Edit" data-toggle="modal" data-target="#myModal">
                                <i class="mdi mdi-border-color"></i> Edit
                            </button>
                           <button class="btn btn-outline-danger btn-sm category-delete"  title="Delete" onclick="deleteData({{$cat->portfolio_category_id}})"><i class="ti-trash"></i> Delete</button>
                           <form id="delete-form-{{$cat->portfolio_category_id}}" method="post" action="{{route('portfoliocat.destroy', $cat->portfolio_category_id)}}" style="display: none">
                               @csrf
                               @method('DELETE')
                           </form>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>

        <!--modal content -->
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="myModalLabel">Modal Heading</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <form id="category-edit-form" action="{{ route('portfoliocat.updated') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-12">
                                    <input class="form-control" type="text" id="category-edit-name" name="name" placeholder="Portfolio Category Name" required>
                                    <input type="hidden"  name="category_id" id="category-edit-id" class="form-control" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-4 col-form-label">Description</label>
                                <textarea class="summernote" name="description" id="description-edit">
                                    {{old('description')}}
                                </textarea>
                            </div>
                            <div class="form-group row">
                                <label for="portfolio_cat_icon" class="col-sm-2 col-form-label">Icon</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="image" id="portfolio_cat_icon">
                                </div>
                            </div>
                            <div class="form-group" id="category-edit-image">

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

                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

@endsection
@section('scripts')
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/parsleyjs/parsley.min.js"></script>
    <script src="assets/plugins/summernote/summernote.min.js"></script>
    <script>
        jQuery(document).ready(function(){
            $('.summernote').summernote({
                height: 300,
                minHeight: null,
                maxHeight: null,
                focus: true
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });

    </script>
    <script>
        $(document).ready(function () {
            $('form').parsley();
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#reload-category').on('click', '.category-edit' , function () {
                let id =  $(this).attr('data-id');

                $.ajax({
                    url:"{{url('portfolio-categories')}}/"+id+'/edit',
                    method:"get",
                    data:{},
                    dataType: 'json',
                    success:function(data){
                      let url = window.location.origin;
                        console.log('data',data);
                        $('#category-edit-form').find('#category-edit-name').val(data.name).focus();
                        $('#category-edit-form').find('#category-edit-id').val(data.portfolio_category_id);
                        $('#category-edit-form').find('#description-edit').summernote('code', data.description);
                        if(data.icon)
                          {
                              $('#category-edit-form').find('#category-edit-image').html(`<img width="100%" height="200px"  src="${url}/${data.icon}"/>`);
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
@endsection
