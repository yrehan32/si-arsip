@extends('layouts.admin')

@section('title') Detail Arsip Surat @endsection

@section('content')
    <!--start breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Detail Arsip Surat</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0 align-items-center">
                    <li class="breadcrumb-item"><a href="javascript:;">
                            <ion-icon name="home-outline"></ion-icon>
                        </a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">Arsip Surat</li>
                    <li class="breadcrumb-item active" aria-current="page">Lihat</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card radius-10">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tbInfo">
                    <tr>
                        <th style="width: 25%;">Nomor Surat</th>
                        <td style="width: 85%;">{{ $arsip->nomor_surat }}</td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td>{{ $arsip->kategori }}</td>
                    </tr>
                    <tr>
                        <th>Judul</th>
                        <td>{{ $arsip->judul }}</td>
                    </tr>
                    <tr>
                        <th>Waktu Unggah</th>
                        <td>{{ $arsip->created_at }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="card radius-10">
        <div class="card-body">
            <iframe src="{{ '/' . $arsip->file_path . '#toolbar=0&navpanes=0&scrollbar=0'}}" width="100%" height="500">
                This browser does not support PDFs. Please download the PDF to view it: <a href="{{ asset('folder/file_name.pdf') }}">Download PDF</a>
            </iframe>

            <div class="row mt-4 mb-3">
                <div class="col-12">
                    <a href="{{ route('web.arsip-surat.list') }}" class="btn btn-outline-secondary"><i class="lni lni-chevron-left"></i> Kembali</a>
                    <a href="{{route('web.arsip-surat.download', $arsip->id)}}" data-toggle="tooltip" data-original-title="Unduh" class="btn btn-success downloadArsip"><i class="lni lni-download"></i></i>Unduh</a>
                    <button class="btn btn-primary" id="edit-btn"><i class="lni lni-pencil"></i>Edit/Ganti File</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')

<div class="modal fade" id="edit-surat" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="formEdit" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Surat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nomor_surat" class="form-label">Nomor Surat</label>
                        <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" value="{{ $arsip->nomor_surat }}" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select class="form-select" id="kategori" name="kategori" id="kategori">
                            <option value="">-- Pilih Salah Satu --</option>
                            <option value="Undangan">Undangan</option>
                            <option value="Pengumuman">Pengumuman</option>
                            <option value="Nota Dinas">Nota Dinas</option>
                            <option value="Pemberitahuan">Pemberitahuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul" value="{{ $arsip->judul }}" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">File</label>
                        <input class="form-control" type="file" id="file_surat" name="file_surat" accept=".pdf">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
    
@endsection


@section('extra-style')
    
@endsection


@section('extra-script')
    <script>
        $(document).ready(function() {
            // Validator
            var validatorArsip;
            validatorArsip = $("#formEdit").validate({
                focusInvalid: true,
                errorClass: 'is-invalid',
                successClass: 'is-valid',
                rules: {
                    nomor_surat: {
                        required: true
                    },
                    kategori: {
                        required: true
                    },
                    judul: {
                        required: true
                    },
                }
            })

            // Kategori surat option
            var kategoriSurat = "{{ $arsip->kategori }}";
            $('#kategori').val(kategoriSurat);

            // Edit click
            $('#edit-btn').click(function() {
                $('#edit-surat').modal('show');
            });

            // On submit
            $('#formEdit').submit(function(e) {
                e.preventDefault();
                var form = $("#formEdit");

                if (!$(form).valid()) {
                    validatorArsip.focusInvalid();
                    return false;
                }

                var formData = new FormData(this);
                formData.append('_token', '{{ csrf_token() }}');

                $.ajax({
                    url: "{{ route('ajax.arsip-surat.update', $arsip->id) }}",
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        console.log(response);
                        if (response.success) {
                            Swal.fire({
                                title: 'Berhasil',
                                icon: 'success',
                                text: response.message,
                                showConfirmButton: true
                            }).then(() => {
                                location.reload();
                            });
                        }
                    },
                    error: function(response) {
                        console.log(response);
                        Swal.fire({
                            title: 'Gagal',
                            icon: 'error',
                            text: response.responseJSON.message,
                            showConfirmButton: true
                        });
                    }
                });
            });
        });
        
    </script>
@endsection