<?php

namespace App\Http\Controllers;

use App\Models\ArsipSuratModel;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function arsipSuratList()
    {
        return view('arsip-surat.list');
    }

    public function about()
    {
        return view('about');
    }

    public function arsipSuratCreate()
    {
        return view('arsip-surat.create');
    }

    public function arsipSuratShow(Request $request)
    {
        $arsip = ArsipSuratModel::find($request->id);
        $data = [
            'arsip' => $arsip
        ];

        return view('arsip-surat.show', $data);
    }

    public function arsipSuratDownload(Request $request)
    {
        $arsip = ArsipSuratModel::find($request->id);
        $file = public_path() . '/' . $arsip->file_path;
        $headers = array(
            'Content-Type: application/pdf',
        );
        return response()->download($file, $arsip->judul . '.pdf', $headers);
    }
}
