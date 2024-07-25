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
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">All Customer</h5>
                    <hr>
                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambah"><i
                            class="bi bi-plus-square me-2"></i>Tambah</button>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>Kode Customer</th>
                                <th>Nama Customer</th>
                                <th>No Telphone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($all_customer as $index => $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->kode }}</td>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->telp }}</td>
                                    <td>
                                        <button class="btn btn-outline-danger me-3" data-bs-toggle="modal"
                                            data-bs-target="#delete{{ $index }}">
                                            <i class="bi bi-trash me-2"></i>Hapus
                                        </button> |
                                        <button class="btn btn-outline-warning ms-3" data-bs-toggle="modal"
                                            data-bs-target="#update{{ $index }}">
                                            <i class="bi bi-pencil-square me-2"></i>Edit
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- modal tambah --}}
                    <div class="modal fade text-left" id="tambah" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel17" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel17">Tambah Barang</h4>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('store-customer') }}" method="POST"
                                        class="form form-horizontal">
                                        @csrf
                                        <div class="col-md-2">
                                            <label for="kode-barang">Kode Customer</label>
                                        </div>
                                        <div class="col-md-10 form-group">
                                            <input type="text" id="kode-barang" class="form-control" name="kode"
                                                value="{{ $code_customer }}">
                                        </div>
                                        <div class="col-md-2 mt-2">
                                            <label for="nama-customer">Nama Customer</label>
                                        </div>
                                        <div class="col-md-10 form-group">
                                            <input type="text" id="nama-customer" class="form-control" name="nama">
                                        </div>
                                        <div class="col-md-2 mt-2">
                                            <label for="telp-customer">Telphone</label>
                                        </div>
                                        <div class="col-md-10 form-group mb-4">
                                            <input type="text" id="telp-customer" class="form-control" name="telp">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Cancel</span>
                                            </button>
                                            <button type="submit" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Tambah</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- modal edit --}}
                    @foreach ($all_customer as $index => $data)
                        <div class="modal fade text-left" id="update{{ $index }}" tabindex="-1" role="dialog"
                            aria-labelledby="myModalLabel{{ $index }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
                                role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel{{ $index }}">Update Barang</h4>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('update-customer', ['customer' => $data->id]) }}"
                                            method="POST" class="form form-horizontal"
                                            id="updateForm{{ $index }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="col-md-2">
                                                <label for="kode-customer">Kode Customer</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="kode-customer" class="form-control"
                                                    name="kode" value="{{ $data->kode }}" disabled>
                                            </div>
                                            <div class="col-md-2 mt-2">
                                                <label for="nama-customer">Nama Customer</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="nama-customer" class="form-control"
                                                    name="nama" value="{{ $data->nama }}">
                                            </div>
                                            <div class="col-md-2 mt-2">
                                                <label for="telp-customer">Telphone</label>
                                            </div>
                                            <div class="col-md-10 form-group mb-4">
                                                <input type="text" id="telp-customer" class="form-control"
                                                    name="telp" value="{{ $data->telp }}">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary"
                                                    data-bs-dismiss="modal">
                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Cancel</span>
                                                </button>
                                                <button type="submit" class="btn btn-primary ms-1"
                                                    data-bs-dismiss="modal">
                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Update</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- modal delete --}}
                    @foreach ($all_customer as $index => $data)
                        <div class="modal fade text-left" id="delete{{ $index }}" tabindex="-1" role="dialog"
                            aria-labelledby="myModalLabel{{ $index }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md"
                                role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel{{ $index }}">Delete Barang</h4>
                                        <button type="button" class="close" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Apakah anda yakin ingin menghapus Barang ?</p>
                                        <form action="{{ route('delete-customer', ['customer' => $data->id]) }}"
                                            method="POST" class="form form-horizontal"
                                            id="updateForm{{ $index }}">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary"
                                                    data-bs-dismiss="modal">
                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Cancel</span>
                                                </button>
                                                <button type="submit" class="btn btn-danger ms-1"
                                                    data-bs-dismiss="modal">
                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Hapus</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
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
