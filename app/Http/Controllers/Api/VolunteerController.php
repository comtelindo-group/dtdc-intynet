<?php

namespace App\Http\Controllers\Api;

use App\Constant;
use App\Http\Controllers\Controller;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VolunteerController extends Controller
{
    public function get(Request $request)
    {
        $count = $request->query('count', 10);
        $page = $request->query('page', 1);

        $volunteers = Volunteer::with(['user', 'families'])
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate($count, ['*'], 'page', $page);

        return response()->json([
            "code" => 200,
            "status" => "success",
            "message" => "Volunteer retrieved successfully",
            "data" => $volunteers->items(),
            "meta" => [
                "itemCounts" => $count,
                "currentPage" => $page,
                "totalItems" => $volunteers->total(),
                "totalPages" => $volunteers->lastPage(),
            ],
        ]);
    }

    public function create(Request $request)
    {
        $request->validate(
            [
                'phone_number' => 'nullable|string',
                'house_number' => 'nullable|string',
                'rt' => 'nullable|string',
                'photo' => 'nullable|image',
                'latitude' => 'required|string',
                'longitude' => 'required|string',
                'kelurahan' => 'nullable|string',
                'status' => 'nullable|in:' . implode(',', Constant::VOLUNTEERS_STATUS),
                'family' => 'required|array',
                'family.*.name' => 'required|string',
                'family.*.age' => 'nullable|string',
                'family.*.position' => 'required|string',
                'family.*.job' => 'nullable|string',
                'family.*.gender' => 'required|string',
                'family.*.phone_number' => 'nullable|string',
                'answer1' => 'nullable|string',
                'answer2' => 'nullable|string',
                'answer3' => 'nullable|string',
                'answer4' => 'nullable|string',
                'note' => 'nullable|string',
            ],
            [
                'latitude.required' => 'Lokasi anda tidak ditemukan, silahkan coba lagi',
                'longitude.required' => 'Lokasi anda tidak ditemukan, silahkan coba lagi',

                'phone_number.required' => 'Telepon harus diisi',
                'phone_number.unique' => 'Telepon sudah terdaftar',

                'house_number.string' => 'Nomor rumah harus berupa string',

                'rt.string' => 'RT harus berupa string',

                'photo.image' => 'Foto harus berupa gambar',

                'latitude.string' => 'Latitude harus berupa string',

                'longitude.string' => 'Longitude harus berupa string',

                'kelurahan.string' => 'Kelurahan harus berupa string',

                'status.in' => 'Status harus salah satu dari ' . implode(', ', Constant::VOLUNTEERS_STATUS),

                'family.array' => 'Keluarga harus berupa array',
                'family.*.name.required' => 'Nama keluarga harus diisi',
                'family.*.position.required' => 'Posisi keluarga harus diisi',
                'family.*.gender.required' => 'Jenis kelamin keluarga harus diisi',
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
            'phone_number' => $request->phone_number,
            'house_number' => $request->house_number,
            'rt' => $request->rt,
            'photo' => $filename,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'kelurahan' => $request->kelurahan,
            'status' => $request->status,
            'answer1' => $request->answer1,
            'answer2' => $request->answer2,
            'answer3' => $request->answer3,
            'answer4' => $request->answer4,
            'dpt_count' => $request->dpt_count,
            'note' => $request->note,
        ]);

        foreach ($request->family as $family) {
            $volunteer->families()->create([
                'name' => $family['name'] ?? null,
                'age' => $family['age'] ?? null,
                'position' => $family['position'] ?? null,
                'job' => $family['job'] ?? null,
                'gender' => $family['gender'] ?? null,
                'phone_number' => $family['phone_number'] ?? null,
                'public_figure' => $family['public_figure'] ?? null,
            ]);
        }

        DB::commit();

        return response()->json([
            "code" => 200,
            "status" => "success",
            "message" => "Volunteer registered successfully",
            "data" => $volunteer,
        ]);
    }
}
