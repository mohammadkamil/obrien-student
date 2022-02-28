<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Studentprofile;

class Studentprofiles extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $name, $tel, $ic_no, $email, $gander, $funding, $student_no, $fees,$passport_no;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.studentprofiles.view', [
            'studentprofiles' => Studentprofile::latest()
						->orWhere('name', 'LIKE', $keyWord)
						->orWhere('tel', 'LIKE', $keyWord)
						->orWhere('ic_no', 'LIKE', $keyWord)
						->orWhere('email', 'LIKE', $keyWord)
						->orWhere('gander', 'LIKE', $keyWord)
						->orWhere('funding', 'LIKE', $keyWord)
						->orWhere('student_no', 'LIKE', $keyWord)
						->orWhere('fees', 'LIKE', $keyWord)
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
		$this->name = null;
		$this->tel = null;
		$this->ic_no = null;
		$this->email = null;
		$this->gander = null;
		$this->funding = null;
		$this->student_no = null;
		$this->fees = null;
    }

    public function store()
    {
        $this->validate([
		'name' => 'required',
		'tel' => 'required',
		'ic_no' => 'required','email' => 'required',
		'gander' => 'required',
		'funding' => 'required','student_no' => 'required',
		'fees' => 'required',
        ]);

        Studentprofile::create([
			'name' => $this-> name,
			'tel' => $this-> tel,
			'ic_no' => $this-> ic_no,
			'email' => $this-> email,
			'gander' => $this-> gander,
			'funding' => $this-> funding,
			'student_no' => $this-> student_no,
			'fees' => $this-> fees,
        ]);

        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Studentprofile Successfully created.');
    }

    public function edit($id)
    {
        $record = Studentprofile::findOrFail($id);

        $this->selected_id = $id;
		$this->name = $record-> name;
		$this->tel = $record-> tel;
		$this->ic_no = $record-> ic_no;
		$this->email = $record-> email;
		$this->gander = $record-> gander;
		$this->funding = $record-> funding;
		$this->student_no = $record-> student_no;
		$this->fees = $record-> fees;

        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'programme_id' => 'required',
		'academic_term_id' => 'required',
		'campus_id' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Studentprofile::find($this->selected_id);
            $record->update([
			'name' => $this-> name,
			'tel' => $this-> tel,
			'ic_no' => $this-> ic_no,
			'email' => $this-> email,
			'gander' => $this-> gander,
			'funding' => $this-> funding,
			'student_no' => $this-> student_no,
			'fees' => $this-> fees,
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Studentprofile Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Studentprofile::where('id', $id);
            $record->delete();            session()->flash('message', 'Academicterm Successfully deleted.');

        }
    }
}
