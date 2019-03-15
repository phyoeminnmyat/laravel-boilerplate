<?php

namespace Modules\Email\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use SoftDeletes;
	 /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'email';

    protected $fillable = ["id","type","name","ledgen","subject","content","mm_subject","mm_content"];

       /**
     * @return string
     */
    public function getShowButtonAttribute()
    {
    	if(auth()->user()->can('view email')){
        	return '<a href="'.route('admin.email.show', $this).'" class="btn btn-info"><i class="fas fa-eye" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.view').'"></i></a>';
        }
       	return '';
    }

    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
    	if(auth()->user()->can('edit email')){
        	return '<a href="'.route('admin.email.edit', $this).'" class="btn btn-primary"><i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.edit').'"></i></a>';
        }
       	return '';
    }

     /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        if (auth()->user()->can('delete email')) {
            return '<a href="'.route('admin.email.destroy', $this).'" data-method="delete"
                 data-trans-button-cancel="'.__('buttons.general.cancel').'"
                 data-trans-button-confirm="'.__('buttons.general.crud.delete').'"
                 data-trans-title="'.__('strings.backend.general.are_you_sure').'" class="btn btn-danger"><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.delete').'"></i></a> ';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
            return $this->getEditButtonAttribute().$this->getDeleteButtonAttribute();
    }
}
