<?php

namespace App\Http\Livewire;

use App\Exports\ApplicationExport;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Application;
use Maatwebsite\Excel\Facades\Excel;

class Applications extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $name,
        $tel, $ic_no, $email, $gander,
        $current_status, $current_institution,
        $get_know_obrien, $funding,
        $programme_id, $academic_term_id,
        $status, $parent_name, $parent_tel,
        $considering_intake, $program;
    public $updateMode = false;

    public function render()
    {
        // auth()->user()->assignRole('super admin');

        $keyWord = '%' . $this->keyWord . '%';
        // $this->keyWord='%' . $this->keyWord . '%';
        // dd(Application::where('status','>',0)->Where(function($query) {
        //     $query->orWhere('name', 'LIKE', $this->keyWord)
        //     ->orWhere('tel', 'LIKE', $this->keyWord)
        //     ->orWhere('ic_no', 'LIKE',$this->keyWord)
        //     ->orWhere('email', 'LIKE', $this->keyWord)
        //     ->orWhere('gander', 'LIKE',$this->keyWord)
        //     ->orWhere('current_status', 'LIKE', $this->keyWord)
        //     ->orWhere('current_institution', 'LIKE', $this->keyWord)
        //     ->orWhere('get_know_obrien', 'LIKE', $this->keyWord)
        //     ->orWhere('funding', 'LIKE',$this->keyWord);
        // })->paginate(10));
        return view('livewire.applications.view', [
            'applications' => Application::latest()->where('status', '>', 0)->Where(function ($query) use ($keyWord) {
                $query->orWhere('name', 'LIKE', $keyWord)
                    ->orWhere('tel', 'LIKE', $keyWord)
                    ->orWhere('ic_no', 'LIKE', $keyWord)
                    ->orWhere('email', 'LIKE', $keyWord)
                    ->orWhere('gander', 'LIKE', $keyWord)
                    ->orWhere('current_status', 'LIKE', $keyWord)
                    ->orWhere('current_institution', 'LIKE', $keyWord)
                    ->orWhere('get_know_obrien', 'LIKE', $keyWord)
                    ->orWhere('funding', 'LIKE', $keyWord);
            })->paginate(10),
        ]);
    }

    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
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
        $this->programme_id = null;
        $this->academic_term_id = null;
        $this->status = null;
        $this->parent_name= null; $this->parent_tel= null;
        $this->considering_intake= null; $this->program= null;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'tel' => 'required', 'ic_no' => 'required',
            'email' => 'required', 'gander' => 'required',
            'current_status' => 'required', 'current_institution' => 'required',
            'get_know_obrien' => 'required', 'funding' => 'required',
            'programme_id' => 'required',
            'academic_term_id' => 'required',
            'parent_tel' => 'required',
            'parent_name' => 'required',
            'considering_intake' => 'required',
            'program' => 'required',

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
            'programme_id' => $this->programme_id,
            'academic_term_id' => $this->academic_term_id,
            'status' => $this->status,
            'parent_tel' => $this->parent_tel,
            'parent_name' => $this->parent_name,
            'considering_intake' => $this->status,
            'program' => $this->status,
        ]);

        $this->resetInput();
        $this->emit('closeModal');
        session()->flash('message', 'Application Successfully created.');
    }

    public function edit($id)
    {
        $record = Application::findOrFail($id);

        $this->selected_id = $id;
        $this->name = $record->name;
        $this->tel = $record->tel;
        $this->ic_no = $record->ic_no;
        $this->email = $record->email;
        $this->gander = $record->gander;
        $this->current_status = $record->current_status;
        $this->current_institution = $record->current_institution;
        $this->get_know_obrien = $record->get_know_obrien;
        $this->funding = $record->funding;
        $this->programme_id = $record->programme_id;
        $this->academic_term_id = $record->academic_term_id;
        $this->status = $record->status;
        $this->parent_tel = $record->status;
        $this->parent_name = $record->status;
        $this->considering_intake = $record->status;
        $this->program = $record->status;

        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'tel' => 'required', 'ic_no' => 'required',
            'email' => 'required', 'gander' => 'required',
            'current_status' => 'required', 'current_institution' => 'required',
            'get_know_obrien' => 'required', 'funding' => 'required',
            'programme_id' => 'required',
            'academic_term_id' => 'required',
            'parent_tel' => 'required',
            'parent_name' => 'required',
            'considering_intake' => 'required',
            'program' => 'required',
        ]);

        if ($this->selected_id) {
            $record = Application::find($this->selected_id);
            $record->update([
                'name' => $this->name,
                'tel' => $this->tel,
                'ic_no' => $this->ic_no,
                'email' => $this->email,
                'gander' => $this->gander,
                'current_status' => $this->current_status,
                'current_institution' => $this->current_institution,
                'get_know_obrien' => $this->get_know_obrien,
                'funding' => $this->funding,
                'programme_id' => $this->programme_id,
                'academic_term_id' => $this->academic_term_id,
                'parent_tel' => $this->status,
                'status' => $this->status,
                'parent_name' => $this->status,
                'considering_intake' => $this->status,
                'program' => $this->status,
            ]);

            $this->resetInput();
            $this->updateMode = false;
            session()->flash('message', 'Application Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Application::where('id', $id);
            $record->delete();
            session()->flash('message', 'Academicterm Successfully deleted.');
        }
    }
    public function export()
    {
        # code...
        return Excel::download(new ApplicationExport($this->sele), 'application.xlsx');
    }
}
