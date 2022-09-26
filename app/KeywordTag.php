<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KeywordTag extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'keyword_tags';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
	   'request_id','keyword_id','tag','tag_color','status'
	];


    public static function add_colors_to_tags(){
        $rand = str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
        return  ('#' . $rand);
    }
}