@extends('back-end.app')

@section('title','category Page')

@push('css')
    <link href="{{ asset('back-end/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
@endpush

@section('content')
    <section class="content">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <a type="button" href="{{  route('admincategories.create') }}" class="btn btn-danger"><i class="material-icons">add</i></a>
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
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Image</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Edit Action</th>
                                    <th>Delete Action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Image</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Edit Action</th>
                                    <th>Delete Action</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($categories as $row)
                                    <tr>
                                        <td>{{$row->name}}</td>
                                        <td>{{$row->slug}}</td>
                                        <td><img src="{{ asset('storage/category/'.$row->image) }}" style="width:70px; height:80px;"></td>
                                        <td>{{$row->created_at->toFormattedDateString()}}</td>
                                        <td>{{ $row->updated_at->toFormattedDatestring() }}</td>
                                        <td><a type="button" name="edit" href="{{ route('admincategories.edit',$row->id) }}" class="btn btn-success waves-effect"><i class="material-icons">edit</i></a></td>
                                        <td><a type="button" name="delete" class="btn btn-danger waves-effect" onclick="
                                                if(confirm('Aure You Sre to delete Category')){
                                                document.getElementById('delete-form-{{ $row->id }}').submit();
                                                }else{
                                                event.preventDefault();
                                                }
                                                "><i class="material-icons">delete</i></a>
                                            <form method="post" action="{{ route('admincategories.destroy',$row->id) }}" id="delete-form-{{ $row->id }}">
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
    </section>
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
