@extends('backend.home')
@section('title','Settings')
@section('content')

<div class="card m-b-20">
    <div class="card-body">
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-7" id="reloadId">

                <div class="wrapper-page">
            <div class="card">
                <div class="card-body">
                    <div class="">
                        <h5 class="modal-title mt-0" id="myModalLabel">For Changing Your Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                        {!!Form::open(['class' => 'form-horizontal','id'=>'oldPassForm'])!!}
                            @csrf
                            <div class="form-group">
                                <input type="password" class="form-control" name="oldpass" id="oldpass" placeholder="Enter Old password" required>
                            </div>
                            <button type="submit" class="btn btn-secondary waves-effect waves-light" title="Reset">
                                <i class="fa fa-key" aria-hidden="true"></i> Reset Here...
                        </button>
                        {!!Form::close()!!}

                    </div></div></div>
                    </div>
                </div>
            </div>
</div>

<!--modal content  Save-->
<div id="myModalSave" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
<div class="modal-dialog passModel">
   <div class="modal-content">
       <div class="modal-header">
           <h5 class="modal-title mt-0" id="myModalLabel">Password Change</h5>
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
       </div>
       <div class="modal-body">
        <div class="wrapper-page">
            <h3 class="text-center m-0">
                <a href="index.html" class="logo logo-admin">
                    <img src="{{asset('assets/images/users/avatar-1.jpg')}}" alt="user" height="50" class="rounded-circle border">
                </a>

            </h3>

            <div class="p-3">
                <h4 class="text-muted font-18 mb-3 text-center">Reset Password</h4>
                {!!Form::open(['class' => 'form-horizontal','id'=>'newPassForm'])!!}
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="OldPass">New Password</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="newPass" name="newPass" placeholder="New password..."required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="OldPass">Confirm Password</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" name="confirmPass" id="confirmPass" placeholder="Confirm password..." required>
                        </div>
                    </div>

                    <div class="form-group row m-t-20">
                        <div class="col-12 text-right">
                            <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Reset</button>
                        </div>
                    </div>

                    {!!Form::close()!!}
            </div>


        </div>
       </div>
   </div>
</div>
</div>

@endsection
@section('scripts')
<script src="assets/plugins/parsleyjs/parsley.min.js"></script>
<script>
    $(document).ready(function () {
        $('form').parsley();
        $(".clearData").on('click', function () {
            $('.dropify-preview').hide();
        });
    });
</script>
<script>
    $('#oldPassForm').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: "{{route('reset.check')}}",
            method: "POST",
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                console.log('data',data.success);
                toastr.options = {
                    "debug": false,
                    "positionClass": "toast-bottom-right",
                    "onclick": null,
                    "fadeIn": 300,
                    "fadeOut": 1000,
                    "timeOut": 5000,
                    "extendedTimeOut": 1000
                    // console.log();
                };
                if (data.success == true) {
                    $("#myModalSave").modal('show');
                    setTimeout(function () {
                        $('#oldPassForm').trigger('reset');
                        }, 500);
                }else{
                    toastr.error('Please enter the correct password!');
                }
            }
        });
    });

    $('#newPassForm').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: "{{route('newPass.change')}}",
            method: "POST",
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                console.log('data',data.success);
                toastr.options = {
                    "debug": false,
                    "positionClass": "toast-bottom-right",
                    "onclick": null,
                    "fadeIn": 300,
                    "fadeOut": 1000,
                    "timeOut": 5000,
                    "extendedTimeOut": 1000
                };

            if(data.status == 0){
                // toastr.error('Password must contain minimum 8 character!');
                $.each(data.error,function(key,value){
                toastr.error(value);
                })
            }else{
                if (data.success == true) {
                toastr.success('Password has been changed!');
                $('#newPassForm').trigger('reset');
                $("#myModalSave").modal('hide');
                }else{
                    toastr.error('Not match with confirmation password!');
                }
            }



            }
        });
    });
</script>
@endsection
