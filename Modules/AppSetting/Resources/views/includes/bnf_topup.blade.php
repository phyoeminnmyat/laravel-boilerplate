<div class="card-header">
    <div class="row form-md-line-input">
        <label class="col-md-3 form-control-label">BNF Topup Payment</label>
        <div class="col-md-9">
            <label class="switch switch-text switch-primary-outline-alt">
                <input type="checkbox" name="bnf_topup_enable" class="switch-input" {{ (config('payment.bnf_topup.enable')) ? 'checked' : ''}}>
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
            </label>
        </div>
    </div>
</div>
<div class="card-body">

    <div class="form-group row form-md-line-input form-md-floating-label">                                 
        <label for="bnf_topup_app_id" class="col-md-3">Merchant ID</label>
        <input type="text" value="{{ config('payment.bnf_topup.app_id') }}" id="bnf_topup_app_id" name="bnf_topup_app_id" class="form-control col-md-9">
    </div>

    <div class="form-group row form-md-line-input form-md-floating-label">                                 
    <label for="bnf_topup_payment_url" class="col-md-3">Payment URL</label>
        <input type="text" value="{{ config('payment.bnf_topup.payment_url') }}" id="bnf_topup_payment_url" name="bnf_topup_payment_url" class="form-control col-md-9">
    </div>

    <div class="form-group row form-md-line-input form-md-floating-label">                                 
    <label for="bnf_topup_secret_key" class="col-md-3">Hash Secret Key</label>
        <input type="text" value="{{ config('payment.bnf_topup.secret_key') }}" id="bnf_topup_secret_key" name="bnf_topup_secret_key" class="form-control col-md-9">
    </div>

    <div class="form-group row form-md-radios">
        <label class="col-md-3">BNF Topup Charge Type</label>
        <div class="md-radio-inline">
            <div class="md-radio">
                <input type="radio" {{ (config('payment.bnf_topup.charge_type') == 'percentage')?'checked="checked"':'' }} value="percentage" class="md-radiobtn" name="bnf_topup_charge_type" id="bnf_topup_charge_type1">
                <label for="bnf_topup_charge_type1">
                <span class=""></span>
                <span class="check"></span>
                <span class="box"></span> Percentage </label>
            </div>
            <div class="md-radio">
                <input type="radio" {{ (config('payment.bnf_topup.charge_type') == 'amount')?'checked="checked"':'' }} value="amount" class="md-radiobtn" name="bnf_topup_charge_type" id="bnf_topup_charge_type2">
                <label for="bnf_topup_charge_type2">
                <span class=""></span>
                <span class="check"></span>
                <span class="box"></span> Amount </label>
            </div>
        </div>
    </div>

    <div class="form-group row form-md-line-input form-md-floating-label">                                 
    <label for="bnf_topup_charge" class="col-md-3">BNF Topup Amount/Percentage</label>
        <input type="text" value="{{ config('payment.bnf_topup.charge') }}" id="bnf_topup_charge" name="bnf_topup_charge" class="form-control col-md-9">
    </div>
</div>
