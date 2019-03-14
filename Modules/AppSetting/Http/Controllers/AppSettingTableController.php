<?php

namespace Modules\AppSetting\Http\Controllers;

use Illuminate\Routing\Controller;
use DataTables;
use Modules\AppSetting\Repositories\AppSettingRepository;
use Modules\AppSetting\Http\Requests\ManageAppSettingRequest;

class AppSettingTableController extends Controller
{
    /**
     * @var AppSettingRepository
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
     * @param ManageAppSettingRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageAppSettingRequest $request)
    {
        return Datatables::of($this->appsetting->getForDataTable())
            ->addColumn('actions', function ($appsetting) {
                return $appsetting->action_buttons;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}
