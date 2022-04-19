<?php

namespace App\Http\Livewire;

use App\Models\Group;
use App\Models\State;
use Livewire\Component;

class MapLayout extends Component
{
    public $path_id;
    public $groups;
    public $state;
    public $is_showCard;
    public $selectedDistrict;
    public $group_id;
    public $is_activeTab;

    public function showCard($path_id)
    {
        $state = State::where('state_code', $path_id)->with('groups')->get();
        $this->state = $state->first();
        $this->groups = collect($this->state->groups);
        $this->is_showCard = true;
        $this->selectedDistrict = $this->groups->first();
    }

    public function selectDistrict($group_id)
    {
        $this->groups = collect($this->state->groups);
        $this->selectedDistrict = Group::findOrFail($group_id);
    }

    public function mount()
    {
        $this->state = $this->state;
        $this->is_showCard = false;
        $this->groups = collect([]);
    }

    public function render()
    {
        return view('livewire.map-layout');
    }
}
