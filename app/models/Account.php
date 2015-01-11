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
        'name'                  => 'required',
        'username'              => 'required|unique:accounts,username',
        'password'              => 'required|min:6',
        'email'                 => 'required|email|unique:accounts,email',
        'last_ip'               => 'ip'
    );

    public function isValid()
    {
        $validation = Validator::make($this->attributes, static::$rules);

        if ($validation->passes()) return true;

        $this->errors = $validation->messages();
        return false;
    }    

    // $rules = Account::$rules;
    // $rules['password'] = 'required|min:6|confirmed';
    // $rules['password_confirmation'] = 'required';

    /**
     * Ardent validation failure messages
     */
    public static $customMessages = array(
        'name.required' => 'Your name is required, nicknames are okay.',
        'username.required' => 'Username is required.',
        'username.unqiue' => 'That username is already taken.',
        'password.required' => 'Password is required. Minimum length is 6 characters, no maximum length. We suggest a short, memorable phrase like "to borrow is human, to share is divine" (but don&apos;t use that one).',
        'password.confirmed' => 'Your passwords don&apos;t match.',
        'password_confirmation.required' => 'Your passwords don&apos;t match.',
        'email.required' => 'Email address is required.',
        'email.email' => 'That doesn&apos;t look like a real email address.',
        'email.unique' => 'That email address is already is use. Did you forget your password?',
        'last_ip.required' => 'That doesn&apos;t look like a real IP address.'
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
    protected $fillable = array('privileges', 'name', 'username', 'password', 'password_confirmation', 'location', 'phone', 'email', 'social', 'last_ip');

    /**
     * The attributes protected from mass assignment.
     *
     * @var array
     */
    protected $guarded = array('id');

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

    // public function things()
    // {
    //     return $this->hasMany('Thing');
    // }

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
