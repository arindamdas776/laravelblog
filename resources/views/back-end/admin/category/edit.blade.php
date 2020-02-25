@extends('back-end.app')

@section('title','Category Edit Page')

@push('css')

@endpush

@section('content')
    <section class="content">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Create New Post Tag
                            <small>With floating label</small>
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <form method="post" action="{{ route('admincategories.update',$categories->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="category_name" name="category_name" class="form-control"  value="{{ $categories->name }}">
                                    <label class="form-label">category name</label>
                                </div>
                            </div>

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="file" id="select_image" name="select_image" />
                                    <img src="{{ asset('storage/category/'.$categories->image) }}" style="width:80px;height:80px;">
                                    <input type="hidden" name="hidden_image" id="hidden_image" value="{{ $categories->image }}" />
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
                            <a type="button" href="{{ route('admincategories.index') }}" class="btn btn-warning wave-effect m-t-15">BACK</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
 @endsection

@push('js')

@endpush
