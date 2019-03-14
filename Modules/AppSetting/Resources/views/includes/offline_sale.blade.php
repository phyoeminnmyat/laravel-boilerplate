<div class="card-header">
    <div class="row form-md-line-input">
        <label class="col-md-3 form-control-label">OfflineSale Payment</label>
        <div class="col-md-9">
            <label class="switch switch-text switch-primary-outline-alt">
                <input type="checkbox" name="offline_sale_enable" class="switch-input" {{ (config('payment.offline_sale.enable')) ? 'checked' : ''}}>
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
            </label>
        </div>
    </div>
</div>
<div class="card-body">
<div class="form-group row form-md-radios">
        <label class="col-md-3">Offline Sale Charge Type</label>
        <div class="md-radio-inline">
            <div class="md-radio">
                <input type="radio" {{ (config('payment.offline_sale.charge_type') == 'percentage')?'checked="checked"':'' }} value="percentage" class="md-radiobtn" name="offline_sale_charge_type" id="offline_sale_charge_type1">
                <label for="offline_sale_charge_type1">
                <span class=""></span>
                <span class="check"></span>
                <span class="box"></span> Percentage </label>
            </div>
            <div class="md-radio">
                <input type="radio" {{ (config('payment.offline_sale.charge_type') == 'amount')?'checked="checked"':'' }} value="amount" class="md-radiobtn" name="offline_sale_charge_type" id="offline_sale_charge_type2">
                <label for="offline_sale_charge_type2">
                <span class=""></span>
                <span class="check"></span>
                <span class="box"></span> Amount </label>
            </div>
        </div>
    </div>
<div class="form-group row form-md-line-input form-md-floating-label">
    <label class="col-md-3" for="offline_sale_charge">Offine Sale Charge Amount/Percentagel</label>
    <input type="text" value="{{ config('payment.offline_sale.charge') }}" id="offline_sale_charge" name="offline_sale_charge" class="form-control col-md-9">
</div>
