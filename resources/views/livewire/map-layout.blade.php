<div>
    <div class="container">
        <div class="title">
            <h2 class="fw-semibold fs-5 mb-0">Lokasi KSSB Negeri & Daerah</h2>
        </div>
        <div class="map-container">
            @include('public.partials.map')
            <h3 class="text-center small mt-3 mx-3">*Kedudukan peta Malaysia ini telah diubah sedikit bagi memberi pengalaman visual yang optimum</h3>
        </div>
    </div>
    <div wire:ignore class="map-modal-container"></div>

    <div class="map-card-container mw-32 {{ ($is_showCard) ? 'show' : '' }}">
        <div class="bar"></div>
        <div class="map-card bg-white p-4 d-flex flex-column">
            <div class="card-title">
                <span class="text-yellow fw-semibold">Kempen Seorang Sekampit Beras</span>
                <h4 class="fw-light">{{ ($state) ? $state->state_name : ''}}</h4>
            </div>
            <div class="splide tab-splide">
                <div class="card-tab d-flex align-items-center splide__track">
                    <ul class="mukim-tab-container list-unstyled mb-0 splide__list">
                        @foreach ($groups as $key => $group)
                        <li class="mukim-tab-item splide__slide">
                            <a wire:click.prevent="selectDistrict({{ $group->id }})" class="fw-light {{ ($selectedDistrict->id == $group->id) ? 'active' : '' }}" href="#">{{ $group->district }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="content h-100">
                <div class="text p-2 h-100">
                    @if ($groups->isNotEmpty())
                    {{ $is_activeTab }}
                    <div class="mb-3 px-2 bb-grey">
                        <div class="text-title small fw-semibold">Alamat Pengumpulan</div>
                        <p class="small">{{ $selectedDistrict->address }}</p>
                    </div>
                    <div class="mb-3 px-2 bb-grey">
                        <div class="text-title small fw-semibold">No. Perhubungan</div>
                        <div class="small">
                            <ul>
                                @foreach ($selectedDistrict->contacts as $contact)
                                <li>{{ $contact->contact_no }} <span class="fst-italic">({{ $contact->contact_name }})</span></li> 
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="mb-3 px-2 bb-grey">
                        <div class="text-title small fw-semibold">Butiran Akaun Bank</div>
                        <div class="small">
                            <ul>
                                @foreach ($selectedDistrict->accounts as $account)
                                <li>{{ $account->account_no }} <span class="fst-italic">({{ $account->account_bank }})</span></li> 
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="mb-3 px-2 bb-grey">
                        <div class="text-title small fw-semibold">Pautan Pembayaran atas talian</div>
                        <p class="small"><a class="text-yellow" href="{{ $groups->first()->group_url }}">{{ $groups->first()->group_url }}</a></p>
                    </div>
                    @else
                    <div class="d-flex align-items-center justify-content-center h-100">
                        <p class="text-center">Tiada Maklumat</p>
                    </div>
                    @endif
                </div>
                <div wire:loading.delay wire:target="selectDistrict" class="tab-loading align-items-center justify-content-center h-100 w-100">
                    <div class="h-100 w-100" id="loading-section">
                        <div class="loading">
                            <div class="loading-dot"></div>
                            <div class="loading-dot"></div>
                            <div class="loading-dot"></div>
                            <div class="loading-dot"></div>
                            <div class="loading-dot"></div>
                            <div class="loading-dot"></div>
                            <div class="loading-dot"></div>
                            <div class="loading-dot"></div>
                            <div class="loading-dot"></div>
                            <div class="loading-dot"></div>
                            <div class="loading-dot"></div>
                            <div class="loading-dot"></div>
                            <div class="loading-dot"></div>
                            <div class="loading-dot"></div>
                            <div class="loading-dot"></div>
                            <div class="loading-dot"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div wire:ignore class="button-container my-3 d-flex justify-content-center mt-auto">
                <a wire:ignore class="map-card-button btn" role="button">Kembali</a>
            </div>
        </div>
    </div>
</div>
