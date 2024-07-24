@extends('master')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-12 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            {{-- <li class="breadcrumb-item active" aria-current="page">
                                Transaksi
                            </li> --}}
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">All Transaksi</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Transaksi</th>
                                <th>Tanggal</th>
                                <th>Nama Customer</th>
                                <th>Jumlah Barang</th>
                                <th>Sub Total</th>
                                <th>Diskon</th>
                                <th>Ongkir</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_transaction as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->kode }}</td>
                                    <td>{{ $data->tgl }}</td>
                                    <td>{{ $data->m_customer->nama }}</td>
                                    <td>{{ count($data->t_sales_det) }}</td>
                                    <td>@currency($data->subtotal)</td>
                                    <td>@currency($data->diskon)</td>
                                    <td>@currency($data->ongkir)</td>
                                    <td>
                                        <span class="badge bg-success">@currency($data->total_bayar)</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('addon-style')
    <style>
        .dataTable-dropdown {
            display: none;
        }
    </style>
@endpush
@push('addon-script')
    <script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/simple-datatables.js') }}"></script>
@endpush
