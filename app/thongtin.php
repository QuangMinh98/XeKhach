<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class thongtin extends Model
{
    protected $table = 'thongtin';
    protected $fillable = [
		    	'tieude',
		    	'tenkhongdau',
		    	'noidung',
		    	'gioithieu'
		    ];
}
