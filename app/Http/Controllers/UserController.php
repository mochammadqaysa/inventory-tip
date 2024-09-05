<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Helpers\AuthCommon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Helpers\Utils;

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
            'profile' => 'mimes:jpg,jpeg,png|max:2048',
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        $filename = null;

        if ($request->hasFile('profile')) {
            $file = $request->file('profile');

            // Validate the new file
            $request->validate([
                'profile' => 'mimes:jpg,jpeg,png|max:2048',
            ]);

            // Determine the new file name
            $filename = time() . '.' . $file->getClientOriginalExtension();

            // Delete the old profile image if it exists

            // Save the new file
            // $path = $file->move(public_path('upload'), $filename);

            // Update the form data with the new file name
            $formData['profile_picture'] = $filename;
        }


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
                if ($request->hasFile('profile')) {
                    $path = $file->move(public_path('upload'), $filename);
                }
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
    public function edit(string $uid)
    {
        if ($uid) {
            $data = User::with('role')->where('uid', $uid)->first();
            $body = view('pages.manajemen_user.user.edit', compact('uid', 'data'))->render();
            $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="save()">Save</button>';
            return [
                'title' => 'Edit User',
                'body' => $body,
                'footer' => $footer
            ];
        } else {
            return response([
                'status' => false,
                'message' => 'Failed Connect to Server'
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $uid)
    {
        $formData = $request->except(["_token", "_method"]);
        $user = User::with('role')->where('uid', $uid)->first();
        if ($user) {

            if ($request->hasFile('profile')) {
                $file = $request->file('profile');

                // Validate the new file
                $request->validate([
                    'profile' => 'mimes:jpg,jpeg,png|max:2048',
                ]);

                // Determine the new file name
                $filename = time() . '.' . $file->getClientOriginalExtension();

                // Delete the old profile image if it exists
                if ($user->profile_picture && file_exists(public_path('upload/' . $user->profile_picture))) {
                    unlink(public_path('upload/' . $user->profile_picture));
                }

                // Save the new file
                // $path = $file->move(public_path('upload'), $filename);

                // Update the form data with the new file name
                $formData['profile_picture'] = $filename;
            }
            $formData['role_uid'] = $formData['role'];
            unset($formData['role']);

            $trx = $user->update($formData);
            if ($trx) {
                if ($request->hasFile('profile')) {
                    $file = $request->file('profile');
                    $path = $file->move(public_path('upload'), $formData['profile_picture']);
                }
                return response([
                    'status' => true,
                    'message' => 'Data Berhasil Diubah'
                ], 200);
            } else {
                return response([
                    'status' => true,
                    'message' => 'Data Gagal Diubah'
                ], 400);
            }
        } else {
            return response([
                'status' => false,
                'message' => 'Kesalahan Internal'
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uid)
    {
        try {
            $user = User::with('role')->where('uid', $uid)->first();
            if ($user) {
                $delete = $user->delete();
                if ($delete) {
                    return response()->json([
                        'message' => 'Berhasil Menghapus Data'
                    ]);
                } else {
                    return response()->json([
                        'message' => 'Gagal Menghapus Data'
                    ]);
                }
            } else {
                return response()->json([
                    'message' => 'Gagal Menghapus Data'
                ]);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'message' => 'Data Failed, this data is still used in other modules !'
            ]);
        }
    }
}
