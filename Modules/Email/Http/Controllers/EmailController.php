<?php

namespace Modules\Email\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Email\Entities\Email;
use Modules\Email\Http\Requests\ManageEmailRequest;
use Modules\Email\Http\Requests\CreateEmailRequest;
use Modules\Email\Http\Requests\UpdateEmailRequest;
use Modules\Email\Http\Requests\ShowEmailRequest;
use Modules\Email\Repositories\EmailRepository;

class EmailController extends Controller
{
 /**
     * @var EmailRepository
     * @var CategoryRepository
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
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('email::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('email::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CreateEmailRequest $request)
    {
        $this->email->create($request->except('_token','_method'));
        return redirect()->route('admin.email.index')->withFlashSuccess(trans('email::alerts.backend.email.created'));
    }

    /**
     * @param Email              $email
     * @param ManageEmailRequest $request
     *
     * @return mixed
     */
    public function edit(Email $email, ManageEmailRequest $request)
    {
        return view('email::edit')
            ->withEmail($email);
    }

    /**
     * @param Email              $email
     * @param UpdateEmailRequest $request
     *
     * @return mixed
     */
    public function update(Email $email, UpdateEmailRequest $request)
    {
        $this->email->updateById($email->id,$request->except('_token','_method'));

        return redirect()->route('admin.email.index')->withFlashSuccess(trans('email::alerts.backend.email.updated'));
    }

    /**
     * @param Email              $email
     * @param ManageEmailRequest $request
     *
     * @return mixed
     */
    public function show(Email $email, ShowEmailRequest $request)
    {
        return view('email::show')->withEmail($email);
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Email $email)
    {
        $this->email->deleteById($email->id);

        return redirect()->route('admin.email.index')->withFlashSuccess(trans('email::alerts.backend.email.deleted'));
    }
}
