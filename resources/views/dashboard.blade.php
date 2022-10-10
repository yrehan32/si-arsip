@extends('layouts.admin')

@section('title') Arsip Surat @endsection

@section('content')
    <!--start breadcrumb-->
    {{-- <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Arsip Surat</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0 align-items-center">
                    <li class="breadcrumb-item"><a href="javascript:;">
                            <ion-icon name="home-outline"></ion-icon>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Arsip Surat</li>
                </ol>
            </nav>
        </div>
    </div> --}}
    <!--end breadcrumb-->


    <div class="card radius-10">
        <div class="card-body">
            <h4>Arsip Surat</h4>
            <p>
                Berikut ini adalah surat-surat yang telah terbit dan diarsipkan. <br>
                Klik "Lihat" pada kolom aksi untuk menampilkan surat.
            </p>
        </div>
    </div>

    <div class="card radius-10">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nomor Surat</th>
                            <th>Kategori</th>
                            <th>Judul</th>
                            <th>Waktu Pengarsipan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>XX</td>
                            <td>XX</td>
                            <td>XX</td>
                            <td>XX</td>
                            <td>XX</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


@section('extra-style')
    
@endsection


@section('extra-script')

    <script src="/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            var table = null;
            var searchKeyword = null;


            table = $('#tbArsip').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('dt-ajax.arsip-surat) }}",
                    type: "GET",
                    dataTypa: "JSON",
                    data: function (d) {
                        d._token = "{{ csrf_token() }}",
                        d.keyword = searchKeyword
                    }
                },
                columns: [
                    {
                        data: "nomor_surat",
                        name: "nomor_surat",
                    },
                    {
                        data: "kategori",
                        name: "kategori"
                    },
                    {
                        data: "judul",
                        name: "judul"
                    },
                    {
                        data: "created_at",
                        name: "created_at"
                    },
                    {
                        data: "actions",
                        name: "actions"
                    },
                ],
            });
        });
    </script>
    
@endsection