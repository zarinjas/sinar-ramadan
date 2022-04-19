@extends('public.layouts.page')

@section('content')
<section id="penyaluran-page" class="penyaluran-page mb-3">
    <div class="container">
        <div class="title mb-3">
            <h1 class="fw-semibold fs-4">Semua Penyaluran Bantuan KSSB</h1>
        </div>
        <div class="br-10 shadow p-2">
            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                        <th scope="col">Bil</th>
                        <th scope="col">Daerah/Mukim</th>
                        <th scope="col">Lokasi</th>
                        <th scope="col">Penerima</th>
                        <th scope="col">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $bil = 1;
                        @endphp
                        @foreach ($penyaluran as $item)
                        <tr>
                            <td scope="row">{{ $bil }}</td>
                            <td>{{ $item->group->district }}</td>
                            <td>{{ $item->location }}</td>
                            <td>{{ $item->receiver }}</td>
                            <td>RM {{ $item->distribute_amount }}</td>
                        </tr>
                        @php
                            $bil++;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection