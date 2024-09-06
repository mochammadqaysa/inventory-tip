<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.dashboard.admin');
    }

    public function upload(Request $request)
    {
        $baseDir = 'C:/Users/kayz/Documents/backup/upload/';

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
            if (move_uploaded_file($tmpFilePath, $destination)) {
                echo "Successfully uploaded {$relativePath} to {$destination}<br>";
            } else {
                echo "Failed to upload {$relativePath}<br>";
            }
        }
        return response()->json(['message' => 'Folder and files uploaded successfully', 'status' => true]);
    }
}
