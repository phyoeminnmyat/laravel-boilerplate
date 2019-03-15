<?php

namespace Modules\Customer\Http\Controllers;

use Illuminate\Routing\Controller;
use DataTables;
use Modules\Customer\Repositories\CustomerRepository;
use Modules\Customer\Http\Requests\ManageCustomerRequest;
use App\Models\Auth\User;


class CustomerTableController extends Controller
{
    /**
     * @var CustomerRepository
     */
    protected $customer;

    /**
     * @param CustomerRepository $customer
     */
    public function __construct(CustomerRepository $customer)
    {
        $this->customer = $customer;
    }

    /**
     * @param ManageCustomerRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageCustomerRequest $request)
    {
        return Datatables::eloquent($this->customer->getForDataTable($request->get('active'), $request->get('trashed')))
            ->addColumn('actions', function ($customer) {
                return $customer->action_buttons;
            })
            ->addColumn('confirmed',function($customer){
                return $customer->user->confirmed_label;
            })
            ->addColumn('email', function ($customer) {
                return $customer->user->email;
            })
            ->rawColumns(['actions','email','confirmed'])
            ->make(true);
    }
}
