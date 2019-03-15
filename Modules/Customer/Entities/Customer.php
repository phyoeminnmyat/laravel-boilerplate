<?php

namespace Modules\Customer\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid as PackageUuid;
use App\Models\Auth\User;

class Customer extends Model
{
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{'customer_id'} = strtoupper(PackageUuid::generate(4)->string);
        });
    }

	 /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customer';

    protected $fillable = ["id","name","user_id","customer_id","mobile","fax","address","image"];

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    /**
     */
    public function getShowButtonAttribute()
    {
    	if(auth()->user()->can('view customer')){
        	return '<a href="'.route('admin.customer.show', $this).'" class="btn btn-info"><i class="fas fa-eye" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.view').'"></i></a>';
        }
       	return '';
    }

    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
    	if(auth()->user()->can('edit customer')){
        	return '<a href="'.route('admin.customer.edit', $this).'" class="btn btn-primary"><i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.edit').'"></i></a>';
        }
       	return '';
    }

     /**
     * @return string
     */
    public function getChangePasswordButtonAttribute()
    {
        return '<a href="'.route('admin.auth.user.change-password', $this->user).'" class="dropdown-item">'.__('buttons.backend.access.users.change_password').'</a> ';
    }

    public function getStatusButtonAttribute()
    {
        if ($this->user->id != auth()->id()) {
            switch ($this->user->active) {
                case 0:
                    return '<a href="'.route('admin.auth.user.mark', [
                            $this->user,
                            1,
                        ]).'" class="dropdown-item">'.__('buttons.backend.access.users.activate').'</a> ';

                case 1:
                    return '<a href="'.route('admin.auth.user.mark', [
                            $this->user,
                            0,
                        ]).'" class="dropdown-item">'.__('buttons.backend.access.users.deactivate').'</a> ';

                default:
                    return '';
            }
        }

        return '';
    }

    public function getDeleteButtonAttribute()
    {
        if (auth()->user()->can('delete customer') || $this->user->id != auth()->id() && $this->user->id != 1) {
            return '<a href="'.route('admin.customer.destroy', $this).'" data-method="delete"
                 data-trans-button-cancel="'.__('buttons.general.cancel').'"
                 data-trans-button-confirm="'.__('buttons.general.crud.delete').'"
                 data-trans-title="'.__('strings.backend.general.are_you_sure').'" class="dropdown-item">'
                 .__('buttons.general.crud.delete').'</a> ';
        }

        return '';
    }

    public function getDeletePermanentlyButtonAttribute()
    { 
        return '<a href="'.route('admin.customer.delete-permanently', [ 'id' =>$this->id ]).'" name="confirm_item" class="btn btn-danger"><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="'.__('buttons.backend.access.users.delete_permanently').'"></i></a> ';
    }

    /**
     * @return string
     */
    public function getRestoreButtonAttribute()
    {
        return '<a href="'.route('admin.customer.restore', ['id' => $this->id]).'" name="confirm_item" class="btn btn-info"><i class="icon icon-refresh" data-toggle="tooltip" data-placement="top" title="'.__('buttons.backend.access.users.restore_user').'"></i></a> ';
    }



    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
            if ($this->trashed()) {
            return '
                <div class="btn-group btn-group-sm" role="group" aria-label="User Actions">
                  '.$this->restore_button.'
                  '.$this->delete_permanently_button.'
                </div>';
            }
            return $this->getShowButtonAttribute().$this->getEditButtonAttribute().'<div class="btn-group" role="group">
            <button id="userActions" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              More
            </button>
            <div class="dropdown-menu" aria-labelledby="userActions">
              '.$this->clear_session_button.'
              '.$this->login_as_button.'
              '.$this->change_password_button.'
              '.$this->status_button.'
              '.$this->confirmed_button.'
              '.$this->delete_button.'
            </div>
          </div>';
    }
}
