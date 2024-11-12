<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $table = 'link';
    public $timestamps = false;

    public function data()
    {
        return $this->belongsTo(Data::class, 'data_id');
    }

    public function info()
    {
        return $this->belongsTo(Info::class, 'info_id');
    }
}
