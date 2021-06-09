@extends('backend.home')
@section('title','Categories')
@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link href="assets/plugins/summernote/summernote.css" rel="stylesheet" />
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
            height: 50px;
            width: 353px!important;
            padding: 10px;
            opacity: .6;
            border-radius: 7px;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <div id="">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Portfolio Categories</h4>
                    <br>
                    <form action="{{ url('portfolio-position/store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        {{-- {!! Form::number('style', null, ['class' => 'form-control', 'id' => 'style', 'placeholder' => 'Write Zalo Po here']) !!} --}}
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Portfolio Category Name</label>
                            <div class="col-sm-10">
                                <select style="width: 200px" id="nameid" name="nameid">
                                    <option></option>
                                    @foreach($portfolio_cat as $cat)
                                      <option value="{{$cat->portfolio_category_id}}">{{$cat->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Portfolio Item</label>
                            <div class="col-sm-10">
                                <select style="width: 200px" id="itemid" name="itemid">
                                    <option></option>
                                    @foreach($portfolio_item as $item)
                                      <option value="{{$item->portfolio_item_id}}">{{$item->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="portfolio_cat_icon" class="col-sm-2 col-form-label">Position</label>
                            <div class="col-sm-10">
                                <select style="width: 200px" id="position" name="position">
                                    <option></option>
                                      <option value="1">Position 1</option>
                                      <option value="2">Position 2</option>
                                      <option value="3">Position 3</option>
                                  </select>
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
        <h6 class="display-4">Portfolio Position List</h6>
    </div>
    <div id="reload-category">
    <div class="row">

        <div class="col-md-12">
            <table id="myTable" class="table table-bordered dt-responsive nowrap"
                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                <tr class="text-center">
                    <th>#SL</th>
                    <th>Portfolio Category Name</th>
                    <th>Portfolio Item</th>
                    <th>Position</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @php
                        $i=0;
                    @endphp
                @foreach($portfolio_position as $position)
                    <tr class="text-center">
                        <td><b>{{$i+=1}}</b></td>
                        <td>{{$position->getPortfolioCategory->name}}</td>
                        <td>{{$position->getPortfolioItem->title}}</td>
                        <td>
                            @if ($position->position == 1)
                            Position 1
                            @elseif ($position->position == 2)
                            Position 2
                            @else
                            Position 3
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-primary waves-effect waves-light category-edit" data-id="{{$position->portfolio_position_id}}" title="Edit" data-toggle="modal" data-target=".bs-example-modal-lg">
                                <i class="mdi mdi-border-color"></i> Edit
                            </button>
                           <button class="btn btn-outline-danger btn-sm category-delete"  title="Delete" onclick="deleteData({{$position->portfolio_position_id}})"><i class="ti-trash"></i> Delete</button>
                           <form id="delete-form-{{$position->portfolio_position_id}}" method="post" action="{{route('portfolioposition.destroy', $position->portfolio_position_id)}}" style="display: none">
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
        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="myModalLabel">Portfolio Position Modal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">

                        <form  id="category-edit-form" action="{{ url('portfolio-position/updated') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Portfolio Category Name</label>
                            <div class="col-sm-10">
                                <select class="select_css" id="nameid2" name="nameid">
                                    <option></option>
                                    @foreach($portfolio_cat as $cat)
                                      <option value="{{$cat->portfolio_category_id}}">{{$cat->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden"  name="category_id" id="category-edit-id" class="form-control" >
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Portfolio Item</label>
                            <div class="col-sm-10">
                                <select class="select_css" id="itemid2" name="itemid">
                                    <option></option>
                                    @foreach($portfolio_item as $item)
                                      <option value="{{$item->portfolio_item_id}}">{{$item->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="portfolio_cat_icon" class="col-sm-2 col-form-label">Position</label>
                            <div class="col-sm-10">
                                <select class="select_css" id="position2" name="position">
                                    <option></option>
                                      <option value="1">Position 1</option>
                                      <option value="2">Position 2</option>
                                      <option value="3">Position 3</option>
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

                    </form>
                    </div>
                </div>
            </div>
        </div>

@endsection
@section('scripts')
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/parsleyjs/parsley.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
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
                console.log(id);

                $.ajax({
                    url:"{{url('portfolio-position')}}/"+id+'/edit',
                    method:"get",
                    data:{},
                    dataType: 'json',
                    success:function(data){
                      let url = window.location.origin;
                        console.log('data',data);
                        var cat =$('#category-edit-form').find('#nameid2').val(data.portfolio_category_id).focus();
                        var item = $('#category-edit-form').find('#itemid2').val(data.portfolio_item_id);
                        $('#category-edit-form').find('#category-edit-id').val(data.portfolio_position_id);
                        var position =$('#category-edit-form').find('#position2').val(data.position);

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
    <script type="text/javascript">
        $("#nameid").select2({
              placeholder: "Select the Position",
            //   allowClear: true
          });
          $("#itemid").select2({
              placeholder: "Select the Item",
            //   allowClear: true
          });
          $("#position").select2({
              placeholder: "Select the Position",
            //   allowClear: true
          });

          $("#nameid2").select2({
              placeholder:,
              //   allowClear: true
           });
          $("#itemid2").select2({
              placeholder: demo,
            //   allowClear: true
          });
          $("#position2").select2({
              placeholder: position,
            //   allowClear: true
          });
  </script>
@endsection
