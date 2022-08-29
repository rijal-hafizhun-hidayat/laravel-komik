<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ModelKomik extends Model
{
    protected $table = 'komik';
    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public function add($data)
    {
        return DB::table('komik')->insert($data);
    }
    public function hapus($id)
    {
        return DB::table('komik')->where('id', $id)->delete();
    }

    public function show($id)
    {
        return DB::table('komik')->find($id);
    }

    public function change($id, $data)
    {
        return DB::table('komik')->where('id', $id)->update($data);
    }
}
