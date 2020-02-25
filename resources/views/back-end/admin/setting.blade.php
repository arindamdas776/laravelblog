@extends('back-end.app')

@section('title','Admin Profile')

@push('css')

@endpush

@section('content')
    <section class="content">
        <div class="row clearfix">
            <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
                <b>Panel Primary</b>
                <div class="panel-group" id="accordion_1" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-primary">
                        <div class="panel-heading" role="tab" id="headingOne_1">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseOne_1" aria-expanded="true" aria-controls="collapseOne_1">
                                    Admin Profile Update
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne_1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_1">
                            <div class="panel-body">
                                <form method="post" action="{{ route('adminprofile.update',Auth::id()) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Enter email" value="{{ Auth::user()->email }}">
                                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                            </div>

                                        </div>
                                        <div class="col-md-3">
                                            <img src="{{ asset('storage/profile/'.Auth::user()->image) }}" class="img-thumbnail" style="with:300px; height:300px;">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Select Image</label>
                                        <input type="file" class="form-control" name="select_image" id="exampleInputPassword1" placeholder="Password" value="Auth::user()->image">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading" role="tab" id="headingTwo_1">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseTwo_1" aria-expanded="false"
                                   aria-controls="collapseTwo_1">
                                    Change Pasasword
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo_1">
                            <div class="panel-body">
                                <form method="POST" action="{{ route('adminpassword.update',Auth::id()) }}">
                                    @csrf
                                    @method('put')
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Old Password</label>
                                        <input type="password" class="form-control" name="old_password" id="exampleInputPassword1" placeholder="Password">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1"> New Password</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1" name="new_password" placeholder="Password">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Confirm Password</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1" name="confirm_password" placeholder="Password">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')

@endpush
