<?php

namespace App\Http\Controllers\Admin;

use App\Constant;
use App\Exports\ExportVolunteer;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Volunteer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class VolunteerController extends Controller
{
    public function index()
    {
        $users = User::whereNot('id', auth()->id())->get();
        $kelurahan = ['Lamaru', 'Manggar', 'Manggar Baru', 'Teritip', 'Baru Ilir', 'Baru Tengah', 'Baru Ulu', 'Kariangau', 'Margasari', 'Margo Mulyo', 'Batu Ampar', 'Graha Indah', 'Gunung Samarinda', 'Gunung Samarinda Baru', 'Karang Joang', 'Muara Rapak', 'Gunung Sari Ilir', 'Gunung Sari Ulu', 'Karang Jati', 'Karang Rejo', 'Mekar Sari', 'Sumber Rejo', 'Damai Bahagia', 'Damai Baru', 'Gunung Bahagia', 'Sepinggan', 'Sepinggan Baru', 'Sepinggan Raya', 'Sungai Nangka', 'Damai', 'Klandasan Ilir', 'Klandasan Ulu', 'Prapatan', 'Telaga Sari'];
        $notInterest = Volunteer::where('status', Constant::VOLUNTEERS_STATUS["Tidak tertarik"])->count();
        $other = Volunteer::where('status', Constant::VOLUNTEERS_STATUS["Hanya taruh brosur"])->count();
        $interest1 = Volunteer::where('status', Constant::VOLUNTEERS_STATUS["Tertarik dengan produk Intynet Starter 10 Mbps"])->count();
        $interest2 = Volunteer::where('status', Constant::VOLUNTEERS_STATUS["Tertarik dengan produk Intynet Smart 20 Mbps"])->count();
        $interest3 = Volunteer::where('status', Constant::VOLUNTEERS_STATUS["Tertarik dengan produk Intynet Family 30 Mbps"])->count();
        $interest4 = Volunteer::where('status', Constant::VOLUNTEERS_STATUS["Tertarik dengan produk Intynet Maxima 50 Mbps"])->count();
        $interest5 = Volunteer::where('status', Constant::VOLUNTEERS_STATUS["Tertarik dengan produk Intynet 100 Mbps"])->count();
        $interest = $interest1+$interest2+$interest3+$interest4+$interest5;
        $all = Volunteer::count();
        return view('pages.admin.volunteer.index', compact([
            'users',
            'kelurahan',
            "notInterest",
            "all",
            "other",
            "interest1",
            "interest2",
            "interest3",
            "interest4",
            "interest5",
            "interest",
        ]));
    }

    public function map()
    {
        $volunteers = Volunteer::get();

        return view('pages.admin.volunteer.map', compact('volunteers'));
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ]);

        $volunteer = Volunteer::whereId($request->id);

        if (!$volunteer) {
            return response()->json([
                'code' => 404,
                'status' => 'error',
                'message' => 'Volunteer not found',
            ], 404);
        }

        $volunteer->delete();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => 'Volunteer deleted successfully',
        ]);
    }

    public function export()
    {
        return Excel::download(new ExportVolunteer, 'volunteers.xlsx');
    }

    public function getDatatable(Request $request)
    {
        $query = Volunteer::orderBy('created_at', 'desc');


        if ($request->user_id != '*') {
            $query->where('user_id', $request->user_id);
        }

        if ($request->kelurahan) {
            $query->whereIn('kelurahan', $request->kelurahan);
        }

        if ($request->status != '*') {
            $query->where('status', $request->status);
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('created_at', function ($query) {
                return Carbon::parse($query->created_at)->addHours(3)->format('d-m-Y H:i');
            })
            ->addColumn('status', function ($query) {
                $status = $query->status;
                return view('pages.admin.volunteer.badge', compact('status'));
            })
            ->addColumn('action', function ($query) {
                return view('pages.admin.volunteer.component.menu', compact('query'));
            })
            ->rawColumns(['status'])
            ->addIndexColumn()
            ->make(true);
    }

    public function getStatistic(Request $request)
    {
        $query = Volunteer::query();

        if ($request->user_id != '*') {
            $query->where('user_id', $request->user_id);
        }

        if ($request->kelurahan) {
            $query->whereIn('kelurahan', $request->kelurahan);
        }

        $all = (clone $query)->count();
        $notInterest = (clone $query)->where('status', Constant::VOLUNTEERS_STATUS["Tidak tertarik"])->count();
        $other = (clone $query)->where('status', Constant::VOLUNTEERS_STATUS["Hanya taruh brosur"])->count();
        $interest1 = (clone $query)->where('status', Constant::VOLUNTEERS_STATUS["Tertarik dengan produk Intynet Starter 10 Mbps"])->count();
        $interest2 = (clone $query)->where('status', Constant::VOLUNTEERS_STATUS["Tertarik dengan produk Intynet Smart 20 Mbps"])->count();
        $interest3 = (clone $query)->where('status', Constant::VOLUNTEERS_STATUS["Tertarik dengan produk Intynet Family 30 Mbps"])->count();
        $interest4 = (clone $query)->where('status', Constant::VOLUNTEERS_STATUS["Tertarik dengan produk Intynet Maxima 50 Mbps"])->count();
        $interest5 = (clone $query)->where('status', Constant::VOLUNTEERS_STATUS["Tertarik dengan produk Intynet 100 Mbps"])->count();
        $interest = $interest1+$interest2+$interest3+$interest4+$interest5;


        return response()->json([
            'all' => $all,
            'interest' => $interest,
            'notInterest' => $notInterest,
            'other' => $other,
        ]);
    }
}
