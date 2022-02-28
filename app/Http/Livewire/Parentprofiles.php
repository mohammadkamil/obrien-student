<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Parentprofile;

class Parentprofiles extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $student_id, $name, $contact_no, $address_id, $email;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.parentprofiles.view', [
            'parentprofiles' => Parentprofile::latest()
						->orWhere('student_id', 'LIKE', $keyWord)
						->orWhere('name', 'LIKE', $keyWord)
						->orWhere('contact_no', 'LIKE', $keyWord)
						->orWhere('address_id', 'LIKE', $keyWord)
						->orWhere('email', 'LIKE', $keyWord)
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
		$this->name = null;
		$this->contact_no = null;
		$this->address_id = null;
		$this->email = null;
    }

    public function store()
    {
        $this->validate([
        ]);

        Parentprofile::create([ 
			'student_id' => $this-> student_id,
			'name' => $this-> name,
			'contact_no' => $this-> contact_no,
			'address_id' => $this-> address_id,
			'email' => $this-> email
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Parentprofile Successfully created.');
    }

    public function edit($id)
    {
        $record = Parentprofile::findOrFail($id);

        $this->selected_id = $id; 
		$this->student_id = $record-> student_id;
		$this->name = $record-> name;
		$this->contact_no = $record-> contact_no;
		$this->address_id = $record-> address_id;
		$this->email = $record-> email;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
        ]);

        if ($this->selected_id) {
			$record = Parentprofile::find($this->selected_id);
            $record->update([ 
			'student_id' => $this-> student_id,
			'name' => $this-> name,
			'contact_no' => $this-> contact_no,
			'address_id' => $this-> address_id,
			'email' => $this-> email
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Parentprofile Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Parentprofile::where('id', $id);
            $record->delete();
        }
    }
}
