<?php

namespace App\Http\Livewire;

use App\Models\Alumni;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Surveyansweredstudent;
use Livewire\Component;
use Livewire\WithPagination;

class Survey extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord,$programme_id, $subject_id, $a1, $a2, $a3, $a4, $b1, $b2, $b3, $c1, $c2, $c3, $c4, $d1, $d2, $d3, $e1, $e2, $e3, $student,$subjectname;
    public $updateMode = false;
    public function mount()
    {
        $student = Alumni::with('student.studentprofile', 'student')->find(auth()->user()->alumnis_id);

        $this->student = $student;
        $this->programme_id =$this->student->student->programme_id;
        // $this->email = $contact->email;
    }
    public function render()
    {
        // dd($this->student);
        $keyWord = '%' . $this->keyWord . '%';
        return view('livewire.survey.view', [
            'subject' => Subject::with('lecturer', 'survey','surveybystudent')->where('programme_id','=',$this->student->student->programme_id)
                ->paginate(10),
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
        $this->a1 = null;
        $this->a2 = null;
        $this->a3 = null;
        $this->a4 = null;
        $this->b1 = null;
        $this->b2 = null;
        $this->b3 = null;
        $this->c1 = null;
        $this->c2 = null;
        $this->c2 = null;
        $this->c3 = null;
        $this->c4 = null;
        $this->d1 = null;
        $this->d2 = null;
        $this->d3 = null;
        $this->e1 = null;
        $this->e2 = null;
        $this->e3 = null;
    }
    public function surversubjectid($subject_id)
    {
        $this->selected_id=$subject_id;
        $subject=Subject::find($subject_id);
        $this->subjectname=$subject->name;
    }
    public function survey()
    {
        // dd(1);
        $this->validate([
            'a1' => 'required',
            'a2' => 'required',
            'a3' => 'required',
            'a4' => 'required',
            'b1' => 'required',
            'b2' => 'required',
            'b3' => 'required',
            'c1' => 'required',
            'c2' => 'required',
            'c3' => 'required',
            'c4' => 'required',
            'd1' => 'required',
            'd2' => 'required',
            'd3' => 'required',
            'e1' => 'required',
            'e2' => 'required',
            'e3' => 'required',

        ]);
        Surveyansweredstudent::create([
            'alumnis_id'=>auth()->user()->alumnis_id,
            'subject_id'=>$this->selected_id,
            'programme_id'=>$this->student->student->programme_id,
            'a1' => $this->a1,
            'a2' => $this->a2,
            'a3' => $this->a3,
            'a4' => $this->a4,
            'b1' => $this->b1,
            'b2' => $this->b2,
            'b3' => $this->b3,
            'c1' => $this->c1,
            'c2' => $this->c2,
            'c3' => $this->c3,
            'c4' => $this->c4,
            'd1' => $this->d1,
            'd2' => $this->d2,
            'd3' => $this->d3,
            'e1' => $this->e1,
            'e2' => $this->e2,
            'e3' => $this->e3,
        ]);

        $this->resetInput();
        $this->emit('closeModalSurvey');



        session()->flash('message', 'Survey have successfully submit.');
    }
    public function store()
    {
        $this->validate([
            'a1' => 'required',
            'a2' => 'required',
            'a3' => 'required',
            'a4' => 'required',
            'b1' => 'required',
            'b2' => 'required',
            'b3' => 'required',
            'c1' => 'required',
            'c2' => 'required',
            'c3' => 'required',
            'c4' => 'required',
            'd1' => 'required',
            'd2' => 'required',
            'd3' => 'required',
            'e1' => 'required',
            'e2' => 'required',
            'e3' => 'required',

        ]);

        Student::create([
            'student_profile_id' => $this->student_profile_id,
            'programme_id' => $this->programme_id,
            'institution_id' => $this->institution_id,
            'academic_term_id' => $this->academic_term_id,
            'campus_id' => $this->campus_id,
            'status' => 0
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
