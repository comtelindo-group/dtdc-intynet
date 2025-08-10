<?php

namespace App\Http\Controllers;

use App\Constant;
use App\Models\Volunteer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Calculation\DateTimeExcel\Constants;
use Yajra\DataTables\Facades\DataTables;

class VolunteerController extends Controller
{
    public function index()
    {
        return view('pages.volunteer.index');
    }

    public function create()
    {
<<<<<<< HEAD
        // if user city = Bontang
        if (Auth::user()->city == 'Balikpapan') {
            $kelurahan = ['Lamaru', 'Manggar', 'Manggar Baru', 'Teritip', 'Baru Ilir', 'Baru Tengah', 'Baru Ulu', 'Kariangau', 'Margasari', 'Margo Mulyo', 'Batu Ampar', 'Graha Indah', 'Gunung Samarinda', 'Gunung Samarinda Baru', 'Karang Joang', 'Muara Rapak', 'Gunung Sari Ilir', 'Gunung Sari Ulu', 'Karang Jati', 'Karang Rejo', 'Mekar Sari', 'Sumber Rejo', 'Damai Bahagia', 'Damai Baru', 'Gunung Bahagia', 'Sepinggan', 'Sepinggan Baru', 'Sepinggan Raya', 'Sungai Nangka', 'Damai', 'Klandasan Ilir', 'Klandasan Ulu', 'Prapatan', 'Telaga Sari'];
        } else if (Auth::user()->city == 'Bontang') {
            $kelurahan = [
                "Api-Api",
                "Bontang Baru",
                "Bontang Kuala",
                "Guntung",
                "Gunung Elai",
                "Lok Tuan",
                "Berbas Pantai",
                "Berbas Tengah",
                "Bontang Lestari",
                "Satimpo",
                "Tanjung Laut",
                "Tanjung Laut Indah",
                "Belimbing",
                "Kanaan",
                "Telihan"
            ];
        } else {
            $kelurahan = [
                'Lamaru',
                'Manggar',
                'Manggar Baru',
                'Teritip',
                'Baru Ilir',
                'Baru Tengah',
                'Baru Ulu',
                'Kariangau',
                'Margasari',
                'Margo Mulyo',
                'Batu Ampar',
                'Graha Indah',
                'Gunung Samarinda',
                'Gunung Samarinda Baru',
                'Karang Joang',
                'Muara Rapak',
                'Gunung Sari Ilir',
                'Gunung Sari Ulu',
                'Karang Jati',
                'Karang Rejo',
                'Mekar Sari',
                'Sumber Rejo',
                'Damai Bahagia',
                'Damai Baru',
                'Gunung Bahagia',
                'Sepinggan',
                'Sepinggan Baru',
                'Sepinggan Raya',
                'Sungai Nangka',
                'Damai',
                'Klandasan Ilir',
                'Klandasan Ulu',
                'Prapatan',
                'Telaga Sari',
                "Api-Api",
                "Bontang Baru",
                "Bontang Kuala",
                "Guntung",
                "Gunung Elai",
                "Lok Tuan",
                "Berbas Pantai",
                "Berbas Tengah",
                "Bontang Lestari",
                "Satimpo",
                "Tanjung Laut",
                "Tanjung Laut Indah",
                "Belimbing",
                "Kanaan",
                "Telihan"
            ];
        }
        return view('pages.volunteer.create', compact('kelurahan'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'photo' => 'nullable|image',
                'name' => 'nullable|string',
                'phone_number' => 'nullable|string',
                'house_number' => 'nullable|string',
                'rt' => 'nullable|string',
                'kelurahan' => 'nullable|string',
                'latitude' => 'required|string',
                'longitude' => 'required|string',
                'answer1' => 'nullable|string',
                'answer2' => 'nullable|string',
                'answer3' => 'nullable|string',
                'answer4' => 'nullable|string',
                'note' => 'nullable|string',
                'status' => 'nullable|in:' . implode(',', Constant::VOLUNTEERS_STATUS),
            ],
            [
                'photo.image' => 'Foto harus berupa gambar',

                'latitude.required' => 'Lokasi anda tidak ditemukan, silahkan coba lagi',
                'longitude.required' => 'Lokasi anda tidak ditemukan, silahkan coba lagi',

                'phone_number.unique' => 'Telepon sudah terdaftar',

                'house_number.string' => 'Nomor rumah harus berupa text',

                'rt.string' => 'RT harus berupa text',

                'kelurahan.string' => 'Kelurahan harus berupa string',

                'status.in' => 'Status harus salah satu dari ' . implode(', ', Constant::VOLUNTEERS_STATUS),
            ]
        );

        DB::beginTransaction();

        $filename = null;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . "_house_" . $file->getClientOriginalName();
            $file->storeAs('volunteer', $filename, 'public');
        }

        $volunteer = Volunteer::create([
            'user_id' => auth()->user()->id,
            'photo' => $filename,
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'house_number' => $request->house_number,
            'rt' => $request->rt,
            'kelurahan' => $request->kelurahan,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'status' => $request->status,
            'answer1' => $request->answer1,
            'answer2' => $request->answer2,
            'answer3' => $request->answer3,
            'answer4' => $request->answer4,
            'note' => $request->note,
        ]);

        DB::commit();

        return response()->json([
            "code" => 200,
            "status" => "success",
            "message" => "Volunteer registered successfully",
            "data" => $volunteer,
        ]);
    }

    public function getDatatable()
    {
        $query = Volunteer::get();

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('status', function ($query) {
                $status = $query->status;
                return view('pages.admin.volunteer.badge', compact('status'));
            })
            ->addColumn('created_at', function ($query) {
                return Carbon::parse($query->created_at)->addHours(3)->format('d-m-Y H:i');
            })
            ->rawColumns(['status'])
            ->addIndexColumn()
            ->make(true);
    }
}
