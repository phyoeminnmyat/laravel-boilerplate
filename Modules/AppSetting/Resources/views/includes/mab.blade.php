<div class="card-header">
    <div class="row form-md-line-input">
        <label class="col-md-3 form-control-label">Mab Payment</label>
        <div class="col-md-9">
            <label class="switch switch-text switch-primary-outline-alt">
                <input type="checkbox"  name="mab_enable" class="switch-input" {{ (config('payment.mab.enable')) ? 'checked' : ''}}>
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
            </label>
        </div>
    </div>
</div>
<div class="card-body">
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="mab_mid">MID</label>
        <input type="text" value="{{ config('payment.mab.MID') }}" id="mab_mid" name="mab_mid" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="mab_sharekey">SHAREKEY</label>
        <input type="text" value="{{ config('payment.mab.ShareKey') }}" id="mab_sharekey" name="mab_sharekey" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="mab_mname">MName</label>
        <input type="text" value="{{ config('payment.mab.MName') }}"  id="mab_mname" name="mab_mname" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="mab_url">Payment URL</label>
        <input type="text" value="{{ config('payment.mab.url') }}" id="mab_url" name="mab_url" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="mab_frontend_url">Frontend URL</label>
        <input type="text" value="{{ config('payment.mab.frontend_url') }}"  disabled="disabled" id="mab_frontend_url" name="mab_frontend_url" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="mab_act_url">Act URL</label>
        <input type="text" value="{{ config('payment.mab.act_url') }}"  disabled="disabled" id="mab_act_url" name="mab_act_url" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-radios">
        <label class="col-md-3">Mab Charge Type</label>
        <div class="md-radio-inline">
            <div class="md-radio">
                <input type="radio" {{ (config('payment.mab.charge_type') == 'percentage')?'checked="checked"':'' }} value="percentage" class="md-radiobtn" name="mab_charge_type" id="mab_charge_type1">
                <label for="mab_charge_type1">
                <span class=""></span>
                <span class="check"></span>
                <span class="box"></span> Percentage </label>
            </div>
            <div class="md-radio">
                <input type="radio" {{ (config('payment.mab.charge_type') == 'amount')?'checked="checked"':'' }} value="amount" class="md-radiobtn" name="mab_charge_type" id="mab_charge_type2">
                <label for="mab_charge_type2">
                <span class=""></span>
                <span class="check"></span>
                <span class="box"></span> Amount </label>
            </div>
        </div>
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
            <label class="col-md-3" for="mab_charge">MAB Amount/Percentage</label>
            <input type="text" value="{{ config('payment.mab.charge') }}" id="mab_charge" name="mab_charge" class="form-control col-md-9">
    </div>
</div>