@extends('back-end.app')

@section('title','post Edit Page')

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
@endpush

@section('content')
    <form method="post" action="{{ route('adminpost.update',$posts->id) }}" enctype="multipart/form-data">
        @csrf
        @method('put')
        <section class="content">
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Create New Post Details
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
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="post_title" name="post_title" class="form-control" value="{{ $posts->title }}">
                                    <label class="form-label">Post Title</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="file" id="select_image" name="select_image" value="{{ $posts->image }}" />

                                    <img src="{{ asset('storage/post/'.$posts->image) }}" style="width:100px; height:100px;">
                                    <input type="hidden" name="hidden_image" id="hidden_image"  value="{{ $posts->image }}"/>

                                </div>
                            </div>

                            <div class="form-group form-check">
                                <input type="checkbox" name="status" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Select Post Category And Tags
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

                            <div class="form-group ">

                                <select class="selectpicker" data-live-search="true" name="category">
                                    @foreach($posts->category as $row)
                                        <option {{ $posts->id == $row->id ? 'selected':'' }} value="{{ $row->id }}">{{$row->name}}</option>

                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group form">

                                <select class="selectpicker" data-live-search="true" name="tags">
                                    @foreach($posts->tag as $row)
                                        <option {{ $posts->id == $row->id ? 'selected':'' }} value="{{ $row->id }}" >{{ $row->name }}</option>
                                    @endforeach
                                </select>

                            </div>

                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
                            <a type="button" href="{{ route('adminpost.index') }}" class="btn btn-warning waves-effect m-t-15">BACK</a>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Create New Post Ctegories
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

                          <textarea  name="body">

                                            {!! $posts->body !!}
                          </textarea>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<script>
    $(function () {
        $('select').selectpicker();
    });
</script>


    <script>
        CKEDITOR.replace( 'body' );
    </script>
@endpush
