<?php

namespace Modules\AppSetting\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AppSettingRepository.
 */
class AppSettingRepository 
{
    

    public function update($request)
    {
        $tab = $request->tab;
        $data = $request->except('_token','_method','tab');
        if($tab == 'basic'){
           
           $main_logo_url =  config('app.app_setting.main_logo');
           if($request->hasFile('main_logo')){
                $file = $request->file('main_logo');
                $logoname = 'main_logo.'.$file->extension();
                $main_logo = explode("/", $main_logo_url);
                \File::delete('app_data/'. end($main_logo));
                //$file->move(base_path('app_data/'), $logoname);
                $file->move('app_data/', $logoname);
                $data['main_logo'] =  url('app_data/'.$logoname);
            }

            // if(isset($input['logo'])){
            // $name = uniqid('category-').'.'.$input['logo']->extension();
            // $category->logo = $input['logo']->storeAs('/category' , $name, 'public');
            // }else{
            // $category->logo = '';    
            // }

            $logo_url =  config('app.app_setting.favicon');
            if($request->hasFile('app_favicon')){
                $file = $request->file('app_favicon');
                $faviconname = 'logo.'.$file->extension();
                $fav_logo = explode("/", $logo_url);
                \File::delete('app_data/'. end($fav_logo));
                //$file->move(base_path('app_data/'), $faviconname);
                $file->move('app_data/', $faviconname);
                $data['app_favicon'] =  url('app_data/'.$faviconname);
            }

           $defaults = [
              config('app.app_setting.name'), config('app.app_setting.facebook'), 
              config('app.app_setting.email'), config('app.app_setting.phone'), 
              config('app.app_setting.address'),config('app.app_setting.app_ref'),config('app.app_setting.dollar_rate'),
              config('app.app_setting.map_key'), config('app.app_setting.meta_keywords'),config('app.app_setting.meta_description'),
               $main_logo_url,$logo_url, 
            ];
        }
        elseif($tab == 'payment'){
            $defaults = [
                            config('payment.bnf_topup.app_id'),
                            config('payment.bnf_topup.payment_url'),config('payment.bnf_topup.secret_key'), 
                            config('payment.bnf_topup.charge_type'),config('payment.bnf_topup.charge'),

                            config('payment.paypal.email'), 
                            config('payment.paypal.charge_type'), config('payment.paypal.charge'),

                            config('payment.mpu.hash_key'), 
                            config('payment.mpu.merchant_id'), config('payment.mpu.payment_url'), 
                            config('payment.mpu.charge_type'), config('payment.mpu.charge'),

                            
                            config('payment.transfer.transfer_1'), 
                            config('payment.transfer.transfer_2'), config('payment.transfer.transfer_3'), 
                            config('payment.transfer.transfer_4'), config('payment.transfer.transfer_5'), 
                            config('payment.transfer.transfer_6'), config('payment.transfer.transfer_7'), 
                            config('payment.transfer.transfer_8'), config('payment.transfer.transfer_9'), 
                            config('payment.transfer.transfer_10'), config('payment.transfer.charge_type'), 
                            config('payment.transfer.charge'),

                            config('payment.onetwothree.MerchantID'), 
                            config('payment.onetwothree.Merchantpassword'), config('payment.onetwothree.Version'), 
                            config('payment.onetwothree.CurrencyCode'), config('payment.onetwothree.CountryCode'), 
                            config('payment.onetwothree.AgentCode'), config('payment.onetwothree.ChannelCode'), 
                            config('payment.onetwothree.ApiKey'), config('payment.onetwothree.Url'), 
                            config('payment.onetwothree.charge_type'), config('payment.onetwothree.charge'),

                            config('payment.visa_master.version'), 
                            config('payment.visa_master.currency'), config('payment.visa_master.hash_key'), 
                            config('payment.visa_master.merchant_id'), config('payment.visa_master.payment_url'), 
                            config('payment.visa_master.charge_type'), config('payment.visa_master.charge'),

                            config('payment.mab.MID'), 
                            config('payment.mab.ShareKey'), config('payment.mab.MName'), 
                            config('payment.mab.url'), config('payment.mab.charge_type'),
                            config('payment.mab.charge'),


                            // config('payment.deposite.charge_type'), 
                            // config('payment.deposite.charge'),
                            // config('payment.deposite.secret_key'),

                            config('payment.wave.public_key'),
                            config('payment.wave.private_key'),
                            config('payment.wave.charge_type'), 
                            config('payment.wave.charge'),

                            config('payment.kbzdirect.client_code'),
                            config('payment.kbzdirect.merchant_code'),config('payment.kbzdirect.currency_code'),
                            config('payment.kbzdirect.success_flag'),config('payment.kbzdirect.fail_flag'), 
                            config('payment.kbzdirect.payment_url'),config('payment.kbzdirect.charge_type'),
                            config('payment.kbzdirect.charge'),

                            config('payment.cb.merchant_key'),config('payment.cb.merchant_id'),
                            config('payment.cb.common_key'),config('payment.cb.currency'),
                            config('payment.cb.charge_type'), config('payment.cb.charge'),

                            config('payment.offline_sale.charge_type'), config('payment.offline_sale.charge'),

                        ];
                $bnf_topup_enable = (isset($data['bnf_topup_enable']))?"true":"false";
                unset($data['bnf_topup_enable']);
                $data['bnf_topup_enable'] =  $bnf_topup_enable;
                $defaults[] = config('payment.bnf_topup.enable')?"true":"false";
                        
                $paypal_enable = (isset($data['paypal_enable']))?"true":"false";
                unset($data['paypal_enable']);
                $data['paypal_enable'] =  $paypal_enable;
                $defaults[] = config('payment.paypal.enable')?"true":"false";

                $mpu_enable = (isset($data['mpu_enable']))?"true":"false";
                unset($data['mpu_enable']);
                $data['mpu_enable'] =  $mpu_enable;
                $defaults[] = config('payment.mpu.enable')?"true":"false";

                // $true_enable = (isset($data['true_enable']))?"true":"false";
                // unset($data['true_enable']);
                // $data['true_enable'] =  $true_enable;
                // $defaults[] = config('payment.truemoney.enable')?"true":"false";

                $transfer_enable = (isset($data['transfer_enable']))?"true":"false";
                unset($data['transfer_enable']);
                $data['transfer_enable'] =  $transfer_enable;
                $defaults[] = config('payment.transfer.enable')?"true":"false";

                $onetwothree_enable = (isset($data['onetwothree_enable']))?"true":"false";
                unset($data['onetwothree_enable']);
                $data['onetwothree_enable'] =  $onetwothree_enable;
                $defaults[] = config('payment.onetwothree.enable')?"true":"false";

                $visa_master_enable = (isset($data['visa_master_enable']))?"true":"false";
                unset($data['visa_master_enable']);
                $data['visa_master_enable'] =  $visa_master_enable;
                $defaults[] = config('payment.visa_master.enable')?"true":"false";

                $mab_enable = (isset($data['mab_enable']))?"true":"false";
                unset($data['mab_enable']);
                $data['mab_enable'] =  $mab_enable;
                $defaults[] = config('payment.mab.enable')?"true":"false";

                // $deposite_enable = (isset($data['deposite_enable']))?"true":"false";
                // unset($data['deposite_enable']);
                // $data['deposite_enable'] =  $deposite_enable;
                // $defaults[] = config('payment.deposite.enable')?"true":"false";

                $wave_enable = (isset($data['wave_enable']))?"true":"false";
                unset($data['wave_enable']);
                $data['wave_enable'] =  $wave_enable;
                $defaults[] = config('payment.wave.enable')?"true":"false";

                $kbzdirectpay_enable = (isset($data['kbzdirectpay_enable']))?"true":"false";
                unset($data['kbzdirectpay_enable']);
                $data['kbzdirectpay_enable'] =  $kbzdirectpay_enable;
                $defaults[] = config('payment.kbzdirect.enable')?"true":"false"; 


                $cbpay_enable = (isset($data['cbpay_enable']))?"true":"false";
                $cbpay_remote_enable = (isset($data['cbpay_remote_enable']))?"true":"false";
                $cbpay_money_enable = (isset($data['cbpay_money_enable']))?"true":"false";
                unset($data['cbpay_enable']);
                unset($data['cbpay_remote_enable']);
                unset($data['cbpay_money_enable']);
                $data['cbpay_enable'] =  $cbpay_enable;
                $data['cbpay_remote_enable'] =  $cbpay_remote_enable;
                $data['cbpay_money_enable'] =  $cbpay_money_enable;
                $defaults[] = config('payment.cb.enable')?"true":"false";
                $defaults[] = config('payment.cb.remote_enable')?"true":"false";
                $defaults[] = config('payment.cb.money_enable')?"true":"false";

                $offline_sale_enable = (isset($data['offline_sale_enable']))?"true":"false";
                unset($data['offline_sale_enable']);
                $data['offline_sale_enable'] =  $offline_sale_enable;
                $defaults[] = config('payment.offline_sale.enable')?"true":"false";
        }
        $content = file_get_contents(base_path() . '/.env');

        // replace default values with new ones
        $i = 0;

        // print('<pre>');
        // print_r($defaults);
        // print('<hr>');
        // dd($data);

        foreach ($data as $key => $value) {
            // echo strtoupper($key).'="'.$defaults[$i].'"<br>', strtoupper($key).'="'.$value.'"<br>';
            $content = str_replace(strtoupper($key).'="'.$defaults[$i].'"', strtoupper($key).'="'.$value.'"', $content);
            $i++;
        }
        // dd($content);
        // Update .env file
        $path = base_path('.env');

        if(file_exists($path)) {
            file_put_contents($path, $content);
        }
        return true;
    }

    public function restore()
    {
        $content = file_get_contents(base_path() . '/.env.example');
        $data['app_url'] = env('APP_URL');
        $data['database_name'] = env('DB_DATABASE');
        $data['database_username'] = env('DB_USERNAME');
        $data['database_password'] = env('DB_PASSWORD');

        $i = 0;
        foreach ($data as $key => $value) {
            $content = str_replace( $key ,  $value  , $content);
            $i++;
        }

        $path = base_path('.env');
        if (file_exists($path)) {
            if(file_put_contents($path , $content)){
                \Log::info('User Restore Default App Setting: ' . access()->user()->name);
                return true;
            }
            return false;
        }

        return false;
    }
}
