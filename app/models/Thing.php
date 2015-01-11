<?php

use LaravelBook\Ardent\Ardent;

class Thing extends Ardent {

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
    protected $table = 'things';

    /**
     * Ardent validation rules
     */
    public static $rules = array(
        'title' => 'required',
        'owner' => 'required',
        'possessor' => 'required'
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

    public function owner()
    {
        return $this->belongsTo('Account', 'owner');
    }

    public function possessor()
    {
        return $this->belongsTo('Account', 'possessor');
    }

    // $table->increments('id');
    // $table->integer('owner')->unsigned();
    // $table->integer('possessor')->unsigned();
    // $table->string('location');
    // $table->string('title');
    // $table->string('description');
    // $table->string('specs');
    // $table->string('images');
    // // $table->dateTime('created_at');
    // // $table->dateTime('updated_at');
    // $table->timestamps();
    // // $table->dateTime('deleted_at');
    // $table->softDeletes();

}
