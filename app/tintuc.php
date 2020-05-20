<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tintuc extends Model
{
    protected $table = 'tintuc';
    protected $fillable = [
    	'tieude',
    	'tomtat',
    	'noidung',
    	'luotxem',
    	'img',
    	'tenkhongdau'
    ];
}
