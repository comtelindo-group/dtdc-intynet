<?php

namespace App\Exports;

use App\Models\Volunteer;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ExportVolunteer implements FromView, WithEvents
{
    public function view(): View
    {
        return view('exports.volunteers', [
            'data' => Volunteer::all()
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:Z1')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ]
                ]);

                $event->sheet->getColumnDimension('A')->setWidth(5);
                $event->sheet->getColumnDimension('B')->setWidth(20);
                $event->sheet->getColumnDimension('C')->setWidth(10);
                $event->sheet->getColumnDimension('D')->setWidth(20);
                $event->sheet->getColumnDimension('E')->setWidth(20);
                $event->sheet->getColumnDimension('F')->setWidth(20);
                $event->sheet->getColumnDimension('G')->setWidth(20);
                $event->sheet->getColumnDimension('H')->setWidth(20);
                $event->sheet->getColumnDimension('I')->setWidth(20);
                $event->sheet->getColumnDimension('J')->setWidth(20);
                $event->sheet->getColumnDimension('K')->setWidth(20);
                $event->sheet->getColumnDimension('L')->setWidth(20);
                $event->sheet->getColumnDimension('M')->setWidth(20);
                $event->sheet->getColumnDimension('N')->setWidth(20);
            }
        ];
    }
}
