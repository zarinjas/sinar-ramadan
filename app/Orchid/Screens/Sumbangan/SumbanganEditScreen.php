<?php

namespace App\Orchid\Screens\Sumbangan;

use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use App\Models\Billplz\Collection;
use App\Models\Billplz\Credential;
use Orchid\Support\Facades\Layout;
use App\View\Components\OrchidCustom\Image;
use App\Orchid\Layouts\Sumbangan\SumbanganEditLayout;
use App\Orchid\Layouts\Sumbangan\SumbanganBillplzLayout;

class SumbanganEditScreen extends Screen
{
    /**
     * @var Collection
     */
    public $collection;

    /**
     * @var Credential
     */
    public $credential;

    /**
     * Query data.
     *
     * @param Collection $collection
     *
     * @return array
     */
    public function query(Collection $collection): iterable
    {
        $collection->load(['credential']);
        return [
            'collection' => $collection,
            'credential' => $collection->credential(),
            'url' => $collection->retina_url,
            'alt' => $collection->collection_title
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->collection->exists ? 'Ubah Sumbangan' : 'Tambah Sumbangan';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('Remove'))
                ->icon('trash')
                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                ->method('remove')
                ->canSee($this->collection->exists),

            Button::make(__('Save'))
                ->icon('check')
                ->method('save')
                ->canSee($this->collection->exists),

            Button::make(__('Sync'))
                ->icon('refresh')
                ->method('sync')
                ->canSee(!$this->collection->exists),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::block(SumbanganEditLayout::class)
                ->title(__('Informasi Billplz'))
                ->description(__('Masukkan id sumbangan (collection id) daripada Account Billplz.</br>
                Rujukan: 
                <a target="_blank" href="https://help.billplz.com/article/55-how-to-get-the-collection-id">
                    https://help.billplz.com/article/55-how-to-get-the-collection-id
                </a>'))
                ->commands([
                    Button::make(__('Save'))
                        ->type(Color::DEFAULT())
                        ->icon('check')
                        ->canSee($this->collection->exists)
                        ->method('save'),

                    Button::make(__('Sync'))
                        ->type(Color::DEFAULT())
                        ->icon('refresh')
                        ->canSee(!$this->collection->exists)
                        ->method('sync'),

                ]),

            Layout::block([Layout::component(Image::class), SumbanganBillplzLayout::class])
                ->title(__('Billplz'))
                ->description(__('Informasi yang diambil dari Billplz'))
                ->canSee($this->collection->exists)
                ->commands([
                    Button::make(__('Save'))
                        ->type(Color::DEFAULT())
                        ->icon('check')
                        ->method('save')
                        ->canSee($this->collection->exists),
                ]),
        ];
    }

    /**
     * @param Collection $collection
     * @param Request    $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Collection $collection, Request $request)
    {
        $request->validate([
            'collection.billplz_collection_id'  => ['required', Rule::unique(Collection::class, 'billplz_collection_id')->ignore($collection)],
            'collection.credential_id'          => ['required', 'integer', Rule::exists('credentials', 'id')]
        ]);

        $collection->fill($request->get('collection'))->save();

        Toast::info(__('Sumbangan diubah'));

        return redirect()->route('platform.sumbangan.list');
    }

    /**
     * @param Collection $collection
     * @param Credential $credential
     * @param Request    $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sync(Collection $collection, Credential $credential, Request $request)
    {
        $request->validate([
            'collection.billplz_collection_id'  => ['required', Rule::unique(Collection::class, 'billplz_collection_id')->ignore($collection)],
            'collection.credential_id'          => ['required', 'integer', Rule::exists('credentials', 'id')]
        ]);

        $credential = $credential->find($request->collection['credential_id']);

        $id = $request->collection['billplz_collection_id'];
        $url = 'https://www.billplz-sandbox.com/api/v3/open_collections/' . $id ;
        $api_key = $credential->api_key;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_USERPWD, $api_key . ":");
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($ch);
        curl_close($ch);

        $bplz_collection = json_decode($response, true);

        $newCollection = Collection::create(
            [
                'billplz_collection_id'     => $bplz_collection['id'], 
                'credential_id'             => $credential->id, 
                'collection_title'          => $bplz_collection['title'], 
                'collection_description'    => $bplz_collection['description'], 
                'retina_url'                => $bplz_collection['photo']['retina_url'], 
                'avatar_url'                => $bplz_collection['photo']['avatar_url'],
            ]
        );
        Toast::info(__('Sumbangan berjaya ditambah'));

        return redirect()->route('platform.sumbangan.edit', $newCollection->id);
    }

    /**
     * @param Collection $collection
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function remove(Collection $collection)
    {
        $collection->delete();

        Toast::info(__('Sumbangan dihapus'));

        return redirect()->route('platform.sumbangan.list');
    }
}
