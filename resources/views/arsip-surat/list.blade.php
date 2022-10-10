@extends('layouts.admin')

@section('title') Daftar Arsip Surat @endsection

@section('content')
    <div class="card radius-10">
        <div class="card-body">
            <h4><i class="lni lni-envelope"></i> Arsip Surat</h4>
            <p>
                Berikut ini adalah surat-surat yang telah terbit dan diarsipkan. <br>
                Klik "Lihat" pada kolom aksi untuk menampilkan surat.
            </p>
        </div>
    </div>

    <div class="card radius-10">
        <div class="card-body">
            <div class="row g-3 align-items-center">
                <div class="col-2">
                    <label for="keyword" class="col-form-label fw-bold">Cari Surat:</label>
                </div>
                <div class="col-8">
                    <input type="text" id="keyword" class="form-control" aria-describedby="searchButton" placeholder="Masukkan judul surat..." autocomplete="off">
                </div>
                <div class="col-2">
                    <span id="searchButton" class="form-text">
                        <button class="btn btn-outline-secondary" id="btnSearch">Cari</button>
                        <button class="btn btn-outline-danger d-none" id="btnReset">Reset</button>
                    </span>
                </div>
            </div>
            <hr>
            <div class="table-responsive">
                <table id="tbArsip" class="table table-striped table-bordered" style="width:100%">

                </table>
            </div>
            <br>
            <a href="{{ route('web.arsip-surat.create') }}" class="btn btn-info text-light"><i class="lni lni-archive"></i>Arsipkan Surat</a>
        </div>
    </div>
@endsection


@section('extra-style')
    
@endsection


@section('extra-script')

    <script src="/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.3/moment.min.js"></script>

    <script>
        $(document).ready(function() {
            var table = null;
            var searchKeyword = null;

            table = $('#tbArsip').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 5,
                ajax: {
                    url: "{{ route('dt-ajax.arsip-surat') }}",
                    type: "GET",
                    dataType: "json",
                    "data": function ( d ) {
                        d._token = "{{ csrf_token() }}",
                        d.keyword = searchKeyword;
                    },
                },
                columns: [
                    {
                        data: 'id',
                        visible: false
                    },
                    {
                        title: 'Nomor Surat',
                        data: 'nomor_surat',
                        name: 'nomor_surat'
                    },
                    {
                        title: 'Kategori',
                        data: 'kategori',
                        name: 'kategori'
                    },
                    {
                        title: 'Judul',
                        data: 'judul',
                        name: 'judul'
                    },
                    {
                        title: 'Waktu Pengarsipan',
                        data: 'created_at',
                        render: function(data, type, row) {
                            return moment(data).format('DD MMMM YYYY');
                        }
                    },
                    {
                        title: "Actions", data: "actions",
                        name: "actions", orderable:false,
                        searchable:false,
                    }
                ],
                order: [[0, 'desc']],
                bFilter: false,
                bLengthChange: false,

            });

            // Search
            $('#btnSearch').click(function() {
                searchKeyword = $('#keyword').val();
                if (searchKeyword != '') {
                    $('#btnReset').removeClass('d-none');
                    table.ajax.reload();
                }
            });

            $('#keyword').keypress(function(e) {
                if(e.which == 13) {
                    searchKeyword = $('#keyword').val();
                    if (searchKeyword != '') {
                        $('#btnReset').removeClass('d-none');
                        table.ajax.reload();
                    }
                }
            });

            // Reset
            $('#btnReset').click(function() {
                searchKeyword = null;
                $('#keyword').val('');
                $('#btnReset').addClass('d-none');
                table.ajax.reload();
            });

            // Delete Arsip
            $(document).on('click', '.deleteArsip', function(e) {
                e.preventDefault();
                var id = $(this).data('id');

                Swal.fire({
                    title: 'Peringatan',
                    text: 'Apakah Anda yakin ingin menghapus arsip surat ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "Ya, hapus!",
                    cancelButtonText: "Batal",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('ajax.arsip-surat.delete') }}",
                            type: 'DELETE',
                            data: {
                                _token: "{{ csrf_token() }}",
                                id: id,
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        title: 'Berhasil',
                                        icon: 'success',
                                        text: response.message,
                                        showConfirmButton: true
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            table.ajax.reload();
                                        }
                                    });
                                }
                            },
                            error: function(response) {
                                console.log(response);
                                Swal.fire({
                                    title: 'Gagal',
                                    icon: 'error',
                                    text: response.message,
                                    showConfirmButton: true
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
    
@endsection