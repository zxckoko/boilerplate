<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Model extends EloquentModel
{
    use HasFactory, SoftDeletes;

    /*
     * If you need to customize the names of the columns used to store the timestamps,
     * you may define CREATED_AT and UPDATED_AT constants on your model.
     * */
    // const CREATED_AT = 'sample_created_at_date';
    // const UPDATED_AT = 'sample_updated_at_date';


    /*
     * Indicates if the model's ID is auto-incrementing.
     * */
    // public $incrementing = false;


    /*
     * Indicates if the model should be timestamped.
     * */
    // public $timestamps = false;


    /*
     * The model's default values for attributes.
     * */
    /* protected $attributes = [
        'options' => '[]',
        'delayed' => false,
    ]; */


    /*
     * The database connection that should be used by the model.
     * */
    // protected $connection = 'mysql';


    /*
     * The storage format of the model's date columns.
     * */
    // protected $dateFormat = 'U';

    /*
     * Think of this as a WHITELIST against mass-assignment vulnerability
     * */
    // protected $fillable = [];

    /*
     * Think of this as a BLACKLIST against mass-assignment vulnerability
     * */
    // protected $guarded = [];


    /*
     * The primary key associated with the table.
     * */
    // protected $primaryKey = 'model_id';


    /*
     * The table associated with the model.
     * by convention, the "snake case", plural name of the class will be used as the table name.
     * */
    // protected $table = 'Models'
}
