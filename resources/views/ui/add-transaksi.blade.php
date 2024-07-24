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
                            <li class="breadcrumb-item active" aria-current="page">
                                Add Transaksi
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Add Transaksi</h5>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{ route('transaction') }}" method="POST" class="form form-horizontal">
                            @csrf
                            <div class="form-body">
                                <h5 class="col-md-5 p-3 fw-bold fs-5 rounded-3">Transaksi</h5>
                                <div class="row">
                                    <div class="col-md-1 mt-2">
                                        <label for="kode-transaksi">No</label>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <input type="text" id="kode-transaksi" class="form-control" name="kode_transaksi"
                                            placeholder="auto-generate" value="{{ $code_transaction }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-1 mt-2">
                                        <label for="tgl">Tanggal</label>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <input type="date" id="tgl" class="form-control" name="tgl"
                                            value="{{ old('tgl') }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-body mt-3">
                                <h5 class="col-md-5 p-3 fw-bold fs-5 rounded-3">Customer</h5>
                                <div class="row">
                                    <div class="col-md-1 mt-2">
                                        <label for="kode-customer">Kode</label>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <select name="id_customer" id="id-customer" class="form-select" required>
                                            <option value="" disabled
                                                {{ old('id_customer') == '' ? 'selected' : '' }}>
                                                Select Kode Customer</option>
                                            @if (count($list_customer) < 1)
                                                <option value="" disabled>Customer Tidak Ada</option>
                                            @else
                                                @foreach ($list_customer as $customer)
                                                    <option value="{{ $customer->id }}"
                                                        {{ old('id_customer') == $customer->id ? 'selected' : '' }}>
                                                        {{ $customer->kode . ' - ' . $customer->nama }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-1 mt-2">
                                        <label for="nama-customer">Name</label>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <input type="text" id="nama-customer" class="form-control" name="name"
                                            placeholder="name" value="{{ old('name') }}" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-1 mt-2">
                                        <label for="telp-customer">Telp</label>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <input type="text" id="telp-customer" class="form-control" name="telp"
                                            value="{{ old('telp') }}" required>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal"
                                    data-bs-target="#large"><i class="bi bi-plus-square me-1"></i>
                                    Tambah Barang
                                </button>
                            </div>
                            <!-- table bordered -->
                            <div class="table-responsive mt-4">
                                <table class="table table-striped mb-0">
                                    <thead class="text-center">
                                        <tr>
                                            <th colspan="2" rowspan="2" class="border border-2">
                                            </th>
                                            <th rowspan="2" class="border border-2"></th>
                                            <th rowspan="2" class="border border-2"></th>
                                            <th rowspan="2" class="border border-2"></th>
                                            <th rowspan="2" class="border border-2"></th>
                                            <th rowspan="2" class="border border-2"></th>
                                            <th colspan="2" class="border border-2">Diskon</th>
                                            <th rowspan="2" class="border border-2"></th>
                                            <th rowspan="2" class="border border-2"></th>
                                        </tr>
                                    </thead>
                                    <thead class="text-center">
                                        <tr>
                                            <th colspan="2" class="border border-2">Action</th>
                                            <th class="border border-2">No</th>
                                            <th class="border border-2">Kode Barang</th>
                                            <th class="border border-2">Nama Barang</th>
                                            <th class="border border-2">Qty</th>
                                            <th class="border border-2">Harga Bandrol</th>
                                            <th class="border border-2">(%)</th>
                                            <th class="border border-2">(Rp)</th>
                                            <th class="border border-2">Harga Diskon</th>
                                            <th class="border border-2">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!isset($listCart) || empty($listCart))
                                            <tr class="text-center">
                                                <td colspan="11" class="text-center border border-2">data tidak ada</td>
                                            </tr>
                                        @else
                                            @foreach ($listCart as $index => $data)
                                                @php
                                                    $diskon_nilai = ($data->diskon_barang * $data->harga_barang) / 100;
                                                    $harga_diskon =
                                                        $data->harga_barang -
                                                        ($data->diskon_barang * $data->harga_barang) / 100;
                                                    $total =
                                                        ($data->harga_barang -
                                                            ($data->diskon_barang * $data->harga_barang) / 100) *
                                                        $data->qty_barang;
                                                @endphp
                                                <tr class="text-center">
                                                    <td class="border border-2"><button type="button"
                                                            class="btn btn-warning" data-bs-toggle="modal"
                                                            data-bs-target="#ubah{{ $index }}">Ubah</button>
                                                    </td>
                                                    <td class="border border-2">
                                                        <button type="button" class="btn btn-danger"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#hapus{{ $index }}">Hapus</button>
                                                    </td>
                                                    <td class="border border-2">{{ $loop->iteration }}</td>
                                                    <td class="border border-2">{{ $data->kode_barang }}
                                                        <input type="hidden" name="kode[{{ $index }}]"
                                                            value="{{ $data->kode_barang }}">
                                                    </td>
                                                    <td class="border border-2">{{ $data->nama_barang }}
                                                        <input type="hidden" name="id_barang[{{ $index }}]"
                                                            value="{{ $data->id_barang }}">
                                                    </td>
                                                    <td class="border border-2">{{ $data->qty_barang }}
                                                        <input type="hidden" name="qty[{{ $index }}]"
                                                            value="{{ $data->qty_barang }}">
                                                    </td>
                                                    <td class="border border-2">@currency($data->harga_barang)
                                                        <input type="hidden" name="harga_bandrol[{{ $index }}]"
                                                            value="{{ $data->harga_barang }}">
                                                    </td>
                                                    <td class="border border-2">{{ $data->diskon_barang }}%
                                                        <input type="hidden" name="diskon_pct[{{ $index }}]"
                                                            value="{{ $data->diskon_barang }}">
                                                    </td>
                                                    <td class="border border-2">
                                                        @currency($diskon_nilai)
                                                        <input type="hidden" name="diskon_nilai[{{ $index }}]"
                                                            value="{{ $diskon_nilai }}">
                                                    </td>
                                                    <td class="border border-2">
                                                        @currency($harga_diskon)
                                                        <input type="hidden" name="harga_diskon[{{ $index }}]"
                                                            value="{{ $harga_diskon }}">
                                                    </td>
                                                    <td class="border border-2">
                                                        @currency($total)
                                                        <input type="hidden" name="total[{{ $index }}]"
                                                            value="{{ $total }}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-body mt-3">
                                <div class="d-flex gap-5 justify-content-end">
                                    <div class="fw-bold row align-items-center col-md-1 gap-3">
                                        <p>Sub Total</p>
                                        <p>Diskon</p>
                                        <p>Ongkir</p>
                                        <p>Total Bayar</p>
                                    </div>
                                    <div class="fw-bold row align-items-center col-md-2 gap-2">
                                        <p>@currency($sub_total)<input type="hidden" id="sub_total" name="sub_total"
                                                value="{{ $sub_total }}"></p>
                                        <p><input type="number" id="diskon" name="diskon" class="form-control"></p>
                                        <p><input type="number" id="ongkir" name="ongkir" class="form-control"
                                                required></p>
                                        <p id="total"><input type="hidden" id="total_bayar" name="total_bayar"
                                                value="">
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-body mt-3">
                                <div class="d-flex gap-5 justify-content-center">
                                    <button class="btn btn-primary mx-5">Simpan</button>
                                    <a href="{{ route('dashboard') }}" class="btn btn-danger mx-5">Cancel</a>
                                </div>
                            </div>
                        </form>
                        {{-- modal tambah barang --}}
                        <div class="modal fade text-left" id="large" tabindex="-1" role="dialog"
                            aria-labelledby="myModalLabel17" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
                                role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel17">Tambah Barang</h4>
                                        <button type="button" class="close" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('add-to-cart') }}" method="POST"
                                            class="form form-horizontal" id="myForm">
                                            @csrf
                                            <div class="form-body row">
                                                <div class="col-md-2 mt-2">
                                                    <label for="kode-barang">Kode</label>
                                                </div>
                                                <div class="col-md-10 form-group">
                                                    <select name="kode-barang" id="kode-barang" class="form-select">
                                                        <option value="" selected disabled>Select Kode</option>
                                                        @if (count($kode_barang) < 1)
                                                            <option value="" disabled>Barang Tidak Ada</option>
                                                        @endif
                                                        @foreach ($kode_barang as $kode)
                                                            <option value="{{ $kode->kode }}">
                                                                {{ $kode->kode . ' - ' . $kode->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-2 mt-2">
                                                    <label for="nama-barang">Nama Barang</label>
                                                </div>
                                                <div class="col-md-10 form-group">
                                                    <input type="text" id="nama-barang" class="form-control"
                                                        name="nama-barang" placeholder="auto-ke isi after pilih kode">
                                                </div>
                                                <div class="col-md-2 mt-2">
                                                    <label for="harga-barang">Harga Barang</label>
                                                </div>
                                                <div class="col-md-10 form-group">
                                                    <input type="number" id="harga-barang" class="form-control"
                                                        name="harga-barang" placeholder="auto-ke isi after pilih kode">
                                                </div>
                                                <div class="col-md-2 mt-2">
                                                    <label for="qty-barang">Jumlah</label>
                                                </div>
                                                <div class="col-md-10 form-group">
                                                    <input type="number" id="qty-barang" class="form-control"
                                                        name="qty-barang">
                                                </div>
                                                <div class="col-md-2 mt-2">
                                                    <label for="diskon-barang">Diskon (%)</label>
                                                </div>
                                                <div class="col-md-10 form-group">
                                                    <input type="number" id="diskon-barang" class="form-control"
                                                        name="diskon-barang" placeholder="dalam bentuk persen">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary"
                                                    data-bs-dismiss="modal">
                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Close</span>
                                                </button>
                                                <button type="submit" class="btn btn-primary ms-1"
                                                    data-bs-dismiss="modal">
                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Accept</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- modal Hapus barang --}}
                        @if (!(!isset($listCart) || empty($listCart)))
                            @foreach ($listCart as $index => $cart)
                                <div class="modal fade text-left" id="hapus{{ $index }}" tabindex="-1"
                                    role="dialog" aria-labelledby="myModalLabel{{ $index }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myModalLabel{{ $index }}">Hapus Barang
                                                </h5>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('remove-cart-item') }}" method="POST"
                                                    class="form form-horizontal" id="myForm">
                                                    @csrf
                                                    <div class="form-body row">
                                                        <p class="fs-6">Hapus Item No {{ $index + 1 }} ?</p>
                                                        <input type="hidden" name="index"
                                                            value="{{ $index }}">
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light-secondary"
                                                                data-bs-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Tidak</span>
                                                            </button>
                                                            <button type="submit" class="btn btn-primary ms-1"
                                                                data-bs-dismiss="modal">
                                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Yes</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @foreach ($listCart as $index => $cart)
                                {{-- modal ubah barang --}}
                                <div class="modal fade text-left" id="ubah{{ $index }}" tabindex="-1"
                                    role="dialog" aria-labelledby="myModalLabel{{ $index }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel{{ $index }}">Ubah Barang
                                                </h4>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('update-item-cart') }}" method="POST"
                                                    class="form form-horizontal" id="myForm{{ $index }}">
                                                    @csrf
                                                    <div class="form-body row">
                                                        <div class="col-md-2 mt-2">
                                                            <label for="kode-barang">Kode</label>
                                                        </div>
                                                        <div class="col-md-10 form-group">
                                                            <select name="kode-barang" id="kode-barang-update"
                                                                class="form-select">
                                                                <option value="" disabled>Select Kode</option>
                                                                @foreach ($kode_barang as $kode)
                                                                    <option value="{{ $kode->kode }}"
                                                                        @selected($cart->kode_barang == $kode->kode)>
                                                                        {{ $kode->kode . ' - ' . $kode->nama }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2 mt-2">
                                                            <label for="nama-barang">Nama Barang</label>
                                                        </div>
                                                        <div class="col-md-10 form-group">
                                                            <input type="text" id="nama-barang-update"
                                                                class="form-control" name="nama-barang"
                                                                placeholder="auto-ke isi after pilih kode"
                                                                value="{{ $cart->nama_barang }}">
                                                        </div>
                                                        <div class="col-md-2 mt-2">
                                                            <label for="harga-barang">Harga Barang</label>
                                                        </div>
                                                        <div class="col-md-10 form-group">
                                                            <input type="number" id="harga-barang-update"
                                                                class="form-control" name="harga-barang"
                                                                placeholder="auto-ke isi after pilih kode"
                                                                value="{{ $cart->harga_barang }}">
                                                        </div>
                                                        <div class="col-md-2 mt-2">
                                                            <label for="qty-barang{{ $index }}">Jumlah</label>
                                                        </div>
                                                        <div class="col-md-10 form-group">
                                                            <input type="number" id="qty-barang{{ $index }}"
                                                                class="form-control" name="qty-barang"
                                                                value="{{ $cart->qty_barang }}">
                                                        </div>
                                                        <div class="col-md-2 mt-2">
                                                            <label for="diskon-barang{{ $index }}">Diskon
                                                                (%)
                                                            </label>
                                                        </div>
                                                        <div class="col-md-10 form-group">
                                                            <input type="number" id="diskon-barang{{ $index }}"
                                                                class="form-control" name="diskon-barang"
                                                                placeholder="dalam bentuk persen"
                                                                value="{{ $cart->diskon_barang }}">
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="index" value="{{ $index }}">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light-secondary"
                                                            data-bs-dismiss="modal">
                                                            <i class="bx bx-x d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">Cancel</span>
                                                        </button>
                                                        <button type="submit" class="btn btn-primary ms-1">
                                                            <i class="bx bx-check d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">Update</span>
                                                        </button>
                                                    </div>
                                                    <input type="hidden" name="id-barang"
                                                        value="{{ $cart->id_barang }}">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('addon-script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        // Fungsi formatRupiah
        function formatRupiah(angka, prefix) {
            var number_string = angka.toString().replace(/[^,\d]/g, ''),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix === undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
        $(document).ready(function() {
            $('#kode-barang').change(function() {
                let kodeBarang = $(this).val();
                let namaBarang = $('#nama-barang');
                let hargaBarang = $('#harga-barang');

                if (kodeBarang) {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('get-name-price') }}",
                        data: {
                            'kodeBarang': kodeBarang
                        },
                        success: function(res) {
                            if (res) {
                                namaBarang.val("");
                                hargaBarang.val("");
                                $.each(res, function(key, value) {
                                    namaBarang.val(value.nama);
                                    hargaBarang.val(value.harga);
                                });
                            }
                        }
                    })
                }
            });
            $('#id-customer').change(function() {
                let idCustomer = $(this).val();
                let namaCustomer = $('#nama-customer');
                let telpCustomer = $('#telp-customer');

                if (idCustomer) {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('get-name-telp') }}",
                        data: {
                            'idCustomer': idCustomer
                        },
                        success: function(res) {
                            if (res) {
                                namaCustomer.val("");
                                telpCustomer.val("");
                                $.each(res, function(key, value) {
                                    console.log(value);
                                    namaCustomer.val(value.nama);
                                    telpCustomer.val(value.telp);
                                });
                            }
                        }
                    })
                }
            });
            $('#ongkir').change(function() {
                let ongkir = $(this).val();
                let sub_total = $('#sub_total').val();
                let diskon = $('#diskon').val();
                let total_bayar = $('#total_bayar');

                let total_uang = (sub_total - diskon) + parseInt(ongkir);
                let formated_total = formatRupiah(total_uang, 'Rp. ');

                total_bayar.val(total_uang);
                $('#total').append(`<strong>${formated_total}</strong>`)
            });
            $('#kode-barang-update').change(function() {
                let kodeBarang = $(this).val();
                let namaBarang = $('#nama-barang-update');
                let hargaBarang = $('#harga-barang-update');

                if (kodeBarang) {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('get-name-price') }}",
                        data: {
                            'kodeBarang': kodeBarang
                        },
                        success: function(res) {
                            if (res) {
                                namaBarang.val("");
                                hargaBarang.val("");
                                $.each(res, function(key, value) {
                                    namaBarang.val(value.nama);
                                    hargaBarang.val(value.harga);
                                });
                            }
                        }
                    })
                }
            });
        });
    </script>
@endpush
