<?php

namespace Modules\Customer\Repositories;

use Modules\Customer\Entities\Customer;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CustomerRepository.
 */
class CustomerRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Customer::class;
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
    public function getForDataTable($status = 1, $trashed = false)
    {

        $dataTableQuery = $this->model->whereHas('user', function($q) use ($status){
              return $q->active($status);
           });
        if ($trashed) {
            $dataTableQuery = $dataTableQuery->onlyTrashed();
        }
        else{
            $dataTableQuery = $dataTableQuery->with('user');
        }

        return $dataTableQuery
            ->select('*');
    }
}
