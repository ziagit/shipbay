<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\CitiesImport;
use App\Imports\PostalcodeImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminImportFileController extends Controller
{
    //
    public function importCity(Request $request)
    {
        $file = $request->file('file');
        $import = new CitiesImport;
        $import->import($file);

        if ($import->failures()->isNotEmpty()) {
            return response()->json($import->failures());
        }
        return response()->json(["message" => "File imported successfully!"], 200);
    }

    public function importPostalcode(Request $request)
    {
        $file = $request->file;
        Excel::import(new PostalcodeImport, $file);
        return response()->json(["message"=>"Imported successfully!"],200);
    }
}
