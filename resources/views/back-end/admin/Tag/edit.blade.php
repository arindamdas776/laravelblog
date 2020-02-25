@extends('back-end.app')

@section('title','post Tag Edit page')

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
                        <form method="post" action="{{ route('admintag.update',$tags->id) }}">
                            @csrf
                            @method('put')
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="tag_name" name="tag_name" class="form-control" value="{{ $tags->name }}">
                                    <label class="form-label">Tag name</label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
                            <a type="button" href="{{ route('admintag.index') }}" class="btn btn-warning wave-effect m-t-15">BACK</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')

@endpush
