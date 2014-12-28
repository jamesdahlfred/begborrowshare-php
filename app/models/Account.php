<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use LaravelBook\Ardent\Ardent;

class Account extends Ardent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    public static function boot()
    {
        parent::boot();

        // Account::observe(new AccountObserver);
    }

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'accounts';

    /**
     * Ardent validation rules
     */
    public static $rules = array(
        'username'              => 'required|unique:accounts,username',
        'password'              => 'required|confirmed',
        'password_confirmation' => 'required',
        'email'                 => 'required|email|unique:accounts,email',
        'last_ip'               => 'ip'
    );

    public $autoPurgeRedundantAttributes = true;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'last_ip');

    /**
     * The attributes fillable by mass assignment.
     *
     * @var array
     */
    protected $fillable = array('username', 'password', 'password_confirmation', 'location', 'phone', 'email', 'password', 'social');

    /**
     * The attributes protected from mass assignment.
     *
     * @var array
     */
    protected $guarded = array('privileges', 'id', 'password');

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }
     
    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }
     
    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
        return $this->email;
    }

    // $table->increments('id');
    // $table->string('privileges');
    // $table->string('name');
    // $table->string('username')->unique();
    // $table->string('password');
    // $table->string('location');
    // $table->string('phone');
    // $table->string('email')->unique();
    // $table->string('social');
    // $table->string('last_ip');
    // // $table->dateTime('created_at');
    // // $table->dateTime('updated_at');
    // $table->timestamps();
    // // $table->dateTime('deleted_at');
    // $table->softDeletes();

}
