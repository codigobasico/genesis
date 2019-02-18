<div class="modal fade" id="modal-create-unit" style="display: none;">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ trans('general.title.new', ['type' => trans_choice('general.units', 1)]) }}</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['id' => 'form-create-unit', 'role' => 'form', 'class' => 'form-loading-button']) !!}
                <div class="row">
                    {{ Form::textGroup('codum', trans('general.code'), 'id-card-o'),[] }}
                    {{ Form::textGroup('unidad', trans('general.code'), 'id-card-o') }}
                    {{ Form::textGroup('dimension', trans('units.dimension'), 'id-card-o') }}
                 
                    
                </div>
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <div class="pull-left">
                    {!! Form::button('<span class="fa fa-save"></span> &nbsp;' . trans('general.save'), ['type' => 'button', 'id' =>'button-create-unit', 'class' => 'btn btn-success button-submit', 'data-loading-text' => trans('general.loading')]) !!}
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-times-circle"></span> &nbsp;{{ trans('general.cancel') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#modal-create-unit').modal('show');
    });

    $(document).on('click', '#button-create-unit', function (e) {
        $('#modal-create-unit .modal-header').before('<span id="span-loading" style="position: absolute; height: 100%; width: 100%; z-index: 99; background: #6da252; opacity: 0.4;"><i class="fa fa-spinner fa-spin" style="font-size: 10em !important;margin-left: 35%;margin-top: 8%;"></i></span>');

        $.ajax({
            url: '{{ url("base/modals/unidades") }}',
            type: 'POST',
            dataType: 'JSON',
            data: $("#form-create-unit").serialize(),
            beforeSend: function () {
                $('#button-create-unit').button('loading');

                $(".form-group").removeClass("has-error");
                $(".help-block").remove();
            },
            complete: function() {
                $('#button-create-unit').button('reset');
            },
            success: function(json) {
                var data = json['data'];

                $('#span-loading').remove();

                $('#modal-create-unit').modal('hide');
                $("#codum").append('<option value="' + data.codum + '" selected="selected">' + data.unidad + '</option>');
                $("#codum").select2('refresh');
              
            },
            error: function(error, textStatus, errorThrown) {
                $('#span-loading').remove();
                

                if (error.responseJSON.codum) {
                    $("#modal-create-unit input[name='codum']").parent().parent().addClass('has-error');
                    $("#modal-create-unit input[name='codum']").parent().after('<p class="help-block">' + error.responseJSON.codum + '</p>');
                }
                if (error.responseJSON.unidad) {
                    $("#modal-create-unit input[name='unidad']").parent().parent().addClass('has-error');
                    $("#modal-create-unit input[name='unidad']").parent().after('<p class="help-block">' + error.responseJSON.unidad + '</p>');
                }

                
            }
        });
    });
</script>