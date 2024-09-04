<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Helpers\AuthCommon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('pages.manajemen_user.user.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $body = view('pages.manajemen_user.user.create')->render();
        $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="save()">Save</button>';

        return [
            'title' => 'Create User',
            'body' => $body,
            'footer' => $footer
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'profile' => 'required|mimes:jpg,jpeg,png|max:2048',
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        $file = $request->file('profile');

        // Menentukan nama file baru (opsional, untuk menghindari nama file yang sama)
        $filename = time() . '.' . $file->getClientOriginalExtension();


        // Menyimpan file ke direktori 'public/upload'
        $data = $request->except('_token', 'profile');
        $pass = bcrypt($data['password']);
        try {
            $trx = User::create([
                'uid' => Str::uuid()->toString(),
                'name' => $data['name'],
                'username' => $data['username'],
                'password' => $pass,
                'role_uid' => $data['role'],
                'active' => '1',
                'profile_picture' => $filename,
                'created_by' => AuthCommon::getUser()->uid
            ]);
            if ($trx) {

                $path = $file->move(public_path('upload'), $filename);
                return response([
                    'status' => true,
                    'message' => 'Berhasil Membuat User'
                ], 200);
            } else {
                return response([
                    'status' => false,
                    'message' => 'Gagal Membuat User'
                ], 400);
            }
        } catch (\Throwable $th) {
            return response([
                'status' => false,
                'message' => 'Terjadi Kesalahan Internal'
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
