<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ModelAkun extends Model
{
    use HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function add($data){
        return DB::table('users')->insert($data);
    }

    public function hapus($id)
    {
        return DB::table('users')->where('id', $id)->delete();
    }

    public function show($id)
    {
        return DB::table('users')->find($id);
    }

    public function change($id, $data)
    {
        return DB::table('users')->where('id', $id)->update($data);
    }
}
