@extends('layouts.admin')

@section('title') About Author @endsection

@section('content')
    <!--start breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Tentang</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0 align-items-center">
                    <li class="breadcrumb-item"><a href="javascript:;">
                            <ion-icon name="home-outline"></ion-icon>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">About Author</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card radius-10">
        <div class="card-body p-5">
            <div class="row d-flex align-items-center">
                <div class="col-12 col-sm-4 d-flex justify-content-center">
                    <img src="/assets/images/author.jpg" alt="Author" class="img-fluid img-thumbnail radius-10" style="width: 200px;">
                </div>
                <div class="col-12 col-md-8">
                    <p class="lead">Aplikasi ini dibuat oleh:</p>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 30%;">Nama</th>
                                <td style="width: 70%;">Yusuf Rehan</td>
                            </tr>
                            <tr>
                                <th>NIM</th>
                                <td>1931730007</td>
                            </tr>
                            <tr>
                                <th>Tanggal</th>
                                <td>5 Oktober 2022</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('extra-style')
    
@endsection


@section('extra-script')
    <script>
        $(document).ready(function() {
            
        });
    </script>
@endsection