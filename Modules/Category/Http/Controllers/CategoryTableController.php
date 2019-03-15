<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Routing\Controller;
use DataTables;
use Modules\Category\Repositories\CategoryRepository;
use Modules\Category\Http\Requests\ManageCategoryRequest;

class CategoryTableController extends Controller
{
    /**
     * @var CategoryRepository
     */
    protected $category;

    /**
     * @param CategoryRepository $category
     */
    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }

    /**
     * @param ManageCategoryRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageCategoryRequest $request)
    {
        return Datatables::of($this->category->getForDataTable())
            ->addColumn('actions', function ($category) {
                return $category->action_buttons;
            })
            ->addColumn('status',function ($formcategory){
                return $formcategory->status ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">InActive</span>';
            })
            ->editColumn('logo',function($category){
                // <img src="{{ asset('storage/'.$category->logo) }}" style="width: 100px;height: 100px;">

                return '<img src="'.asset('storage/'.$category->logo).'" style="width: 100px;height: 100px;">';
            })
            ->rawColumns(['actions','status','logo'])
            ->make(true);
    }
}
