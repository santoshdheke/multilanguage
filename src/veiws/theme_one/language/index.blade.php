@extends($theme_path.'.layouts.master_layout')

@section('content')

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card customer-list">
                    <div class="card-header">
                        <div class="header-top">
                            <h5>{{ $title }} List</h5>
                            <div class="card-header-right">
                                <a href="{{ route($base_route.'backup') }}" title="" class="btn btn-primary">Publish</a>
                                <a href="{{ route($base_route.'create') }}" title="" class="btn btn-primary">Add
                                    {{ $title }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Key</th>
                                    <th>English</th>
                                    <th>Nepali</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <form action="">
                                    <tr>
                                        <td>
                                            <input class="form-control" type="text" name="key" value="{{ request('key') }}">
                                        </td>
                                        <td>
                                            <input class="form-control" type="text" name="english" value="{{ request('english') }}">
                                        </td>
                                        <td>

                                        </td>
                                        <td>
                                            <button style="margin-right: 2px;" type="submit" class="btn btn-xs btn-success" title="Filter" data-toggle="tooltip"><i class="fa fa-filter"></i></button>
                                            <a class="btn btn-xs btn-danger" href="{{ route($base_route.'index') }}" title="Reset" data-toggle="tooltip"><i class="fa fa-history"></i></a>
                                        </td>
                                    </tr>
                                </form>
                                @if(isset($data['rows']) && count($data['rows'])>0)
                                    @foreach($data['rows'] as $key => $r)
                                <tr>
                                    <td>{{ $r->key }}</td>
                                    <td>{{ config('language.en.'.$r->key) }}</td>
                                    <td>{{ config('language.np.'.$r->key) }}</td>
                                    <td>
                                        <div style="display: flex">
                                            <a style="margin-right: 2px;" class="btn btn-xs btn-success" href="{{ route($base_route.'edit',$r->id) }}" title="Edit" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                                            @include($theme_path.'.particle.delete_modal',['row' => $r])
                                        </div>
                                    </td>
                                </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">No Records Found</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                            {{ $data['rows']->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
