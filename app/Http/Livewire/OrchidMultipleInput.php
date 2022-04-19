<?php

namespace App\Http\Livewire;

use App\Models\VideoGallery;
use Livewire\Component;

class OrchidMultipleInput extends Component
{
    public $inputs = [];
    public $video_i = 1;
    public $gallery;
    public $gallery_name;
    public $videos;
    public $video_name;

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function add($video_i)
    {
        $video_i = $video_i + 1;
        $this->video_i = $video_i;
        array_push($this->inputs ,$video_i);
    }

    public function remove($key)
    {
        if(isset($this->videos[$key]['id'])) {
            $video = VideoGallery::findOrfail($this->videos[$key]['id']);
            $video->delete();
            unset($this->inputs[$key], $this->videos[$key]);
        }
        else {
            unset($this->inputs[$key], $this->videos[$key]);
        }
    }

    public function mount() {
        $this->gallery = $this->gallery;
        $this->videos = collect($this->gallery->videos);

        $count = count($this->videos); // get total contact person count
        $count -= 1;
        //add count as array
        for ($i=0; $i <= $count ; $i++) { 
            $this->inputs[] = $i;
        }

        if($count < 0) {
            $count = 0;
            $this->inputs = [0];
        }
    }

    public function render()
    {
        return view('livewire.orchid-multiple-input');
    }
}
