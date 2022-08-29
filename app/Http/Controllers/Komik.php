<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ModelKomik;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use PDF;

class Komik extends Controller
{
    public function __construct()
    {
        $this->model = new ModelKomik();
    }

    public function index()
    {
        $data = ModelKomik::select('id', 'nama', 'penulis', 'penerbit', 'gambar')->paginate(3);//combine orm with query builder
        return view('dashbord/index', compact('data'));
    }

    public function create()
    {
        return view('dashbord/create');
    }

    public function show($id)
    {
        //pakai orm
        $data = ModelKomik::find($id);

        return view('dashbord/show', compact('data'));
    }

    public function store()
    {

        $data = $this->post();

        $this->model->add($data);
        //pakai orm
        //ModelKomik::create($data);

        return redirect()->route('komik.index')->with('notif', 'berhasil insert data');
    }

    public function update($id)
    {
        if (request()->hasFile('gambar')) {
            if ($this->destroyImage($id)) {
                $data = $this->postWithImage();
                $this->model->change($id, $data);

                return redirect()->route('komik.index')->with('notif', 'berhasil ubah data');
            }
        } else {
            $data = $this->postWithoutImage();
            $this->model->change($id, $data);

            return redirect()->route('komik.index')->with('notif', 'berhasil ubah data');
        }
    }

    public function destroy($id)
    {
        $path = $this->destroyImage($id);

        if ($path) {
            $this->model->hapus($id);
            return redirect()->route('komik.index')->with('notif', 'berhasil hapus data');
        } else {
            return redirect()->route('komik.index')->with('notif', 'gagal hapus data');
        }
    }

    public function post()
    {
        $data = request()->validate(
            [
                'nama' => 'required',
                'penulis' => 'required',
                'penerbit' => 'required',
                'gambar' => 'required|mimes:jpg,jpeg,png|max:2048'
            ],
            [
                'nama.required' => 'form nama wajib di isi',
                'penulis.required' => 'form penulis wajib di isi',
                'penerbit.required' => 'form penerbit wajib di isi',
                'gambar.required' => 'form gambar wajib di upload',
                'gambar.mimes' => 'ekstensi gambar harus jpg, jpeg, dan png',
                'gambar.max' => 'size gambar tidak boleh melebihi 2mb',
            ]
        );

        $data['gambar'] = request()->file('gambar')->store('images');
        $data['created_at'] = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s')));
        $data['updated_at'] = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s')));

        return $data;
    }

    public function printKomik()
    {
        $encode = base64_encode(file_get_contents('storage/' . ModelKomik::find(1)->gambar));
        $pdf = PDF::loadView('dashbord/print', compact('encode'));

        return $pdf->download('print.pdf');
    }

    public function postWithImage()
    {
        $data = request()->validate(
            [
                'nama' => 'required',
                'penulis' => 'required',
                'penerbit' => 'required',
                'gambar' => 'required|mimes:jpg,jpeg,png|max:2048'
            ],
            [
                'nama.required' => 'form nama wajib di isi',
                'penulis.required' => 'form penulis wajib di isi',
                'penerbit.required' => 'form penerbit wajib di isi',
                'gambar.required' => 'form gambar wajib di upload',
                'gambar.mimes' => 'ekstensi gambar harus jpg, jpeg, dan png',
                'gambar.max' => 'size gambar tidak boleh melebihi 2mb',
            ]
        );

        $data['gambar'] = request()->file('gambar')->store('images');
        $data['updated_at'] = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s')));

        return $data;
    }

    public function postWithoutImage()
    {
        $data = request()->validate(
            [
                'nama' => 'required',
                'penulis' => 'required',
                'penerbit' => 'required',
            ],
            [
                'nama.required' => 'form nama wajib di isi',
                'penulis.required' => 'form penulis wajib di isi',
                'penerbit.required' => 'form penerbit wajib di isi',
            ]
        );

        $data['updated_at'] = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s')));

        return $data;
    }

    public function destroyImage($id)
    {
        $imageDb = $this->model->show($id);

        if (Storage::exists($imageDb->gambar)) {
            Storage::delete($imageDb->gambar);

            return true;
        } else {
            return false;
        }
    }
}
