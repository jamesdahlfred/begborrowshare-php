<?php

use LaravelBook\Ardent\Ardent;

class Beg extends Ardent {

    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

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
    protected $table = 'begs';

    /**
     * Ardent validation rules
     */
    public static $rules = array(
        'title' => 'required',
        'beggar' => 'required'
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
    protected $fillable = array('beggar', 'benefactor', 'private', 'title', 'description', 'categories', 'location', 'fulfilled_at', 'expires_at', 'created_at', 'updated_at', 'deleted_at');

    /**
     * The attributes protected from mass assignment.
     *
     * @var array
     */
    protected $guarded = array('id');

    public function beggar()
    {
        return $this->belongsTo('Account', 'beggar');
    }

    public function benefactor()
    {
        return $this->belongsTo('Account', 'benefactor');
    }

    // $table->increments('id');
    // $table->integer('beggar')->unsigned();
    // $table->integer('benefactor')->unsigned();
    // $table->boolean('private');
    // $table->string('title');
    // $table->text('description');
    // $table->string('categories')->nullable();
    // $table->string('location');
    // $table->dateTime('fulfilled_at');
    // $table->dateTime('expires_at');
    // // $table->dateTime('created_at');
    // // $table->dateTime('updated_at');
    // $table->timestamps();
    // // $table->dateTime('deleted_at');
    // $table->softDeletes();
    // $table->foreign('beggar')->references('id')->on('accounts');
    // $table->foreign('benefactor')->references('id')->on('accounts');

    // public function getDates()
    // {
    //     return array('fulfilled_at', 'expires_at', 'created_at', 'updated_at', 'deleted_at');
    //     // created_at->toRfc2822String()
    // }

}
