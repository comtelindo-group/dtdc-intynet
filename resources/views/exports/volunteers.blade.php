<table>
    <thead>
        <tr>
            <th>
                #
            </th>
            <th>
                TANGGAL
            </th>
            <th>
                SURVEYOR
            </th>
            <th>
                STATUS
            </th>
            <th>
                NAMA
            </th>
            <th>
                NOMOR HP
            </th>
            <th>
                KELURAHAN
            </th>
            <th>
                RT
            </th>
            <th>
                NOMOR RUMAH
            </th>
            <th>
                LATITUDE
            </th>
            <th>
                LONGTIUDE
            </th>
            <th>
                JENIS KELAMIN
            </th>
            <th>
                PROFESI
            </th>
            <th>
                POSISI
            </th>
            <th>
                TOKOH MASYARAKAT
            </th>
            <th>
                JUMLAH DPT
            </th>
            <th>
                Pilihan Calon Walikota
            </th>
            <th>
                Pilihan Calon Gubernur
            </th>
            <th>
                Apakah menerima serangan fajar?
            </th>
            <th>
                Berapa nominal yang di inginkan?
            </th>
            <th>
                PHOTO
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $d)
            <tr>
                <td>
                    {{ $loop->iteration }}
                </td>
                <td>
                    {{ \Carbon\Carbon::parse($d->created_at)->format('d F Y') }}
                </td>
                <td>
                    {{ $d->user->name }}
                </td>
                <td>
                    {{ $d->status }}
                </td>
                <td>
                    {{ $d->families[0]->name }}
                </td>
                <td>
                    {{ $d->families[0]->phone_number }}
                </td>
                <td>
                    {{ $d->kelurahan }}
                </td>
                <td>
                    {{ $d->rt }}
                </td>
                <td>
                    {{ $d->house_number }}
                </td>
                <td>
                    {{ $d->latitude }}
                </td>
                <td>
                    {{ $d->longitude }}
                </td>
                <td>
                    {{ $d->families[0]->gender }}
                </td>
                <td>
                    {{ $d->families[0]->job }}
                </td>
                <td>
                    {{ $d->families[0]->position }}
                </td>
                <td>
                    {{ $d->families[0]->public_figure }}
                </td>
                <td>
                    {{ $d->dpt_count }}
                </td>
                <td>
                    {{ $d->answer1 }}
                </td>
                <td>
                    {{ $d->answer4 }}
                </td>
                <td>
                    {{ $d->answer2 }}
                </td>
                <td>
                    {{ $d->answer3 }}
                </td>
                <td>
                    {{
                        $d->photo ?
                        "https://dtdc.sleeplesslabs.my.id" . asset('storage/volunteer/' . $d->photo)
                        : ""
                    }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
