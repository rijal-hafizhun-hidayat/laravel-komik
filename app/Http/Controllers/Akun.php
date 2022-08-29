<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelAkun;
use Illuminate\Support\Facades\Hash;

class Akun extends Controller
{
    public function __construct()
    {
        $this->model = new ModelAkun();
    }
    public function index(){
        $data = ModelAkun::select('id', 'username', 'is_admin', 'created_at', 'updated_at')->paginate(3);
        return view('akun/index', compact('data'));
    }

    public function create(){
        return view('akun/create');
    }

    public function store(){
        $model = $this->model->add($this->validation());
        return dd($model);
    }

    public function show($id){
        $data = $this->model->show($id);
        return view('akun/show', compact('data'));
    }

    public function update(Request $request, $id){
        $this->validation();
        if($request->filled('passwordOld') && $request->filled('passwordNew')){
            if($this->syncPss($id)){
                $data = $this->post();
                $model = $this->model->change($id, $data);
                dd($model);
            }
            else{
                return redirect()->route('akun.show', ['id' => $id])->with(['toast' => 'password lama tidak sesuai dengan data kami']);
            }
        }
        else{
            $data = $this->post();
            $model = $this->model->change($id, $data);
            dd($model);
        }
    }

    public function validation(){
        $data = request()->validate(
            [
                'name' => 'required',
                'username' => 'required',
                'password' => 'required',
                'is_admin' => 'required',
            ],
            [
                'name.required' => 'form nama wajib di isi',
                'username.required' => 'form username wajib di isi',
                'password.required' => 'form password wajib di isi',
                'is_admin.required' => 'form role wajib di upload',
            ]
        );

        // $data['remember_token'] = request()->_token;
        // $data['password'] = Hash::make($data['password']);

        return $data;
    }

    public function destroy($id){
        $model = $this->model->hapus($id);
        dd($model);
    }

    public function post(){
        $data = [
            'name' => request()->name,
            'username' => request()->username,
            'password' => request()->passwordNew,
            'is_admin' => request() ->role,
            'remember_token' => request()->_token
        ];

        $data['password'] = Hash::make($data['password']);

        return $data;
    }

    public function syncPss($id){
        $getPass = $this->model->show($id);
        $oldPass = request()->passwordOld;
        
        return password_verify($oldPass, $getPass->password);
    }
}
