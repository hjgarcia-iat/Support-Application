<?php

namespace App\Http\Controllers;

use App\File;
use App\Http\Requests\FileRequest;
use Storage;

class FilesController extends Controller
{

    public function store(FileRequest $request)
    {
        Storage::disk('s3')->putFile('contact-request', $request->file('file'), 'public');
        $filename = $request->file('file')->hashName();

        //create a new file record
        File::create(['contact_id' => $request->get('id'), 'file' => $filename]);


        return response()->json([
            'success' => true,
            'message' => 'File was uploaded!',
        ]);
    }
}
