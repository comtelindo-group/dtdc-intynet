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
        dd(Constant::VOLUNTEERS_STATUS);
        return view('pages.volunteer.create');
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
