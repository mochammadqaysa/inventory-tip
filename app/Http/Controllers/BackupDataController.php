<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class BackupDataController extends Controller
{
    public function index()
    {
        dd($_SERVER);
        return view('pages.manajemen_data.backup_data.index');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'files' => 'required',
        ]);
        try {
            $uid = $request['uid'];
            $user = User::find($uid);
            $ipAddress = gethostbyname(gethostname());
            // $baseDir = 'C:/Users/kayz/Documents/backup/' . $user->role->name . '/' . $ipAddress . '/';
            $baseDir = '/home/server/backup/' . strtolower($user->role->name) . '/' . $ipAddress . '/';


            // Check if the base directory exists, if not, create it
            if (!is_dir($baseDir)) {
                mkdir($baseDir, 0777, true);
            }
            // dd($_FILES);

            // Loop through the uploaded files in the $_FILES array
            foreach ($_FILES['files']['name'] as $key => $name) {
                // Get the temporary file path
                $tmpFilePath = $_FILES['files']['tmp_name'][$key];

                // Get the original file path with directory structure
                $relativePath = $_FILES['files']['name'][$key];

                $fullPath = $_FILES['files']['full_path'][$key];

                // Full destination path (including folders)
                $destination = $baseDir . $fullPath;

                // Ensure the destination directory exists, if not create it
                $destinationDir = dirname($destination);
                if (!is_dir($destinationDir)) {
                    mkdir($destinationDir, 0777, true);
                }

                // Move the uploaded file to its destination
                $path = move_uploaded_file($tmpFilePath, $destination);
            }
            return response()->json(['message' => 'Berhasil mengupload folder', 'status' => true], 200);
        } catch (\Throwable $th) {
            throw $th;
            return response()->json(['status' => false, 'message' => 'Gagal mengupload folder'], 500);
        }
    }
}
