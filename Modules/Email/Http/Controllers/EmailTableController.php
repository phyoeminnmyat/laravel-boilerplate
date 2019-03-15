<?php

namespace Modules\Email\Http\Controllers;

use Illuminate\Routing\Controller;
use DataTables;
use Modules\Email\Repositories\EmailRepository;
use Modules\Email\Http\Requests\ManageEmailRequest;

class EmailTableController extends Controller
{
    /**
     * @var EmailRepository
     */
    protected $email;

    /**
     * @param EmailRepository $email
     */
    public function __construct(EmailRepository $email)
    {
        $this->email = $email;
    }

    /**
     * @param ManageEmailRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageEmailRequest $request)
    {
        return Datatables::of($this->email->getForDataTable())
            ->addColumn('type',function($email){
                if ($email->type == 'web'){
                return '<span class="badge badge-pill badge-primary" style="font-size:15px;">'.$email->type.'</span>' ;
                }else{
                return '<span class="badge badge-pill badge-danger" style="font-size:15px;">'.$email->type.'</span>' ;
                }
            })
            ->addColumn('actions', function ($email) {
                return $email->action_buttons;
            })
            ->rawColumns(['actions','type','content'])
            ->make(true);
    }
}
