<?php
namespace Packages\MvcSample\Models;

/**
 * @property int $color_id
 * @property string $color_name
 */
class Color extends ModelBase
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'test_schema.color';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'color_id';

    /**
     * @var array
     */
    protected $fillable = ['color_name'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

}
