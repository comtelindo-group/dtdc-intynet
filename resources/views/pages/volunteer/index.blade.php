@extends('layouts.app')

@section('page-title', 'Volunteer')
@section('page-subtitle', 'List')

@section('navbar')
    @include('layouts.navbar')
@endsection


@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('content')
    <div class="bg-white shadow p-8 rounded">
        <div class="mb-4 d-flex flex-column flex-md-row justify-content-between align-items-center">
            <h4 class="fw-bolder">List Volunteer</h4>
            <div class="d-flex gap-2">
                <div class="d-flex align-items-center gap-2 gap-lg-4">
                    <a href="{{ route('volunteer.create') }}" class="btn btn-flex btn-info btn-sm">
                        <i class="fas fa-plus fs-4 pe-2"></i> Volunteer</a>
                </div>
            </div>
        </div>
        <table class="table align-top table-striped border table-rounded gy-5 dataTable no-footer" id="table"
            aria-describedby="kt_table_jobs_info" style="width: 1202px;">
            <thead>
                <tr class="fw-bold fs-7 text-gray-500 text-uppercase border-bottom-2">
                    <th class="w-50px text-center">NO</th>
                    <th>NAMA</th>
                    <th>NOMOR HP</th>
                    <th>KELURAHAN</th>
                    <th>RT</th>
                    <th>NO</th>
                    <th>STATUS</th>
                    <th>TANGGAL</th>
                    {{-- <th>#</th> --}}
                </tr>
            </thead>
            <tbody class="fs-7">
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                retrieve: true,
                deferRender: true,
                // responsive: false,
                ajax: {
                    url: "{{ route('volunteer.table') }}",
                },
                language: {
                    "emptyTable": "Tidak ada data terbaru 📁",
                    "zeroRecords": "Data tidak ditemukan 😞",
                },
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        orderable: false,
                        searchable: true
                    },
                    {
                        data: 'phone_number',
                        orderable: false,
                        searchable: true
                    },
                    {
                        data: 'kelurahan',
                        orderable: false,
                        searchable: true
                    },
                    {
                        data: 'rt',
                        orderable: false,
                        searchable: true
                    },
                    {
                        data: 'house_number',
                        orderable: false,
                        searchable: true
                    },
                    {
                        data: 'status',
                        orderable: false,
                        searchable: true
                    },
                    {
                        data: 'created_at',
                        orderable: false,
                        searchable: true
                    },
                ],
                columnDefs: [{
                    targets: [0],
                    className: 'text-center',
                }, ],
            });
        });
    </script>
@endsection

@section('footer')
    @include('layouts.footer')
@endsection
