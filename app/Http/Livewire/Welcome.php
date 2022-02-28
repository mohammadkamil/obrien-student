<?php

namespace App\Http\Livewire;

use App\Models\Application;
use Carbon\Carbon;
use Livewire\Component;

class Welcome extends Component
{
    public $name,
        $tel, $ic_no, $email, $gander,
        $current_status, $current_institution,
        $get_know_obrien, $funding;
    public function render()
    {
        return view('livewire.welcome.welcome');
    }
    public function store()
    {
        dd(00);
        $this->validate([
            'name' => 'required',
            'tel' => 'required|regex:/^\d+$/|min:10|max:11', 'ic_no' => 'required|regex:/^\d+$/|min:12|max:12',
            'email' => 'required', 'gander' => 'required',
            'current_status' => 'required', 'current_institution' => 'required',
            'get_know_obrien' => 'required',
            // 'funding' => 'required',
            // 'programme_id' => 'required',
            // 'academic_term_id' => 'required',
            // 'parent_tel' => 'required',
            // 'parent_name' => 'required',
            // 'considering_intake' => 'required',
            // 'program' => 'required',

        ]);

        Application::create([
            'name' => $this->name,
            'tel' => $this->tel,
            'ic_no' => $this->ic_no,
            'email' => $this->email,
            'gander' => $this->gander,
            'current_status' => $this->current_status,
            'current_institution' => $this->current_institution,
            'get_know_obrien' => $this->get_know_obrien,
            'funding' => $this->funding,
            'status' => 0,

            'year' => Carbon::now()->format('Y')
        ]);

        $this->resetInput();
        session()->flash('message', 'Application Successfully created.');
    }
    private function resetInput()
    {
        $this->name = null;
        $this->tel = null;
        $this->ic_no = null;
        $this->email = null;
        $this->gander = null;
        $this->current_status = null;
        $this->current_institution = null;
        $this->get_know_obrien = null;
        $this->funding = null;
    }
}
