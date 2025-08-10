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
  @include('pages.admin.volunteer.component.modal-image')
  <div class="container-fluid">
    <div class="header-body">
      <div class="row">
        <div class="col-xl-4 col-lg-6">
          <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0">Total Volunteer</h5>
                  <span class="h2 mb-0" id="all">{{$all}} Orang</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-4 col-lg-6">
          <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0">Tidak tertarik</h5>
                  <span class="h2 mb-0" id="notInterest">{{$notInterest}} Orang</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-lg-6">
          <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0">Taruh brosur</h5>
                  <span class="h2 mb-0" id="other">{{$other}} Orang</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br>
  <div class="container-fluid">
    <div class="header-body">
      <div class="row">
        <div class="col-xl-2 col-lg-6">
          <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0">Tertarik</h5>
                  <br>
                  <span class="h2 mb-0" id="interest">{{$interest}} Orang</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-2 col-lg-6">
          <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0">Tertarik 10Mbps</h5>
                  <span class="h2 mb-0" id="interest1">{{ $interest1 }} Orang</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-2 col-lg-6">
          <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0">Tertarik 20Mbps</h5>
                  <span class="h2 mb-0" id="interest2">{{ $interest2 }} Orang</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-2 col-lg-6">
          <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0">tertarik 30Mbps</h5>
                  <span class="h2 mb-0" id="interest3">{{ $interest3 }} Orang</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-2 col-lg-6">
          <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0">Tertarik 50Mbps</h5>
                  <span class="h2 mb-0" id="interest4">{{ $interest4 }} Orang</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-2 col-lg-6">
          <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0">Tertarik 100Mbps</h5>
                  <span class="h2 mb-0" id="interest5">{{ $interest5 }} Orang</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br>
  <div class="container-fluid">
    <div class="header-body">
      <div class="row">
        <div class="col-xl-3 col-lg-6">
          <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0">Pemasangan Banner</h5>
                  <span class="h2 mb-0" id="bannerInstallation">{{ $bannerInstallation ?? 0 }} Orang</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br><br>
  <div class="bg-white shadow p-8 rounded">
    <div class="mb-4 d-flex flex-column flex-md-row justify-content-between align-items-center">
      <h4 class="fw-bolder">List Volunteer</h4>
      <div class="d-flex gap-2">
        <div class="d-flex align-items-center gap-2 gap-lg-4">
          <a href="{{ route('admin.volunteer.map') }}" class="btn btn-flex btn-info btn-sm">
            <i class="fas fa-map fs-4 pe-2"></i>Pemetaan</a>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-4">
          <a href="{{ route('admin.volunteer.export') }}" class="btn btn-flex btn-success btn-sm">
            <i class="fas fa-file-excel fs-4 pe-2"></i>Export</a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4 mb-4">
        <select name="user_id" class="form-select form-select-solid" id="user" data-control="select2">
          <option value="*" selected>Semua SURVEYOR</option>
          @foreach ($users as $data)
            <option value="{{ $data->id }}">{{ $data->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-lg-4 mb-4">
        <select name="status" class="form-select form-select-solid" id="user" data-control="select2">
          <option value="*" selected>Semua Status</option>
          @foreach (\App\Constant::VOLUNTEERS_STATUS as $item)
            <option value="{{ $item }}">{{ $item }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4 mb-4">
        <select name="kelurahan[]" multiple class="form-select form-select-solid" id="kelurahan" data-control="select2"
          data-placeholder="Semua Kelurahan">
          @foreach ($kelurahan as $a)
            <option value="{{ $a }}">{{ $a }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="row">
      {{-- startdate enddate --}}
        <div class="col-lg-4 mb-4">
            <input type="date" name="startdate" class="form-control form-control-solid" id="startdate" placeholder="Start Date">
        </div>
        <div class="col-lg-4 mb-4">
            <input type="date" name="enddate" class="form-control form-control-solid" id="enddate" placeholder="End Date">
        </div>

      <div class="col-lg-4 mb-4">
        <button class="btn btn-sm btn-primary" type="button" id="btn-search">
          <i class="fas fa-search"></i>
        </button>
      </div>
    </div>
    <table class="table align-top table-striped border table-rounded gy-5 dataTable no-footer" id="table"
      aria-describedby="kt_table_jobs_info" style="width: 1202px;">
      <thead>
        <tr class="fw-bold fs-7 text-gray-500 text-uppercase border-bottom-2">
          <th class="w-50px text-center">NO</th>
          {{-- <th>SURVEYOR</th> --}}
          <th>NAMA</th>
          <th>NOMOR HP</th>
          <th>KELURAHAN</th>
          <th>RT</th>
          <th>STATUS</th>
          <th>TANGGAL</th>
          <th>#</th>
        </tr>
      </thead>
      <tbody class="fs-7">
      </tbody>
    </table>
  </div>

  <script>
    const onDelete = (id) => {
      Swal.fire({
        title: 'Delete!',
        text: `Apakah Anda yakin ingin menghapus?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: 'rgb(221, 107, 85)',
        cancelButtonColor: 'gray',
        confirmButtonText: 'Yes, Delete!',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "{{ route('admin.volunteer.delete') }}",
            type: 'POST',
            data: {
              id
            },
            headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(data) {
              Swal.fire({
                title: 'Success',
                text: `${data.message}`,
                icon: 'success',
                confirmButtonColor: 'green',
              });

              $('#table').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
              const data = xhr.responseJSON;
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: data.message,
              });
            }
          });
        }
      });
    };

    $(document).ready(function() {
      $('[data-control="select2"]').val('*').trigger('change');

      $('#table').DataTable({
        processing: true,
        serverSide: true,
        retrieve: true,
        deferRender: true,
        // responsive: false,
        ajax: {
          url: "{{ route('admin.volunteer.table') }}",
          data: function(d) {
            d.user_id = $('[name="user_id"]').val();
            d.status = $('[name="status"]').val();
            d.kelurahan = $('[name="kelurahan[]"]').val();
            d.startdate = $('[name="startdate"]').val();
            d.enddate = $('[name="enddate"]').val();
          }
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
            data: 'status',
            orderable: false,
            searchable: true
          },
          {
            data: 'created_at',
            orderable: false,
            searchable: true
          },
          {
            data: 'action',
            orderable: false,
            searchable: true
          },
        ],
        columnDefs: [{
          targets: [0, 7],
          className: 'text-center',
        }, ],
      });

      $('#btn-search').on('click', function() {
        $('#table').DataTable().ajax.reload();


        $.ajax({
          url: "{{ route('admin.volunteer.statistic') }}",
          type: 'POST',
          data: {
            user_id: $('[name="user_id"]').val(),
            kelurahan: $('[name="kelurahan[]"]').val(),
            startdate: $('[name="startdate"]').val(),
            enddate: $('[name="enddate"]').val()
          },
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          success: function(data) {
            $('#all').text(data.all + " Orang");
            $('#interest').text(data.interest + " Orang");
            $('#notInterest').text(data.notInterest + " Orang");
            $('#other').text(data.other + " Orang");
            $('#interest1').text(data.interest1 + " Orang");
            $('#interest2').text(data.interest2 + " Orang");
            $('#interest3').text(data.interest3 + " Orang");
            $('#interest4').text(data.interest4 + " Orang");
            $('#interest5').text(data.interest5 + " Orang");
            $('#bannerInstallation').text(data.bannerInstallation + " Orang");
          },
          error: function(xhr, status, error) {
            const data = xhr.responseJSON;
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: data.message,
            });
          }
        });
      });
    });
  </script>


@endsection

@section('footer')
  @include('layouts.footer')
@endsection
