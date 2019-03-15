@extends ('backend.layouts.app')

@section ('title', app_name() . ' | ' . __('email::labels.backend.email.management'))

@section('breadcrumb-links')
    @include('email::includes.breadcrumb-links')
@endsection

@push('after-styles')
    {{ style("https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css") }}
@endpush

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('email::labels.backend.email.management') }} <small class="text-muted">{{ __('email::labels.backend.email.list') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('email::includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="email-table" class="table table-condensed table-hover">
                        <thead>
                        <tr>
                            <th>{{ __('email::labels.backend.email.table.id') }}</th>
                            <th>{{ __('email::labels.backend.email.table.type') }}</th>
                            <th>{{ __('email::labels.backend.email.table.name') }}</th>
                            <th>{{ __('email::labels.backend.email.table.content') }}</th>
                            <th>{{ __('email::labels.backend.email.table.last_updated') }}</th>
                            <th>{{ __('labels.general.actions') }}</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection

@push('after-scripts')
    {{ script("https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js") }}
    {{ script("js/plugin/datatables/dataTables-extend.js") }}

    <script>
        $(function() {
            $('#email-table').DataTable({
                serverSide: true,
                ajax: {
                    url: '{!! route("admin.email.get") !!}',
                    type: 'post',
                    error: function (xhr, err) {
                        if (err === 'parsererror')
                            location.reload();
                        else swal(xhr.responseJSON.message);
                    }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'type', name:'type'},
                    {data: 'name', name:'name'},
                    {data: 'content', name:'content'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'actions', name: 'actions', searchable: false, sortable: false}
                ],
                order: [[0, "asc"]],
                searchDelay: 500,
                fnDrawCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    load_plugins();
                }
            });
        });
    </script>
@endpush