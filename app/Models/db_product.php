<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use DB;

use Illuminate\Support\Facades\DB;
class db_product extends Model
{
    use HasFactory;

    protected $table = 'products';

    public function getAll(){
        $query = DB::table('db_product')->get();

        $kq = $query;

        return $kq;
    }
}
