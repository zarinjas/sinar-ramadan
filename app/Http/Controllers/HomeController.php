<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\Group;
use App\Models\Header;
use App\Models\Program;
use App\Models\Billplz\Bill;
use App\Models\Category;
use App\Models\Distribution;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index() 
    {
        $kssbImages = [];
        $kssbVideos = [];
        $tanwirVideos = [];
        $hadisImg = [];
        $hadisProgramId = 0;
        $projekImg = [];
        $projekProgramId = 0;

        $headers = Header::with('thumbnail')->get();
        $kssb = Program::whereSlug('kempen-seorang-sekampit-beras')
                ->with([
                    'gallery', 
                    'gallery.attachment' => function($query) {
                        $query->latest()->limit(6);
                    },
                    'gallery.videos'
                    ])
                ->get();

        if(!$kssb->isEmpty()) {
            $kssbProgramId = $kssb->first()->id;
            if($kssb->first()->gallery) {
                $kssbImages = $kssb->first()->gallery->attachment;
                $kssbVideos = $kssb->first()->gallery->videos;
            }
        }

        $kssbNegeri = Group::isMain(false)->with('thumbnail')->get();

        $kssbPenyaluran = Distribution::with('group')->limit(5)->get();

        $tanwir = Program::whereSlug('bicara-tanwir-ramadan')->with('gallery.videos')->get();

        if(!$tanwir->isEmpty()) {
            $tanwirProgramId = $tanwir->first()->id;
            if($tanwir->first()->gallery) {
                $tanwirVideos = $tanwir->first()->gallery->videos;
            }
        }
        
        $hadis = Program::whereSlug('hadis-hijau-ramadan')->with(['gallery.attachment' => function($query) {
                            $query->limit(4);
                            }])->get();

        if(!$hadis->isEmpty()) {
            $hadisProgramId = $hadis->first()->id;
            if($hadis->first()->gallery) {
                $hadisImg = $hadis->first()->gallery->attachment;  
            } 
        }

        $projek = Program::whereSlug('projek-ramadan')->with('gallery.attachment')->get();

        if(!$projek->isEmpty()) {
            $projekProgramId = $projek->first()->id;
            if($projek->first()->gallery) {
                $projekImg = $projek->first()->gallery->attachment;
            }
        }

        $start = Carbon::now()->subDay(6);
        $end = Carbon::now()->subDay(0);
        $sumbangan = Bill::sumByDays('paid_amount', $start, $end, 'paid_at')->showMinDaysOfWeek()->toChart('KSSB');

        $bookOutSourceCatId = 1;
        $bookOutSource = Book::where('category_id', 1)->with('thumbnail')->get();

        $bookAbimCatId = 2;
        $bookAbim = Book::where('category_id', 2)->with('thumbnail')->get();

        $infaqMain = Group::where('id', 2)->with('thumbnail')->get()->first();
        $kssbMain = Group::where('id', 1)->with('thumbnail')->get()->first();

        return view('public.utama', [
            'headers'            => $headers,
            'sumbangan'          => $sumbangan,
            'kssbProgramId'      => $kssbProgramId,
            'kssbImages'         => $kssbImages,
            'kssbVideos'         => $kssbVideos,
            'tanwirVideos'       => $tanwirVideos,
            'tanwirProgramId'    => $tanwirProgramId,
            'kssbNegeri'         => $kssbNegeri,
            'kssbPenyaluran'     => $kssbPenyaluran,
            'bookOutSource'      => $bookOutSource,
            'bookOutSourceCatId' => $bookOutSourceCatId,
            'bookAbim'           => $bookAbim,
            'bookAbimCatId'      => $bookAbimCatId,
            'infaqMain'          => $infaqMain,
            'kssbMain'           => $kssbMain,
            'hadisImg'           => $hadisImg,
            'hadisProgramId'     => $hadisProgramId,
            'projekImg'          => $projekImg,
            'projekProgramId'    => $projekProgramId
        ]);
    }

    public function galleries($id)
    {
        $program = Program::findOrFail($id);

        return view('public.pages.gallery-page', ['program' => $program]);
    }

    public function videos($id)
    {
        $program = Program::findOrFail($id);

        return view('public.pages.video-page', ['program' => $program]);
    }

    public function penyaluran()
    {
        $penyaluran = Distribution::with('group')->get();

        return view('public.pages.penyaluran-page', ['penyaluran' => $penyaluran]);
    }

    public function book($cat_id)
    {
        $category = Category::findOrFail($cat_id);
        $books = Book::where('category_id', $cat_id)->get();
    
        return view('public.pages.book-page', ['category' => $category, 'books' => $books]);
    }
}
