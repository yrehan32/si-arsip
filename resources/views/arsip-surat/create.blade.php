@extends('layouts.admin')

@section('title') Tambah Arsip Surat @endsection

@section('content')
    <!--start breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Tambah Arsip Surat</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0 align-items-center">
                    <li class="breadcrumb-item"><a href="javascript:;">
                            <ion-icon name="home-outline"></ion-icon>
                        </a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">Arsip Surat</li>
                    <li class="breadcrumb-item active" aria-current="page">Unggah</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card radius-10">
        <div class="card-body">
            <p>Unggah surat yang telah terbit pada form ini untuk diarsipkan.
                <div class="alert alert-dismissible fade show py-2 border-0 border-start border-4 border-warning">
                    <div class="d-flex align-items-center">
                        <div class="fs-3 text-warning">
                            <ion-icon name="warning-sharp"></ion-icon>
                        </div>
                        <div class="ms-3">
                            <div class="text-warning"><b>Catatan:</b> Gunakan file berformat PDF</div>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </p>
        </div>
    </div>

    <div class="card radius-10">
        <div class="card-body">
            <form class="row g-3" id="formArsip" enctype="multipart/form-data">
                <div class="col-12">
                    <label class="form-label">Nomor Surat</label>
                    <input type="text" class="form-control" name="nomor_surat" id="nomor_surat" autocomplete="off">
                </div>
                <div class="col-12">
                    <label class="form-label">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control">
                        <option value="">-- Pilih Salah Satu --</option>
                        <option value="Undangan">Undangan</option>
                        <option value="Pengumuman">Pengumuman</option>
                        <option value="Nota Dinas">Nota Dinas</option>
                        <option value="Pemberitahuan">Pemberitahuan</option>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label">Judul</label>
                    <input type="text" class="form-control" name="judul" id="judul" autocomplete="off">
                </div>
                <div class="col-12">
                    <label for="formFile" class="form-label">File Surat (PDF)</label>
                    <input class="form-control" type="file" name="file_surat" id="file_surat" accept=".pdf">
                  </div>
                <div class="col-12 mt-5">
                    <a href="{{ route('web.arsip-surat.list') }}" class="btn btn-outline-secondary">Kembali</a>
                    <button type="submit" class="btn btn-success"><i class="lni lni-checkmark-circle"></i>Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('extra-style')
    
@endsection


@section('extra-script')
    <script>
        $(document).ready(function() {
            var validatorArsip;

            validatorArsip = $("#formArsip").validate({
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
                    file_surat: {
                        required: true
                    },
                }
            })

            // Change name
            // $('#file_surat').on('change', function() {
            //     var fileName = $(this).val();
            //     $(this).next('.form-control').html(fileName);
            // })

            // Save surat
            $('#formArsip').on('submit', function(e) {
                e.preventDefault();
                var form = $("#formArsip");

                if (!$(form).valid()) {
                    validatorArsip.focusInvalid();
                    return false;
                } else {
                    var formData = new FormData(this);
                    formData.append('_token', '{{ csrf_token() }}');

                    $.ajax({
                        url: "{{ route('ajax.arsip-surat.store') }}",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: 'Surat berhasil diarsipkan',
                                    showConfirmButton: true
                                }).then(function() {
                                    window.location.href = "{{ route('web.arsip-surat.list') }}";
                                })
                            }
                        },
                        error: function(response) {
                            console.log(response);
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Surat gagal diarsipkan',
                                showConfirmButton: true
                            })
                        }
                    })
                }
            })
        });
    </script>
@endsection