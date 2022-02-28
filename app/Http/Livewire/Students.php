<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Student;

class Students extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $student_profile_id, $programme_id, $institution_id, $academic_term_id, $campus_id,$status;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.students.view', [
            'students' => Student::latest()
						->orWhere('student_profile_id', 'LIKE', $keyWord)
						->orWhere('programme_id', 'LIKE', $keyWord)
						->orWhere('institution_id', 'LIKE', $keyWord)
						->orWhere('academic_term_id', 'LIKE', $keyWord)
						->orWhere('campus_id', 'LIKE', $keyWord)
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
    }

    public function store()
    {
        $this->validate([
		'student_profile_id' => 'required',
		'programme_id' => 'required',
		'institution_id' => 'required',
		'academic_term_id' => 'required',
		'campus_id' => 'required',
        ]);

        Student::create([
			'student_profile_id' => $this-> student_profile_id,
			'programme_id' => $this-> programme_id,
			'institution_id' => $this-> institution_id,
			'academic_term_id' => $this-> academic_term_id,
			'campus_id' => $this-> campus_id,
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
		$this->student_profile_id = $record-> student_profile_id;
		$this->programme_id = $record-> programme_id;
		$this->institution_id = $record-> institution_id;
		$this->academic_term_id = $record-> academic_term_id;
		$this->campus_id = $record-> campus_id;
		$this->status = $record-> status;

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
			'student_profile_id' => $this-> student_profile_id,
			'programme_id' => $this-> programme_id,
			'institution_id' => $this-> institution_id,
			'academic_term_id' => $this-> academic_term_id,
			'campus_id' => $this-> campus_id,
			'status' => $this-> status
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
