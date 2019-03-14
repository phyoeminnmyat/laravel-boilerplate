<?php

namespace Modules\AppSetting\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\AppSetting\Http\Requests\ManageAppSettingRequest;
use Modules\AppSetting\Http\Requests\UpdateAppSettingRequest;
use Modules\AppSetting\Repositories\AppSettingRepository;
use Modules\AppSetting\Http\Requests\RestoreAppSettingRequest;


class AppSettingController extends Controller
{
 /**
     * @var AppSettingRepository
     * @var CategoryRepository
     */
    protected $appsetting;

    /**
     * @param AppSettingRepository $appsetting
     */
    public function __construct(AppSettingRepository $appsetting)
    {
        $this->appsetting = $appsetting;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('appsetting::index');
    }

   
    public function show(AppSetting $appsetting, ShowAppSettingRequest $request)
    {
        return view('appsetting::show')->withAppSetting($appsetting);
    }

    public function storeAppSetting(UpdateAppSettingRequest $request)
    {
        $tab  = $request->input('tab');
        $this->appsetting->update($request);
        return redirect()->route('admin.appsetting.index',compact('tab'))->withFlashSuccess(trans('appsetting::alerts.backend.appsetting.updated'));
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(AppSetting $appsetting)
    {
        $this->appsetting->deleteById($appsetting->id);

        return redirect()->route('admin.appsetting.index')->withFlashSuccess(trans('appsetting::alerts.backend.appsetting.deleted'));
    }
}
