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
                STATUS
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
                    {{ \Carbon\Carbon::parse($d->created_at)->addHours(8)->format('d F Y') }}
                </td>
                <td>
                    {{ $d->user->name ?? "" }}
                </td>
                <td>
                    {{ $d->name }}
                </td>
                <td>
                    {{ $d->phone_number }}
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
