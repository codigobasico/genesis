@extends('layouts.admin')

@section('title', trans('general.title.new', ['type' => trans_choice('general.items', 1)]))

@section('content')
        <!-- Default box -->
<div class="box box-success">
    {!! Form::open(['route' => 'items.store', 'files' => true, 'role' => 'form', 'class' => 'form-loading-button']) !!}

    <div class="box-body">
        {{ Form::textGroup('codigo', trans_choice('base::general.code',1),'meetup',['placeholder'=>trans('base::general.automatic')]) }}
          {{ Form::textGroup('name', trans('general.name'), 'id-card-o',[]) }}
                 {{ Form::textGroup('nparte', trans('base::general.item.part_number'), 'cubes',[]) }}
         {{ Form::textGroup('marca', trans('base::general.item.manufacturer'), 'cogs',[]) }}
        {{ Form::textGroup('modelo', trans('base::general.item.model'), 'cubes',[]) }}
                {{ Form::textareaGroup('description', trans('general.description')) }}
          {{ Form::radioGroup('esrotativo', trans('base::general.item.is_rotative')) }}

        
        @stack('units_id_input_start')
        <div class="form-group col-md-6 required {{ $errors->has('codum') ? 'has-error' : ''}}">
            {!! Form::label('codum', trans_choice('base::general.ums.Unit_Measurement', 1), ['class' => 'control-label']) !!}
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-folder-open-o"></i></div>
                {!! Form::select('codum', $unidades, null, array_merge(['class' => 'form-control', 'placeholder' => trans('general.form.select.field', ['field' => trans_choice('general.units', 1)])])) !!}
                <div class="input-group-btn">
                    <button type="button" id="button-units" class="btn btn-default btn-icon"><i class="fa fa-plus"></i></button>
                </div>
            </div>
            {!! $errors->first('codum', '<p class="help-block">:message</p>') !!}
        </div>
        @stack('units_id_input_end')
       
        @stack('category_id_input_start')
        <div class="form-group col-md-6 required {{ $errors->has('category_id') ? 'has-error' : ''}}">
            {!! Form::label('category_id', trans_choice('general.categories', 1), ['class' => 'control-label']) !!}
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-folder-open-o"></i></div>
                {!! Form::select('category_id', $categories, null, array_merge(['class' => 'form-control', 'placeholder' => trans('general.form.select.field', ['field' => trans_choice('general.categories', 1)])])) !!}
                <div class="input-group-btn">
                    <button type="button" id="button-category" class="btn btn-default btn-icon"><i class="fa fa-plus"></i></button>
                </div>
            </div>
            {!! $errors->first('category_id', '<p class="help-block">:message</p>') !!}
        </div>
        @stack('category_id_input_end')

        {{ Form::fileGroup('picture', trans_choice('general.pictures', 1)) }}

         
        {{ Form::radioGroup('enabled', trans('general.enabled')) }}
        
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
        {{ Form::saveButtons('common/items') }}
    </div>
    <!-- /.box-footer -->

    {!! Form::close() !!}
</div>
@endsection

@push('js')
<script src="{{ asset('public/js/bootstrap-fancyfile.js') }}"></script>
<script src="{{ asset('vendor/almasaeed2010/adminlte/plugins/colorpicker/bootstrap-colorpicker.js') }}"></script>
@endpush

@push('css')
<link rel="stylesheet" href="{{ asset('public/css/bootstrap-fancyfile.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/almasaeed2010/adminlte/plugins/colorpicker/bootstrap-colorpicker.css') }}">
@endpush

@push('scripts')
<script type="text/javascript">
    var text_yes = '{{ trans('general.yes') }}';
    var text_no = '{{ trans('general.no') }}';

    $(document).ready(function(){     

        $('#enabled_1').trigger('click');

        $('#name').focus();

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
                    return '<span id="tax-add-new"><i class="fa fa-plus"></i> {{ trans('general.title.new', ['type' => trans_choice('general.tax_rates', 1)]) }}</span>';
                }
            }
        });

        $("#category_id").select2({
            placeholder: "{{ trans('general.form.select.field', ['field' => trans_choice('general.categories', 1)]) }}"
        });

        $("#codum").select2({
            placeholder: "{{ trans('general.form.select.field', ['field' => trans_choice('general.units', 1)]) }}"
        });


        $('#picture').fancyfile({
            text  : '{{ trans('general.form.select.file') }}',
            style : 'btn-default',
            placeholder : '{{ trans('general.form.no_file_selected') }}'
        });
    });

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

    $(document).on('click', '#button-category', function (e) {
        $('#modal-create-category').remove();

        $.ajax({
            url: '{{ url("base/modals/conversiones/create") }}',
            type: 'GET',
            dataType: 'JSON',
            data: {type: 'item'},
            success: function(json) {
                if (json['success']) {
                    $('body').append(json['html']);
                }
            }
        });
    });
    
    
    $(document).on('click', '#button-units', function (e) {
        $('#modal-create-unit').remove();

        $.ajax({
            url: '{{ url("base/modals/unidades/create") }}',
            type: 'GET',
            dataType: 'JSON',
            data: {type: 'item'},
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
