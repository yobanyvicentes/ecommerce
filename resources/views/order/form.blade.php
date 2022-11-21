<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('email_asociado') }}
            {{ Form::text('email_asociado', $order->email_asociado, ['class' => 'form-control' . ($errors->has('email_asociado') ? ' is-invalid' : ''), 'placeholder' => 'Email Asociado']) }}
            {!! $errors->first('email_asociado', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>