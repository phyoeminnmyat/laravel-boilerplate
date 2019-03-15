<?php

namespace Modules\Customer\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
// use GMBF\MyanmarPhoneNumber;

use Modules\Customer\Entities\Customer;
use Modules\Customer\Http\Requests\ManageCustomerRequest;
use Modules\Customer\Http\Requests\CreateCustomerRequest;
use Modules\Customer\Http\Requests\UpdateCustomerRequest;
use Modules\Customer\Http\Requests\ShowCustomerRequest;
use Modules\Customer\Repositories\CustomerRepository;
use App\Repositories\Backend\Auth\UserRepository;
use App\Http\Requests\Backend\Auth\User\ManageUserRequest;
use App\Models\Auth\User;
use App\Events\Backend\Auth\User\UserDeleted;
use Modules\UserEnquiry\Entities\UserEnquiry;




class CustomerController extends Controller
{
 /**
     * @var CustomerRepository
     */
    protected $customer;

        /**
     * @var UserRepository
     */
    protected $userRepository;
    /**
     * @param CustomerRepository $customer
     */
    public function __construct(CustomerRepository $customer,UserRepository $userRepository,User $user)
    {
        $this->userRepository = $userRepository;
        $this->customer = $customer;
        $this->user = $user ;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $active = 1;
        $trashed = false;
        return view('customer::index',compact('active','trashed'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('customer::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CreateCustomerRequest $request)
    {
        $input = $request->except('_token','_method');

        $customer_name = explode(' ', $input['name']);
        $firstname = $customer_name[0];
        unset($customer_name[0]);
        $lastname  = implode(' ',$customer_name);

        $user = $this->userRepository->create([
            'first_name' => $firstname,
            'last_name' => $lastname,
            'email' => isset($input['email']) ? $input['email'] : null ,
            'password' => $input['password'],
            'timezone' => $input['timezone'],
            'active' => $input['active'],
            'confirmed' => $input['confirmed'],
            'confirmation_email' => @$input['confirmation_email'],
            'is_customer' => 1,
            'roles' => [ 0 => 'user']
        ]);

        $input['user_id'] = $user->id;

        // $phone_number = new MyanmarPhoneNumber();
        // $input['mobile'] = $phone_number->add_prefix($input['mobile']);

        $this->customer->create($input);
        return redirect()->route('admin.customer.index')->withFlashSuccess(trans('customer::alerts.backend.customer.created'));
    }

    /**
     * @param Customer              $customer
     * @param ManageCustomerRequest $request
     *
     * @return mixed
     */
    public function edit(Customer $customer, ManageCustomerRequest $request)
    {
        return view('customer::edit')
            ->withCustomer($customer);
    }

    /**
     * @param Customer              $customer
     * @param UpdateCustomerRequest $request
     *
     * @return mixed
     */
    public function update(Customer $customer, UpdateCustomerRequest $request)
    {
        $input = $request->except('_token','_method');
        $user = $customer->user;
        
        $customer_name = explode(' ', $input['name']);
        $input['first_name'] = $customer_name[0];
        unset($customer_name[0]);
        $input['last_name'] = implode(' ',$customer_name);
        $input['full_name'] = $input['name'];

        $this->userRepository->update($user,$input);

        // $phone_number = new MyanmarPhoneNumber();
        // $input['mobile'] = $phone_number->add_prefix($input['mobile']);
        $this->customer->updateById($customer->id,$input);

        return redirect()->route('admin.customer.index')->withFlashSuccess(trans('customer::alerts.backend.customer.updated'));
    }

    public function getDeactivated(ManageUserRequest $request)
    {
        $active = 0;
        $trashed = '';
        return view('customer::deactivated_customer',compact('active','trashed'));
    }

    public function getDeleted(ManageUserRequest $request)
    {
        $active = 0;
        $trashed = true;
        return view('customer::deleted_customer',compact('active','trashed'));
    }

    /**
     * @param Customer              $customer
     * @param ManageCustomerRequest $request
     *
     * @return mixed
     */
    public function show(Customer $customer, ShowCustomerRequest $request)
    {
        return view('customer::show')->withCustomer($customer);
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Customer $customer)
    {
        $use_enquiry = UserEnquiry::where('user_id',$customer->user->id)->count();
        if($use_enquiry){
            return redirect()->route('admin.customer.index')->withFlashDanger('This customer can\'t be delete.It has been used in UserEnquiry Form. ');  
        }else{
        $this->userRepository->mark($customer->user, 0);
        $this->customer->deleteById($customer->id);

        return redirect()->route('admin.customer.deleted')->withFlashSuccess(trans('customer::alerts.backend.customer.deleted'));
        }
    }

    public function permanentlyDelete(ManageUserRequest $request)
    {
        $customer = Customer::withTrashed()->where('id',$request->get('id'))->first();
        $customer->forcedelete();
        $user = User::withTrashed()->where('id',$customer->user_id)->first();
        $this->userRepository->forceDelete($user);
        return redirect()->route('admin.customer.deleted')->withFlashSuccess(__('alerts.backend.users.deleted_permanently'));
    }

    public function restore(ManageUserRequest $request)
    {
        $customer = Customer::withTrashed()->where('id',$request->get('id'))->first();
        User::withTrashed()->where('id',$customer->user_id)->update([
                'active' => 1,
        ]);
        $customer->restore() ;

        return redirect()->route('admin.customer.index')->withFlashSuccess(__('alerts.backend.users.restored'));
    }
}
