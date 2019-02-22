<div class="modal fade" id="modal-create-conversions" style="display: none;">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ trans('general.title.new', ['type' => trans_choice('general.units', 1)]) }}</h4>
            </div>

            <div class="modal-body">
                {!! Form::open(['id' => 'form-create-conversion', 'role' => 'form', 'class' => 'form-loading-button']) !!}
                <div class="row">
                   
                    {{ Form::textGroup('codigo', trans('general.code'), 'id-card-o',['value'=>$codigo,'disabled'=>'disabled'] )}}
                    {{ Form::textGroup('codumbase', trans('general.code'), 'id-card-o',['value'=>$codumbase,'disabled'=>'disabled']) }}
                    
                    
                    <div class="form-group col-md-6 ">
                        {!! Form::label('category_id', trans_choice('general.categories', 1), ['class' => 'control-label']) !!}
                       
                    {!! Form::select('codum', $unidades, null, array_merge(['class' => 'form-control', 'placeholder' => trans('general.form.select.field', ['field' => trans_choice('general.units', 1)])])) !!}
                    </div>
                    {{ Form::textGroup('cantbase', trans('general.nose'), 'id-card-o') }}
                   
             
                    {{ Form::textGroup('cantotra', trans('general.code'), 'id-card-o') }}
                    {!! Form::hidden('codigof', $codigo, []) !!}
                    {!! Form::hidden('codumbasef', $codumbase, []) !!}
                 
                    
                </div>
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <div class="pull-left">
                    {!! Form::button('<span class="fa fa-save"></span> &nbsp;' . trans('general.save'), ['type' => 'button', 'id' =>'button-create-conversion', 'class' => 'btn btn-success button-submit', 'data-loading-text' => trans('general.loading')]) !!}
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-times-circle"></span> &nbsp;{{ trans('general.cancel') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#modal-create-conversions').modal('show');
    });

    $(document).on('click', '#button-create-conversion', function (e) {
        $('#modal-create-conversions .modal-header').before('<span id="span-loading" style="position: absolute; height: 100%; width: 100%; z-index: 99; background: #6da252; opacity: 0.4;"><i class="fa fa-spinner fa-spin" style="font-size: 10em !important;margin-left: 35%;margin-top: 8%;"></i></span>');

        $.ajax({
            url: '{{ url("base/modals/conversiones") }}',
            type: 'POST',
            dataType: 'JSON',
            data: $("#form-create-conversion").serialize(),
            beforeSend: function () {
                $('#button-create-conversion').button('loading');

                $(".form-group").removeClass("has-error");
                $(".help-block").remove();
            },
            complete: function() {
                $('#button-create-conversion').button('reset');
            },
            success: function(json) {
                var data = json['data'];

                $('#span-loading').remove();

                $('#modal-create-conversion').modal('hide');
                
              
            },
            error: function(error, textStatus, errorThrown) {
                $('#span-loading').remove();
                

                if (error.responseJSON.codumbase) {
                    $("#modal-create-conversion input[name='codumbase']").parent().parent().addClass('has-error');
                    $("#modal-create-conversion input[name='codumbase']").parent().after('<p class="help-block">' + error.responseJSON.codum + '</p>');
                }
                if (error.responseJSON.cant) {
                    $("#modal-create-conversion input[name='unidad']").parent().parent().addClass('has-error');
                    $("#modal-create-conversion input[name='unidad']").parent().after('<p class="help-block">' + error.responseJSON.unidad + '</p>');
                }

                
            }
        });
    });
</script>