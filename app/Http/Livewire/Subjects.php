<?php

namespace App\Http\Livewire;

use App\Models\Institution;
use App\Models\Programme;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Subject;

class Subjects extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $name, $code,$institution,$programme,$programme_id;
    public $updateMode = false;
    public function mount()
    {
        $programme =Programme::find(request()->programmeid);

      $this->institution=Institution::find($programme->institution_id);
      $this->programme=$programme;
      $this->programme_id=$programme->id;
        // $this->email = $contact->email;
    }
    public function render()
    {
        // dd($this->programme);
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.subjects.view', [
            'subjects' => Subject::latest()
						->orWhere('name', 'LIKE', $keyWord)
						->orWhere('code', 'LIKE', $keyWord)
						->paginate(10),"institution"=>$this->institution,
                        "programme"=>$this->programme
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
		$this->code = null;
    }

    public function store()
    {
        $this->validate(['name' =>"required",
        'code' => "required"
        ]);

        Subject::create([
			'name' => $this-> name,
			'code' => $this-> code,
            'programme_id'=>$this->programme_id
        ]);

        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Subject Successfully created.');
    }

    public function edit($id)
    {
        $record = Subject::findOrFail($id);

        $this->selected_id = $id;
		$this->name = $record-> name;
		$this->code = $record-> code;

        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate(['name' =>"required",
        'code' => "required"
        ]);

        if ($this->selected_id) {
			$record = Subject::find($this->selected_id);
            $record->update([
			'name' => $this-> name,
			'code' => $this-> code,
            'programme_id'=>$this->programme_id

            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Subject Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Subject::where('id', $id);
            $record->delete();            session()->flash('message', 'Academicterm Successfully deleted.');

        }
    }
}
