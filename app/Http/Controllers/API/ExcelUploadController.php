<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\ExcelUpload;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Exception;

class ExcelUploadController extends Controller
{
    public function upload(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|file|mimes:xlsx,xls'
            ]);

            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('excel_uploads', $filename, 'public');


            $data = Excel::toArray([], $file)[0];


            $headers = array_map('strtolower', $data[0]);
            $user = Auth::user();

            $uploads = [];

            foreach (array_slice($data, 1) as $row) {
                $rowData = array_combine($headers, $row);

                $upload = ExcelUpload::create([
                    'name'        => $rowData['name'] ?? null,
                    'email'       => $rowData['email'] ?? null,
                    'age'         => isset($rowData['age']) ? (int) $rowData['age'] : null,
                    'uploaded_by' => $user ? $user->email : 'guest',
                ]);

                $uploads[] = $rowData;
            }


            $emailBody = "Uploaded Excel Data:\n\n";
            foreach ($uploads as $row) {
                $emailBody .= "- Name: {$row['name']}, Email: {$row['email']}, Age: {$row['age']}\n";
            }

            // Send email to authenticated user
            Mail::raw($emailBody, function ($message) use ($user) {
                $message->to($user->email)
                        ->subject('Excel Upload Summary');
            });

            return response()->json([
                'message' => 'Excel uploaded, parsed, and emailed successfully.',
                'file_id' => $upload->id,
                'data_preview' => array_slice($data, 0, 5)
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Upload failed: ' . $e->getMessage()
            ], 500);
        }
    }

    public function showForm()
    {
        return view('excel.upload');
    }

    public function uploadviauser(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|file|mimes:xlsx,xls'
            ]);

            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('excel_uploads', $filename, 'public');

            $data = Excel::toArray([], $file)[0];
            $headers = array_map('strtolower', $data[0]);
            $user = Auth::user();

            $uploads = [];

            foreach (array_slice($data, 1) as $row) {
                $rowData = array_combine($headers, $row);

                $upload = ExcelUpload::create([
                    'name'        => $rowData['name'] ?? null,
                    'email'       => $rowData['email'] ?? null,
                    'age'         => isset($rowData['age']) ? (int) $rowData['age'] : null,
                    'uploaded_by' => $user ? $user->email : 'guest',
                ]);

                $uploads[] = $rowData;
            }


            $emailBody = "Uploaded Excel Data:\n\n";
            foreach ($uploads as $row) {
                $emailBody .= "- Name: {$row['name']}, Email: {$row['email']}, Age: {$row['age']}\n";
            }

            // Send email to authenticated user
            Mail::raw($emailBody, function ($message) use ($user) {
                $message->to($user->email)
                        ->subject('Excel Upload Summary');
            });

            // Return to a Blade view with success message
            return view('excel.success', [
                'fileName' => $filename,
                'preview' => array_slice($uploads, 0, 5),
                'email' => $user->email,
            ]);
        } catch (Exception $e) {
            return back()->withErrors(['upload_error' => 'Upload failed: ' . $e->getMessage()]);
        }
    }
}
