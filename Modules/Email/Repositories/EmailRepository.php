<?php

namespace Modules\Email\Repositories;

use Modules\Email\Entities\Email;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EmailRepository.
 */
class EmailRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Email::class;
    }

    /**
     * @param string $order_by
     * @param string $sort
     *
     * @return mixed
     */
    public function getAll($order_by = 'created_at', $sort = 'desc')
    {
        return $this->model
            ->orderBy($order_by, $sort)
            ->get();
    }

    /**
     * @param string $order_by
     * @param string $sort
     *
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->model
            ->select('*');
    }

     public function create(array $input)
    {
        DB::transaction(function () use ($input) {
            $email = self::Model();
            $email = new $email();
            $email->type = $input['type'];
            $email->name = $input['name'];
            $email->ledgen = $input['ledgen'];
            $email->subject = $input['subject'];
            $email->content = $input['content'];
            $email->mm_subject = $input['mm_subject'];
            $email->mm_content = $input['mm_content'];

            if ($email->save()) {

                return true;
            }

            throw new GeneralException(trans('email::exceptions.backend.emails.create_error'));
        });
    }

    public function get_email_content($name, $type = Null)
    {
                $data = Email::where('name', '=', $name)->where('type' ,'=','web')->first();
                return $data;
    }

    public function get_mobile_email_content($name, $type = Null)
    {
                $data = Email::where('name', '=', $name)->where('type' ,'=','mobile')->first();
                return $data;
    }




}
