@extends('layouts.app')

@section('page-title', 'Volunteer')
@section('page-subtitle', 'Tambah')

@section('navbar')
    @include('layouts.navbar')
@endsection


@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('content')
    <div class="bg-white shadow p-8 rounded">
        <div class="mb-4 d-flex flex-column flex-md-row justify-content-between align-items-center">
            <h4 class="fw-bolder">Tambah Volunteer</h4>
        </div>

        <form id="form_add_volunteer" style="height: 90%" class="d-flex flex-column justify-content-between"
            enctype="multipart/form-data">
            @csrf
            <div class="overflow-auto px-6 py-4" id="kt_form_drawer_messenger_body">
                <h3>Data Rumah</h3>
                <input type="text" name="latitude" hidden>
                <input type="text" name="longitude" hidden>

                <div class="mb-3 d-flex flex-column gap-2 px-4">
                    <label for="name" class="">Nama</label>
                    <input type="text" autocomplete="off" name="name" class="form-control form-control-solid border"
                        id="name">
                </div>

                <div class="mb-3 d-flex flex-column gap-2 px-4">
                    <label for="phone_number" class="">Nomor WA</label>
                    <input type="text" autocomplete="off" name="phone_number" class="form-control form-control-solid border"
                        id="phone_number">
                </div>

                <div class="mb-3 d-flex flex-column gap-2 px-4">
                    <label for="name" class="required">Foto Rumah</label>
                    <input type="file" autocomplete="off" name="photo" class="form-control form-control-solid border"
                        id="foto_rumah" required>
                </div>

                {{-- <div class="mb-3 d-flex flex-column gap-2 px-4">
                    <label for="name">Nomor Rumah</label>
                    <input type="text" autocomplete="off" name="house_number"
                        class="form-control form-control-solid border" id="name" >
                </div>

                <div class="mb-3 d-flex flex-column gap-2 px-4">
                    <label for="name" class="required">RT</label>
                    <input type="text" autocomplete="off" name="rt" class="form-control form-control-solid border"
                        id="job" required>
                </div>

                <div class="mb-3 d-flex flex-column gap-2 px-4">
                    <label for="name" class="required">Kelurahan</label>
                    <select name="kelurahan" id="kelurahan" class="form-select form-select-solid" data-control="select2" required>
                        <option value="" selected>Pilih Kelurahan</option>
                        @foreach (['Lamaru', 'Manggar', 'Manggar Baru', 'Teritip', 'Baru Ilir', 'Baru Tengah', 'Baru Ulu', 'Kariangau', 'Margasari', 'Margo Mulyo', 'Batu Ampar', 'Graha Indah', 'Gunung Samarinda', 'Gunung Samarinda Baru', 'Karang Joang', 'Muara Rapak', 'Gunung Sari Ilir', 'Gunung Sari Ulu', 'Karang Jati', 'Karang Rejo', 'Mekar Sari', 'Sumber Rejo', 'Damai Bahagia', 'Damai Baru', 'Gunung Bahagia', 'Sepinggan', 'Sepinggan Baru', 'Sepinggan Raya', 'Sungai Nangka', 'Damai', 'Klandasan Ilir', 'Klandasan Ulu', 'Prapatan', 'Telaga Sari'] as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>
                </div> --}}

                <div class="mb-3 d-flex flex-column gap-2 px-4">
                    <label for="name" class="required">Status</label>
                    <select name="status" class="form-select form-select-solid" data-control="select2" required>
                        <option value="" selected>Pilih Jawaban</option>
                        @foreach (\App\Constant::VOLUNTEERS_STATUS as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3 d-flex flex-column gap-2 px-4">
                    <label for="name" class="">Catatan</label>
                    <input type="text" autocomplete="off" name="note"
                        class="form-control form-control-solid border" id="job">
                </div>

                <hr>

                {{-- <button class="btn btn-success" type="button" data-kt-element="Save" id="add_family">
                    Tambah Anggota
                </button> --}}
            </div>
            <div class="d-flex flex-stack align-items-center justify-content-end p-4">
                <button class="btn btn-primary" type="submit" data-kt-element="Save">
                    Simpan
                </button>
            </div>
        </form>
    </div>

    <script>
        function showPosition(position) {
            // latitude = position.coords.latitude;
            // longitude = position.coords.longitude;
            $('input[name="latitude"]').val(position.coords.latitude);
            $('input[name="longitude"]').val(position.coords.longitude);
        }

        $(document).ready(function() {
            (() => {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                } else {
                    alert("Nyalakan GPS anda");
                }
            })();


            $('#form_add_volunteer').on('submit', function(e) {
                e.preventDefault();

                $('#form_add_volunteer').find('button[type="submit"]').prop('disabled', true);
                $('#form_add_volunteer').find('button[type="submit"]').html(
                    '<div class="spinner-border text-light" role="status"></div>'
                )

                let formData = new FormData(this);

                $.ajax({
                    url: "{{ route('volunteer.store') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#form_add_volunteer').find('button[type="submit"]').prop('disabled',
                            false);
                        $('#form_add_volunteer').find('button[type="submit"]').html(
                            'Simpan'
                        )
                        $('#form_add_volunteer').trigger('reset');
                        $('#kt_form_drawer_close').click();
                        toastr.success(response.message, 'Selamat 🚀 !');

                        setTimeout(() => {
                            window.location.href = "{{ route('volunteer.index') }}"
                        }, 1000);
                    },
                    error: function(xhr) {
                        $('#form_add_volunteer').find('button[type="submit"]').prop('disabled',
                            false);
                        $('#form_add_volunteer').find('button[type="submit"]').html(
                            'Simpan'
                        )
                        toastr.error(xhr.responseJSON.message, 'Oops !');
                    },
                });
            });
        });
    </script>
@endsection

@section('footer')
    @include('layouts.footer')
@endsection
