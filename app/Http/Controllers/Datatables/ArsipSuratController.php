<?php

namespace App\Http\Controllers\Datatables;

use App\Http\Controllers\Controller;
use App\Models\ArsipSuratModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ArsipSuratController extends Controller
{
    public function getArsipList(Request $request)
    {
        $model = ArsipSuratModel::query();
        if ($request->has('keyword') && $request->keyword != '') {
            $model = $model->where('judul', 'like', '%' . $request->keyword . '%');
        }

        return DataTables::of($model)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '
                    <a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Hapus" class="btn btn-danger btn-sm deleteArsip">Hapus</a>
                    <a href="' . route('web.arsip-surat.download', $row->id) . '" data-toggle="tooltip" data-original-title="Unduh" class="btn btn-warning btn-sm downloadArsip">Unduh</a>
                    <a href="' . route('web.arsip-surat.show', $row->id) . '" data-toggle="tooltip" data-original-title="Lihat" class="btn btn-primary btn-sm viewArsip">Lihat</a>
                ';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}
