<div class="card-header">
    <div class="row form-md-line-input">
        <label class="col-md-3 form-control-label">MPU Payment</label>
        <div class="col-md-9">
            <label class="switch switch-text switch-primary-outline-alt">
                <input type="checkbox" name="mpu_enable" class="switch-input" {{ (config('payment.mpu.enable')) ? 'checked' : ''}}>
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
            </label>
        </div>
    </div>
</div>
<div class="card-body">
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="mpu_hash_key">Hash Secret Key</label>
        <input type="text" value="{{ config('payment.mpu.hash_key') }}" id="mpu_hash_key" name="mpu_hash_key" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="mpu_merchant_id">Merchant ID</label>
        <input type="text" value="{{ config('payment.mpu.merchant_id') }}" id="mpu_merchant_id" name="mpu_merchant_id" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="mpu_payment_url">Payment URL</label>
        <input type="text" value="{{ config('payment.mpu.payment_url') }}"  id="mpu_payment_url" name="mpu_payment_url" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="mpu_frontend_url">Frontend URL</label>
        <input type="text" value="{{ config('payment.mpu.frontend_url') }}" disabled="disabled"  id="mpu_frontend_url" name="mpu_frontend_url" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="mpu_backend_url">Backend URL</label>
        <input type="text" value="{{ config('payment.mpu.backend_url') }}"  disabled="disabled" id="mpu_backend_url" name="mpu_backend_url" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-radios">
        <label class="col-md-3">MPU Charge Type</label>
        <div class="md-radio-inline">
            <div class="md-radio">
                <input type="radio" {{ (config('payment.mpu.charge_type') == 'percentage')?'checked="checked"':'' }} value="percentage" class="md-radiobtn" name="mpu_charge_type" id="mpu_charge_type1">
                <label for="mpu_charge_type1">
                <span class=""></span>
                <span class="check"></span>
                <span class="box"></span> Percentage </label>
            </div>
            <div class="md-radio">
                <input type="radio" {{ (config('payment.mpu.charge_type') == 'amount')?'checked="checked"':'' }} value="amount" class="md-radiobtn" name="mpu_charge_type" id="mpu_charge_type2">
                <label for="mpu_charge_type2">
                <span class=""></span>
                <span class="check"></span>
                <span class="box"></span> Amount </label>
            </div>
        </div>
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
            <label class="col-md-3" for="mpu_charge">MPU Amount/Percentage</label>
            <input type="text" value="{{ config('payment.mpu.charge') }}" id="mpu_charge" name="mpu_charge" class="form-control col-md-9">
    </div>
</div>