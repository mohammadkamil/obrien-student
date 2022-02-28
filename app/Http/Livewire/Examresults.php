<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Examresult;

class Examresults extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $student_id, $academic_term_id, $subject_id, $mark;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.examresults.view', [
            'examresults' => Examresult::latest()
						->orWhere('student_id', 'LIKE', $keyWord)
						->orWhere('academic_term_id', 'LIKE', $keyWord)
						->orWhere('subject_id', 'LIKE', $keyWord)
						->orWhere('mark', 'LIKE', $keyWord)
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
		$this->student_id = null;
		$this->academic_term_id = null;
		$this->subject_id = null;
		$this->mark = null;
    }

    public function store()
    {
        $this->validate([
		'student_id' => 'required',
		'academic_term_id' => 'required',
		'subject_id' => 'required',
		'mark' => 'required',
        ]);

        Examresult::create([
			'student_id' => $this-> student_id,
			'academic_term_id' => $this-> academic_term_id,
			'subject_id' => $this-> subject_id,
			'mark' => $this-> mark
        ]);

        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Examresult Successfully created.');
    }

    public function edit($id)
    {
        $record = Examresult::findOrFail($id);

        $this->selected_id = $id;
		$this->student_id = $record-> student_id;
		$this->academic_term_id = $record-> academic_term_id;
		$this->subject_id = $record-> subject_id;
		$this->mark = $record-> mark;

        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'student_id' => 'required',
		'academic_term_id' => 'required',
		'subject_id' => 'required',
		'mark' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Examresult::find($this->selected_id);
            $record->update([
			'student_id' => $this-> student_id,
			'academic_term_id' => $this-> academic_term_id,
			'subject_id' => $this-> subject_id,
			'mark' => $this-> mark
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Examresult Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Examresult::where('id', $id);
            $record->delete();            session()->flash('message', 'Academicterm Successfully deleted.');

        }
    }
}
