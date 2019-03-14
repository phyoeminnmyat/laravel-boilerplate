<div class="card-header">
    <div class="row form-md-line-input">
        <label class="col-md-3 form-control-label">Paypal Payment</label>
        <div class="col-md-9">
            <label class="switch switch-text switch-primary-outline-alt">
                <input type="checkbox" name="paypal_enable" class="switch-input" {{ (config('payment.paypal.enable')) ? 'checked' : ''}}>
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
            </label>
        </div>
    </div>
</div>
<div class="card-body">
<div class="form-group row form-md-line-input form-md-floating-label">
    <label class="col-md-3" for="paypal_email">Paypal Account Email</label>
    <input type="text" value="{{ config('payment.paypal.email') }}" id="paypal_email" name="paypal_email" class="form-control col-md-9">
</div>
<div class="form-group row form-md-radios">
        <label class="col-md-3">Paypal Charge Type</label>
        <div class="md-radio-inline">
            <div class="md-radio">
                <input type="radio" {{ (config('payment.paypal.charge_type') == 'percentage')?'checked="checked"':'' }} value="percentage" class="md-radiobtn" name="paypal_charge_type" id="paypal_charge_type1">
                <label for="paypal_charge_type1">
                <span class=""></span>
                <span class="check"></span>
                <span class="box"></span> Percentage </label>
            </div>
            <div class="md-radio">
                <input type="radio" {{ (config('payment.paypal.charge_type') == 'amount')?'checked="checked"':'' }} value="amount" class="md-radiobtn" name="paypal_charge_type" id="paypal_charge_type2">
                <label for="paypal_charge_type2">
                <span class=""></span>
                <span class="check"></span>
                <span class="box"></span> Amount </label>
            </div>
        </div>
    </div>
<div class="form-group row form-md-line-input form-md-floating-label">
    <label class="col-md-3" for="paypal_charge">Paypal Charge Amount/Percentagel</label>
    <input type="text" value="{{ config('payment.paypal.charge') }}" id="paypal_charge" name="paypal_charge" class="form-control col-md-9">
 </div>