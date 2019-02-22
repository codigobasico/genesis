@extends('layouts.admin')

@section('title', trans('general.title.edit', ['type' => trans_choice('general.items', 1)]))

@section('content')
<!-- Default box -->
<div class="box box-success">
    {!! Form::model($item, [
        'method' => 'PATCH',
        'files' => true,
        'route' => ['items.update', $item->id],
        'role' => 'form',
        'class' => 'form-loading-button'
    ]) !!}

    <div class="box-body">
         {{ Form::textGroup('codigo', trans_choice('base::general.code',1),'meetup',['disabled'=>'disabled','placeholder'=>trans('base::general.automatic')]) }}
          {{ Form::textGroup('name', trans('general.name'), 'id-card-o',[]) }}
                 {{ Form::textGroup('nparte', trans('base::general.item.part_number'), 'cubes',[]) }}
         {{ Form::textGroup('marca', trans('base::general.item.manufacturer'), 'cogs',[]) }}
        {{ Form::textGroup('modelo', trans('base::general.item.model'), 'cubes',[]) }}
                {{ Form::textareaGroup('description', trans('general.description')) }}
          {{ Form::radioGroup('esrotativo', trans('base::general.item.is_rotative')) }}
            
          
      <div class="input-group">
           {{ Form::selectGroup('codum', trans_choice('base::general.ums.Unit_Measurement',1), 'folder-open-o', $unidades, null, []) }}
           <div class="input-group-btn">
                    <button type="button" id="button-conversions" class="btn btn-default btn-icon"><i class="fa fa-plus"></i></button>
           </div>
            
       </div>
                 
       {{ Form::selectGroup('category_id', trans_choice('general.categories', 1), 'folder-open-o', $categories, null, []) }}

        {{ Form::fileGroup('picture', trans_choice('general.pictures', 1)) }}

        {{ Form::radioGroup('enabled', trans('general.enabled')) }}
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

        $(document).ready(function(){
            

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

            $('#picture').fancyfile({
                text  : '{{ trans('general.form.select.file') }}',
                style : 'btn-default',
                @if($item->picture)
                placeholder : '{{ $item->picture->basename }}'
                @else
                placeholder : '{{ trans('general.form.no_file_selected') }}'
                @endif
            });

            @if($item->picture)
            $.ajax({
                url: '{{ url('uploads/' . $item->picture->id . '/show') }}',
                type: 'GET',
                data: {column_name: 'picture'},
                dataType: 'JSON',
                success: function(json) {
                    if (json['success']) {
                        $('.fancy-file').after(json['html']);
                    }
                }
            });

            @permission('delete-common-uploads')
            $(document).on('click', '#remove-picture', function (e) {
                confirmDelete("#picture-{!! $item->picture->id !!}", "{!! trans('general.attachment') !!}", "{!! trans('general.delete_confirm', ['name' => '<strong>' . $item->picture->basename . '</strong>', 'type' => strtolower(trans('general.attachment'))]) !!}", "{!! trans('general.cancel') !!}", "{!! trans('general.delete')  !!}");
            });
            @endpermission
            @endif
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
        
         $(document).on('click', '#button-conversions', function (e) {
        $('#modal-create-conversions').remove();

        $.ajax({
            url: '{{ url("base/modals/conversiones/create") }}',
            type: 'GET',
            dataType: 'JSON',
            data: {codigo: $('#codigo').val(),codumbase: $('#codum').val() },
            success: function(json) {
                if (json['success']) {
                    $('body').append(json['html']);
                }
            }
        });
    });
    </script>
@endpush
