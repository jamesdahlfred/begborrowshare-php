<?php

use LaravelBook\Ardent\Ardent;

class Share extends Ardent {

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
    protected $table = 'shares';

    /**
     * Ardent validation rules
     */
    public static $rules = array(
        'title' => 'required',
        'sharer' => 'required'
    );

    public $autoPurgeRedundantAttributes = true;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array();

    /**
     * The attributes fillable by mass assignment.
     *
     * @var array
     */
    protected $fillable = array();

    /**
     * The attributes protected from mass assignment.
     *
     * @var array
     */
    protected $guarded = array();

    public function sharer()
    {
        return $this->belongsTo('Account', 'sharer');
    }

    public function receiver()
    {
        return $this->belongsTo('Account', 'receiver');
    }

    // $table->increments('id');
    // $table->integer('sharer')->unsigned();
    // $table->integer('receiver')->unsigned();
    // $table->boolean('private');
    // $table->string('title');
    // $table->text('description');
    // $table->string('categories')->nullable();
    // $table->dateTime('claimed_at');
    // $table->dateTime('expires_at');
    // // $table->dateTime('created_at');
    // // $table->dateTime('updated_at');
    // $table->timestamps();
    // // $table->dateTime('deleted_at');
    // $table->softDeletes();
    // $table->foreign('sharer')->references('id')->on('accounts');
    // $table->foreign('receiver')->references('id')->on('accounts');

}
