<?php

namespace App\Http\Livewire;

use App\Models\Alumni;
use App\Models\Student;
use App\Models\TracerStudy as ModelsTracerStudy;
use Livewire\Component;
use Livewire\WithPagination;

class Tracerstudy extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $alumnis_id, $study_status, $current_address, $phone_no, $employer_info, $employer_name, $employer_address, $working_info, $working_status, $working_jobposition, $salary, $futher_study, $student;
    public $updateMode = false;
    public function mount()
    {
        $student = Alumni::with('student.studentprofile', 'student')->find(auth()->user()->alumnis_id);

        $this->student = $student;
        $this->alumnis_id=auth()->user()->alumnis_id;
        // $this->email = $contact->email;
    }
    public function render()
    {
        $tracer = ModelsTracerStudy::with('alumni')->where('alumnis_id', '=', auth()->user()->alumnis_id)->get();
        // dd($tracer);
        $alumni=Alumni::where('id', '=', auth()->user()->alumnis_id)->get()->first();
        // dd($alumni);
        return view('livewire.tracerstudy.view', [
            'tracer' => $tracer,'alumni'=>$alumni
        ]);
    }

    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }

    private function resetInput()
    {
        $this->student_profile_id = null;
        $this->programme_id = null;
        $this->institution_id = null;
        $this->academic_term_id = null;
        $this->campus_id = null;
        $this->status = null;
    }

    public function store()
    {
        $this->validate([
            'study_status' => 'required',
            'current_address' => 'required',
            'phone_no' => 'required|regex:/^\d+$/|min:10',
            'employer_name' => 'required',
            'employer_address' => 'required', 'working_status' => 'required',
            'working_jobposition' => 'required', 'salary' => 'required',
            'futher_study' => 'required',
        ]);
        // $alumnis_id, $study_status, $current_address, $phone_no, $employer_info,$employer_name,$employer_address
        // ,$working_info,$working_status,$working_jobposition,$salary,$futher_study,$student
        ModelsTracerStudy::create([
            'alumnis_id' => $this->alumnis_id,
            'study_status' => $this->study_status,
            'current_address' => $this->current_address,
            'phone_no' => $this->phone_no,
            'employer_name' => $this->employer_name,
            'employer_address' => $this->employer_address,
            'working_status' => $this->working_status,
            'working_jobposition' => $this->working_jobposition,
            'salary' => $this->salary,
            'futher_study' => $this->futher_study,
        ]);

        $this->resetInput();
        $this->emit('closeModal');
        session()->flash('message', 'Student Successfully created.');
    }

    public function edit($id)
    {
        $record = Student::findOrFail($id);

        $this->selected_id = $id;
        $this->student_profile_id = $record->student_profile_id;
        $this->programme_id = $record->programme_id;
        $this->institution_id = $record->institution_id;
        $this->academic_term_id = $record->academic_term_id;
        $this->campus_id = $record->campus_id;
        $this->status = $record->status;

        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'student_profile_id' => 'required',
            'programme_id' => 'required',
            'institution_id' => 'required',
            'academic_term_id' => 'required',
            'campus_id' => 'required',
        ]);

        if ($this->selected_id) {
            $record = Student::find($this->selected_id);
            $record->update([
                'student_profile_id' => $this->student_profile_id,
                'programme_id' => $this->programme_id,
                'institution_id' => $this->institution_id,
                'academic_term_id' => $this->academic_term_id,
                'campus_id' => $this->campus_id,
                'status' => $this->status
            ]);

            $this->resetInput();
            $this->updateMode = false;
            session()->flash('message', 'Student Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Student::where('id', $id);
            $record->delete();
        }
    }
}
