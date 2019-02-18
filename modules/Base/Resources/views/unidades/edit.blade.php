@extends('layouts.admin')

@section('title', trans('general.title.edit', ['type' => trans_choice('general.units', 1)]))

@section('content')
<!-- Default box -->
<div class="box box-success">
    {!! Form::model($ums, [
        'method' => 'PATCH',
        'route' => ['unidades.update', $ums->codum],
        'role' => 'form',
        'class' => 'form-loading-button'
    ]) !!}

    <div class="box-body">
        {{ Form::textGroup('codum', trans('general.code'), 'id-card-o') }}        

        {{ Form::textGroup('unidad', trans('general.description')) }}

        {{ Form::textGroup('dimension', trans('units.dimension'), 'money') }}

    </div>
    <!-- /.box-body -->

    @permission('update-common-items')
    <div class="box-footer">
        {{ Form::saveButtons('common/items') }}
    </div>
    <!-- /.box-footer -->
    @endpermission
    {!! Form::close() !!}
</div>
@endsection

@push('js')
    <script src="{{ asset('public/js/bootstrap-fancyfile.js') }}"></script>
@endpush

@push('css')
    <link rel="stylesheet" href="{{ asset('public/css/bootstrap-fancyfile.css') }}">
@endpush

@push('scripts')
    <script type="text/javascript">
        var text_yes = '{{ trans('general.yes') }}';
        var text_no = '{{ trans('general.no') }}';

        

        $(document).on('click', '.select2-results__option.select2-results__message', function(e) {
            tax_name = $('.select2-search__field').val();

            $('body > .select2-container.select2-container--default.select2-container--open').remove();

            $('#modal-create-tax').remove();

            $.ajax({
                url: '{{ url("modals/taxes/create") }}',
                type: 'GET',
                dataType: 'JSON',
                data: {name: tax_name},
                success: function(json) {
                    if (json['success']) {
                        $('body').append(json['html']);
                    }
                }
            });
        });

        $(document).on('hidden.bs.modal', '#modal-create-tax', function () {
            $('#tax_id').select2({
                placeholder: {
                    id: '-1', // the value of the option
                    text: "{{ trans('general.form.select.field', ['field' => trans_choice('general.taxes', 1)]) }}"
                },
                escapeMarkup: function (markup) {
                    return markup;
                },
                language: {
                    noResults: function () {
                        return '<span id="tax-add-new"><i class="fa fa-plus-circle"></i> {{ trans('general.title.new', ['type' => trans_choice('general.tax_rates', 1)]) }}</span>';
                    }
                }
            });
        });
    </script>
@endpush
