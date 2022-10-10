<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\ArsipSuratModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArsipSuratController extends Controller
{
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'nomor_surat' => 'required',
                'kategori' => 'required',
                'judul' => 'required',
                'file_surat' => 'required|mimes:pdf|max:2048',
            ]);
    
            $arsipSurat = new ArsipSuratModel();
            $arsipSurat->nomor_surat = $request->nomor_surat;
            $arsipSurat->kategori = $request->kategori;
            $arsipSurat->judul = $request->judul;

            // Upload file surat
            $file = $request->file('file_surat');
            $path = 'uploads/arsip-surat';
            $fileName = time().'-'.$file->getClientOriginalName();
            $file->move(public_path($path), $fileName);
            $arsipSurat->file_path = $path.'/'.$fileName;

            $arsipSurat->save();
            
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Arsip Surat berhasil ditambahkan',
                'data' => null
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Arsip Surat gagal ditambahkan'
            ], 500);
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'nomor_surat' => 'required',
                'kategori' => 'required',
                'judul' => 'required',
                'file_surat' => 'mimes:pdf|max:2048',
            ]);
    
            $arsipSurat = ArsipSuratModel::find($request->id);
            $arsipSurat->nomor_surat = $request->nomor_surat;
            $arsipSurat->kategori = $request->kategori;
            $arsipSurat->judul = $request->judul;

            if (!empty($request->file('file_surat'))) {
                // Menghapus file lama
                $oldFile = public_path($arsipSurat->file_path);
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }

                // Upload file surat
                $file = $request->file('file_surat');
                $path = 'uploads/arsip-surat';
                $fileName = time().'-'.$file->getClientOriginalName();
                $file->move(public_path($path), $fileName);
                $arsipSurat->file_path = $path.'/'.$fileName;
            }

            $arsipSurat->save();
            
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Arsip Surat berhasil diubah'
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Arsip Surat gagal diubah',
                'trace' => $th
            ], 500);
        }
    }

    public function delete(Request $request)
    {
        DB::beginTransaction();
        try {
            $arsipSurat = ArsipSuratModel::find($request->id);

            // Delete file arsip surat
            $file = public_path() . '/' . $arsipSurat->file_path;
            if (file_exists($file)) {
                unlink($file);
            }

            // Delete from database
            $arsipSurat->delete();

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Arsip Surat berhasil dihapus',
                'data' => null
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Arsip Surat gagal dihapus'
            ], 500);
        }
    }
}
