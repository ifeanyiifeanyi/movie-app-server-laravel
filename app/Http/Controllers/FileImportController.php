<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\Phpword\IOFactory;
use PhpOffice\Phpword\Writer\HTML;
use Illuminate\Support\Facades\Storage;
class FileImportController extends Controller
{
    public function startimport(Request $request){
        $wordFile = IOFactory::load($request->importfile);

        $html = new HTML($wordFile);
        $html->save('content.html');

        $content = readfile('content.html');
        Storage::delete('content.html');
        return response()->json(['data' => $content]);
    }
}
