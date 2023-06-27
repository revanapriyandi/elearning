<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploaderController extends Controller
{
    public function uploads(Request $request)
    {
        if ($request->hasFile('file')) {
            $path = storage_path('app/public/uploads');

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $file = $request->file('file');
            $name = uniqid() . '_' . trim($file->getClientOriginalName());
            $file->move($path, $name);

            return response()->json([
                'name'          => $name,
                'original_name' => $file->getClientOriginalName(),
            ]);
        } else {
            abort(400, 'No file uploaded.');
        }
    }

    public function download($file)
    {
        $path = storage_path('app/public/uploads/' . $file);

        if (file_exists($path)) {
            $headers = [
                'Content-Type' => 'application/octet-stream',
            ];

            return response()->download($path, $file, $headers);
        } else {
            abort(404, 'File not found.');
        }
    }

    public function delete($file)
    {
        $path = storage_path('app/public/uploads/' . $file);

        if (file_exists($path)) {
            unlink($path);
            return response()->json([
                'message' => 'File deleted successfully.',
            ]);
        } else {
            abort(404, 'File not found.');
        }
    }
}
