@extends('back-end.app')

@section('title','Post Page')

@push('css')
    <link href="{{ asset('back-end/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('back-end/plugins/animate-css/animate.css') }}" rel="stylesheet" />
 @endpush

@section('content')
    <section class="content">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <a type="button" href="{{  route('adminpost.create') }}" class="btn btn-danger"><i class="material-icons">add</i></a>
                <div class="card">
                    <div class="header">
                        <h2>
                            Tag Post Table
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
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Posted By</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th><i class="material-icons">visibility</i></th>
                                    <th>Approval</th>
                                    <th>Post</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Edit Action</th>
                                    <th>Delete Action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Posted By</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th><i class="material-icons">visibility</i></th>
                                    <th>Approval</th>
                                    <th>Post</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Edit Action</th>
                                    <th>Delete Action</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($posts as $row)
                                    <tr>
                                        <td>{{$row->title}}</td>
                                        <td>{{$row->slug}}</td>
                                        <td>{{ $row->user->name }}</td>
                                        <td><img src="{{ asset('storage/post/'.$row->image) }}" style="width:70px; height:80px;"></td>
                                        <td>
                                            @if($row->status ==false)
                                                <a type="button" class="btn btn-danger waves-effect">False</a>
                                            @elseif($row->status ==true)
                                                <a type="button" class="btn btn-success waves-effect">True</a>

                                            @endif
                                        </td>
                                        <td>{{ $row->view_count }}</td>
                                        <td>
                                            @if($row->is_approve ==true)
                                                <a type="button" class="btn btn-success waves-effect"><i class="material-icons">done</i></a>
                                            @elseif($row->is_approve ==false)
                                                <a type="button" class="btn btn-danger wave-effect"><i class="material-icons">remove</i></a>
                                            @endif
                                        </td>
                                        <td>{{ str_limit($row->body,10) }}</td>
                                        <td>{{$row->created_at->toFormattedDateString()}}</td>
                                        <td>{{ $row->updated_at->toFormattedDatestring() }}</td>
                                        <td><a type="button" name="edit" href="{{ route('adminpost.edit',$row->id) }}" class="btn btn-success waves-effect"><i class="material-icons">edit</i></a></td>
                                        <td><a type="button" name="delete" class="btn btn-danger waves-effect" onclick="
                                                if(confirm('Aure You Sre to delete Tag')){
                                                document.getElementById('delete-form-{{ $row->id }}').submit();
                                                }else{
                                                event.preventDefault();
                                                }
                                                "><i class="material-icons">delete</i></a>
                                            <form method="post" action="{{ route('adminpost.destroy',$row->id) }}" id="delete-form-{{ $row->id }}">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 @endsection

@push('js')
            <script src="{{ asset('back-end/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
            <script src="{{ asset('back-end/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
            <script src="{{ asset('back-end/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
            <script src="{{ asset('back-end/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
            <script src="{{ asset('back-end/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
            <script src="{{ asset('back-end/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
            <script src="{{ asset('back-end/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
            <script src="{{ asset('back-end/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
            <script src="{{ asset('back-end/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

            <!-- Custom Js -->
            <script src="{{ asset('back-end/js/admin.js') }}"></script>
            <script src="{{ asset('back-end/js/pages/tables/jquery-datatable.js') }}"></script>

            <!-- Demo Js -->
            <script src="{{ asset('back-end/js/demo.js') }}"></script>
@endpush
