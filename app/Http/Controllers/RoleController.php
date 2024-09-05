<?php

namespace App\Http\Controllers;

use App\DataTables\RolesDataTable;
use App\Helpers\Utils;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(RolesDataTable $dataTable)
    {
        return $dataTable->render('pages.manajemen_user.role.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $body = view('pages.manajemen_user.role.create')->render();
        $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="save()">Save</button>';

        return [
            'title' => 'Create Role',
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
            'name' => 'required',
        ]);
        $data = $request->except('_token');
        $slug = Utils::formatSlug($data['name']);
        try {
            $trx = Role::create([
                'uid' => Str::uuid()->toString(),
                'name' => $data['name'],
                'slug' => $slug,
                'description' => $data['description'],
            ]);
            if ($trx) {
                return response([
                    'status' => true,
                    'message' => 'Berhasil Membuat Role'
                ], 200);
            } else {
                return response([
                    'status' => false,
                    'message' => 'Gagal Membuat Role'
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
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        if ($role) {
            $uid = $role->uid;
            $data = $role;
            $body = view('pages.manajemen_user.role.edit', compact('uid', 'data'))->render();
            $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="save()">Save</button>';
            return [
                'title' => 'Edit Role',
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
    public function update(Request $request, Role $role)
    {
        $formData = $request->except(["_token", "_method"]);

        $formData['slug'] = Utils::formatSlug($formData['name']);
        $trx = $role->update($formData);
        if ($trx) {
            return response([
                'status' => true,
                'message' => 'Data Berhasil Diubah'
            ], 200);
        } else {
            return response([
                'status' => false,
                'message' => 'Data Gagal Diubah'
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        try {
            $delete = $role->delete();
            if ($delete) {
                return response()->json([
                    'message' => 'Berhasil Menghapus Data'
                ]);
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

    public function select2(Request $request)
    {
        $request->validate([
            'limit' => 'required',
            'page' => 'required'
        ]);

        $limit = $request->limit;
        $start = $limit * $request->page;
        $term = isset($request->term) ? $request->term : '';

        $roles = Role::all();
        if ($start) {
            $roles->skip($start);
        }

        if ($limit) {
            $roles->take($limit);
        }

        if ($term != '' && $term) {
            $roles = Role::where('name', 'like', '%' . $term . '%')->skip($start)->take($limit)->get();
        }

        $run = DataTables::of($roles)->addColumn('id', function ($role) {
            $uid = $role->uid;
            return (string) $uid; // Explicitly cast to string
        })->make(true);
        $decode = json_encode($run);
        $encode = json_decode($decode, true);

        $res['items'] = [];
        $res['total'] = 0;
        if (count($roles) > 0) {
            $res['items'] = $encode['original']['data'];
            $res['total'] = $encode['original']['recordsFiltered'];
        }
        return $res;
    }
}
