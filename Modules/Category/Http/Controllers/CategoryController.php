<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Category\Entities\Category;
use Modules\Offer\Entities\Offer;
use Modules\EnquiryForm\Entities\EnquiryForm;
use Modules\Category\Http\Requests\ManageCategoryRequest;
use Modules\Category\Http\Requests\CreateCategoryRequest;
use Modules\Category\Http\Requests\UpdateCategoryRequest;
use Modules\Category\Http\Requests\ShowCategoryRequest;
use Modules\Category\Repositories\CategoryRepository;

class CategoryController extends Controller
{
 /**
     * @var CategoryRepository
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
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('category::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('category::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CreateCategoryRequest $request)
    {
        $this->category->create($request->except('_token','_method'));
        return redirect()->route('admin.category.index')->withFlashSuccess(trans('category::alerts.backend.category.created'));
    }

    /**
     * @param Category              $category
     * @param ManageCategoryRequest $request
     *
     * @return mixed
     */
    public function edit(Category $category, ManageCategoryRequest $request)
    {
        \Storage::delete(asset('storage/'.$category->logo));
        return view('category::edit')
            ->withCategory($category);
    }

    public function update(Category $category, UpdateCategoryRequest $request)
    {
        $input = $request->except('_token','_method');
        $this->category->update($category,$input);
        return redirect()->route('admin.category.index')->withFlashSuccess(trans('category::alerts.backend.category.updated'));
    }

    public function show(Category $category, ShowCategoryRequest $request)
    {
        return view('category::show')->withCategory($category);
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Category $category)
    {
        // $use_enquiry = EnquiryForm::where('category_id',$category->id)->count();
        // $use_offer = Offer::where('category_id',$category->id)->count();
        // if($use_enquiry)
        // {
        //   return redirect()->route('admin.category.index')->withFlashDanger(trans('category::alerts.backend.category.cannot_deleted_enquiry'));  
        // }elseif($use_offer){
        //     return redirect()->route('admin.category.index')->withFlashDanger(trans('category::alerts.backend.category.cannot_deleted_offer'));  
        // }
        $this->category->deleteById($category->id);

        return redirect()->route('admin.category.index')->withFlashSuccess(trans('category::alerts.backend.category.deleted'));
    }
}
