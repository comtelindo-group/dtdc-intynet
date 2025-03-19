@switch($status)
    @case('Tertarik dengan produk Intynet Starter 10 Mbps')
        <span class="badge badge-success">Tertarik dengan produk Intynet Starter 10 Mbps</span>
    @break
    @case('Tertarik dengan produk Intynet Smart 20 Mbps')
        <span class="badge badge-success">Tertarik dengan produk Intynet Smart 20 Mbps</span>
    @break
    @case('Tertarik dengan produk Intynet Family 30 Mbps')
        <span class="badge badge-success">Tertarik dengan produk Intynet Family 30 Mbps</span>
    @break
    @case('Tertarik dengan produk Intynet Maxima 50 Mbps')
        <span class="badge badge-success">Tertarik dengan produk Intynet Maxima 50 Mbps</span>
    @break
    @case('Hanya taruh brosur')
        <span class="badge badge-danger">Hanya taruh brosur</span>
    @break

    @case('Tidak tertarik')
        <span class="badge badge-warning">Tidak tertarik</span>
    @break

    @default
        <span class="badge badge-secondary">Unknown</span>
@endswitch
