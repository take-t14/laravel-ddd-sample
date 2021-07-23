<?php
namespace Packages\MvcSample\Models;

/**
 * @property int $size_id
 * @property string $size_name
 */
class Size extends ModelBase
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'test_schema.size';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'size_id';

    /**
     * @var array
     */
    protected $fillable = ['size_name'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

}
