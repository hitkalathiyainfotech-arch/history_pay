<div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Edit App') }}</h5>
                <button type="button" aria-label="Close" class="close" data-bs-dismiss="modal">×</button>
            </div>
            {{ Form::open(['id'=>'editForm']) }}
            <div class="modal-body">
                {{ Form::hidden('appId',null,['id'=>'appId']) }}
                <div class="row">
                    <div class="form-group col-sm-12">
                        {{ Form::label('name',__('Name').':') }}<span class="mandatory">*</span>
                        {{ Form::text('name', null, ['class' => 'form-control','','id'=>'edit_name']) }}
                    </div>
                </div>
                <div class="text-right">
                    {{ Form::button(__('Save'), ['type'=>'submit','class' => 'btn btn-primary']) }}
                    <button type="button" class="btn btn-default ml-1"
                            data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
