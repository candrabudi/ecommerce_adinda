@extends('frontpanel.layouts.app')

@section('content')
    <div class="m-0 p-0" id="appContent" style="min-height: 234.016px;">
        <div class="breadcrumb-wrap">
            <div class="container d-flex justify-content-between">
                <ul class="breadcrumb">
                    <li>
                        <i class="bi bi-house-door-fill home-icon"></i>
                        <a href="">Home</a>
                    </li>
                    <li>
                        <a href="/account">Account</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="container">
            <div class="row">
                @include('frontpanel.account.components.side')
                <div class="col-12 col-lg-9">
                    <div class="account-card-box addresses-box">
                        <div class="account-card-title d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Address</span>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addressModal">Add new address</button>
                        </div>
                        <div class="row">
                            @foreach ($addresses as $address)
                                <div class="col-12 col-md-6">
                                    <div class="address-card" data-id="{{ $address->id }}">
                                        <div class="address-card-header">
                                            <h5 class="address-card-title">{{ $address->address_name }}</h5>
                                            <div class="address-card-actions">
                                                <button type="button" class="btn btn-link edit-address" data-id="{{ $address->id }}"
                                                    data-name="{{ $address->address_name }}" data-detail="{{ $address->address_detail }}"
                                                    data-phone="{{ $address->phone_number }}" data-bs-toggle="modal"
                                                    data-bs-target="#editAddressModal">Edit</button>
                                                <button type="button" class="btn btn-link delete-address" data-id="{{ $address->id }}"
                                                    data-bs-toggle="modal" data-bs-target="#deleteAddressModal">Delete</button>
                                            </div>
                                        </div>
                                        <div class="address-card-body">
                                            <p>{{ $address->address_detail }}</p>
                                            <p>{{ $address->province->name }}, {{ $address->regency->name }},
                                                {{ $address->district->name }}, {{ $address->village->name }}</p>
                                            <p>Kode Pos: {{ $address->postal_code }}</p>
                                            <p>Phone: {{ $address->phone_number }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <!-- Modal Edit Address -->
                        <div class="modal fade" id="editAddressModal" tabindex="-1" aria-labelledby="editAddressLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form id="editAddressForm" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editAddressLabel">Edit Alamat</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group mb-4">
                                                <label class="form-label" for="address_name">Nama Alamat</label>
                                                <input type="text" class="form-control" id="editAddressName" name="address_name" required>
                                            </div>
                                            <div class="form-group mb-4">
                                                <label class="form-label" for="address_detail">Detail Alamat</label>
                                                <textarea class="form-control" id="editAddressDetail" name="address_detail" required></textarea>
                                            </div>
                                            <div class="form-group mb-4">
                                                <label class="form-label" for="phone_number">Nomor Telepon</label>
                                                <input type="text" class="form-control" id="editPhoneNumber" name="phone_number" required>
                                            </div>
                                            <!-- Province, Regency, District, Village select inputs -->
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Modal Delete Address -->
                        <div class="modal fade" id="deleteAddressModal" tabindex="-1" aria-labelledby="deleteAddressLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form id="deleteAddressForm" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteAddressLabel">Hapus Alamat</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Apakah Anda yakin ingin menghapus alamat ini?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                // Edit Address Modal
                                document.querySelectorAll('.edit-address').forEach(function (button) {
                                    button.addEventListener('click', function () {
                                        const id = this.getAttribute('data-id');
                                        const name = this.getAttribute('data-name');
                                        const detail = this.getAttribute('data-detail');
                                        const phone = this.getAttribute('data-phone');
                        
                                        document.getElementById('editAddressName').value = name;
                                        document.getElementById('editAddressDetail').value = detail;
                                        document.getElementById('editPhoneNumber').value = phone;
                        
                                        const form = document.getElementById('editAddressForm');
                                        form.setAttribute('action', `/account/addresses/update/${id}`);
                                    });
                                });
                        
                                // Delete Address Modal
                                document.querySelectorAll('.delete-address').forEach(function (button) {
                                    button.addEventListener('click', function () {
                                        const id = this.getAttribute('data-id');
                                        const form = document.getElementById('deleteAddressForm');
                                        form.setAttribute('action', `/account/addresses/destroy/${id}`);
                                    });
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addressModalLabel">Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation address-form mb-4"
                        action="{{ route('frontpanel.account.addresses.store') }}" method="POST" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label class="form-label" for="address_name">Nama Alamat</label>
                                    <input type="text" class="form-control" name="address_name" required
                                        placeholder="Masukkan Nama Alamat">
                                    <span class="invalid-feedback" role="alert">Nama alamat harus diisi</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label class="form-label" for="zip_code">Kode Pos</label>
                                    <input type="text" class="form-control" name="zip_code" required
                                        placeholder="Masukkan Kode Pos">
                                    <span class="invalid-feedback" role="alert">Kode Pos harus diisi</span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label class="form-label" for="phone_number">Nomor Telepon</label>
                                    <input type="text" class="form-control" name="phone_number" required
                                        placeholder="Masukkan Nomor Telepon">
                                    <span class="invalid-feedback" role="alert">Nomor Telepon harus diisi</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label class="form-label" for="province">Provinsi</label>
                                    <select class="form-select" name="province_id" id="province" required>
                                        <option value="">Pilih Provinsi</option>
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="invalid-feedback" role="alert">Provinsi harus dipilih</span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label class="form-label" for="regency">Kabupaten</label>
                                    <select class="form-select" name="regency_id" id="regency" required>
                                        <option value="">Pilih Kabupaten</option>
                                        <!-- Pilihan akan dimuat secara dinamis -->
                                    </select>
                                    <span class="invalid-feedback" role="alert">Kabupaten harus dipilih</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label class="form-label" for="district">Kecamatan</label>
                                    <select class="form-select" name="district_id" id="district" required>
                                        <option value="">Pilih Kecamatan</option>
                                        <!-- Pilihan akan dimuat secara dinamis -->
                                    </select>
                                    <span class="invalid-feedback" role="alert">Kecamatan harus dipilih</span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label class="form-label" for="village">Desa</label>
                                    <select class="form-select" name="village_id" id="village" required>
                                        <option value="">Pilih Desa</option>
                                        <!-- Pilihan akan dimuat secara dinamis -->
                                    </select>
                                    <span class="invalid-feedback" role="alert">Desa harus dipilih</span>
                                </div>
                            </div>
                        </div>

                        <!-- Textarea untuk detail alamat -->
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-4">
                                    <label class="form-label" for="address_detail">Detail Alamat</label>
                                    <textarea class="form-control" name="address_detail" id="address_detail" rows="3" required
                                        placeholder="Masukkan detail alamat, contoh: Nama jalan, blok rumah, nomor rumah, dll."></textarea>
                                    <span class="invalid-feedback" role="alert">Detail alamat harus diisi</span>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary btn-lg form-submit w-50">Kirim</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                // Load regencies when province is selected
                $('#province').on('change', function() {
                    var provinceId = $(this).val();
                    if (provinceId) {
                        $.ajax({
                            url: '/get-regencies/' + provinceId,
                            type: 'GET',
                            dataType: 'json',
                            success: function(data) {
                                $('#regency').empty();
                                $('#regency').append('<option value="">Please Choose</option>');
                                $.each(data, function(key, value) {
                                    $('#regency').append('<option value="' + value.id +
                                        '">' + value.name + '</option>');
                                });
                            }
                        });
                    } else {
                        $('#regency').empty();
                    }
                });

                // Load districts when regency is selected
                $('#regency').on('change', function() {
                    var regencyId = $(this).val();
                    if (regencyId) {
                        $.ajax({
                            url: '/get-districts/' + regencyId,
                            type: 'GET',
                            dataType: 'json',
                            success: function(data) {
                                $('#district').empty();
                                $('#district').append('<option value="">Please Choose</option>');
                                $.each(data, function(key, value) {
                                    $('#district').append('<option value="' + value.id +
                                        '">' + value.name + '</option>');
                                });
                            }
                        });
                    } else {
                        $('#district').empty();
                    }
                });

                // Load villages when district is selected
                $('#district').on('change', function() {
                    var districtId = $(this).val();
                    if (districtId) {
                        $.ajax({
                            url: '/get-villages/' + districtId,
                            type: 'GET',
                            dataType: 'json',
                            success: function(data) {
                                $('#village').empty();
                                $('#village').append('<option value="">Please Choose</option>');
                                $.each(data, function(key, value) {
                                    $('#village').append('<option value="' + value.id +
                                        '">' + value.name + '</option>');
                                });
                            }
                        });
                    } else {
                        $('#village').empty();
                    }
                });
            });
        </script>
    @endpush
@endsection
