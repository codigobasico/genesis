@extends('layouts.admin')

@section('title', trans_choice('general.items', 2))

@section('new_button')
@permission('create-common-items')

<span class="new-button"><a href="{{ route('unidades.create') }}" class="btn btn-success btn-sm"><span class="fa fa-plus"></span> &nbsp;{{ trans('general.add_new') }}</a></span>
<span><a href="{{ route('import.create', ['common', 'unidades']) }}" class="btn btn-default btn-sm"><span class="fa fa-download"></span> &nbsp;{{ trans('import.import') }}</a></span>
@endpermission
<span><a href="{{ route('unidades.export', request()->input()) }}" class="btn btn-default btn-sm"><span class="fa fa-upload"></span> &nbsp;{{ trans('general.export') }}</a></span>
@endsection

@section('content')
<!-- Default box -->
<div class="box box-success">
    <div class="box-header with-border">
        {!! Form::open(['route' => 'unidades.index', 'role' => 'form', 'method' => 'GET']) !!}
        <div id="items" class="pull-left box-filter">
            <span class="title-filter hidden-xs">{{ trans('general.search') }}:</span>
            {!! Form::text('search', request('search'), ['class' => 'form-control input-filter input-sm', 'placeholder' => trans('general.search_placeholder')]) !!}
            {!! Form::select('dimensiones[]', $dimensiones, request('dimensiones'), ['id' => 'filter-categories', 'class' => 'form-control input-filter input-lg', 'multiple' => 'multiple']) !!}
            {!! Form::button('<span class="fa fa-filter"></span> &nbsp;' . trans('general.filter'), ['type' => 'submit', 'class' => 'btn btn-sm btn-default btn-filter']) !!}
        </div>
        <div class="pull-right">
            <span class="title-filter hidden-xs">{{ trans('general.show') }}:</span>
            {!! Form::select('limit', $limits, request('limit', setting('general.list_limit', '25')), ['class' => 'form-control input-filter input-sm', 'onchange' => 'this.form.submit()']) !!}
        </div>
        {!! Form::close() !!}
    </div>
    <!-- /.box-header -->

    <div class="box-body">
        <div class="table table-responsive">
            <table class="table table-striped table-hover" id="tbl-items">
                <thead>
                    <tr>
                        <th class="col-md-3">@sortablelink('codum', trans('general.name'))</th>
                        <th class="col-md-1 hidden-xs">@sortablelink('unidad', trans_choice('general.units', 1))</th>
                        <th class="col-md-1 hidden-xs">@sortablelink('dimension', trans_choice('units.dimension', 1))</th>
                        <th class="col-md-1 text-center">{{ trans('general.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($unidades as $unidad)
                    <tr>
                         <td><a href="{{ route('unidades.edit', $unidad->codum) }}">{{ $unidad->codum }}</a></td>
                        <td class="hidden-xs">{{ $unidad->unidad }}</td>
                        <td class="hidden-xs">{{ $unidad->dimension }}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" data-toggle-position="left" aria-expanded="false">
                                    <i class="fa fa-ellipsis-h"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{ route('unidades.edit', $unidad->codum) }}">{{ trans('general.edit') }}</a></li>
                                 
                                    @permission('delete-common-items')
                                    <li class="divider"></li>
                                    <li>{!! Form::deleteLink($unidad, 'common/unidades') !!}</li>
                                    @endpermission
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
        @include('partials.admin.pagination', ['items' => $unidades, 'type' => 'unidades'])
    </div>
    <!-- /.box-footer -->
</div>
<!-- /.box -->
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $("#filter-categories").select2({
            placeholder: "{{ trans('general.form.select.field', ['field' => trans_choice('general.categories', 1)]) }}"
        });
    });
</script>
@endpush
