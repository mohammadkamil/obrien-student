<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Prospect;

class Prospects extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $name, $tel, $parent_name, $parent_tel, $program, $consideringintake, $currentstatus, $source, $notes, $status;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.prospects.view', [
            'prospects' => Prospect::latest()
						->orWhere('name', 'LIKE', $keyWord)
						->orWhere('tel', 'LIKE', $keyWord)
						->orWhere('parent_name', 'LIKE', $keyWord)
						->orWhere('parent_tel', 'LIKE', $keyWord)
						->orWhere('program', 'LIKE', $keyWord)
						->orWhere('consideringintake', 'LIKE', $keyWord)
						->orWhere('currentstatus', 'LIKE', $keyWord)
						->orWhere('source', 'LIKE', $keyWord)
						->orWhere('notes', 'LIKE', $keyWord)
						->orWhere('status', 'LIKE', $keyWord)
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
		$this->parent_name = null;
		$this->parent_tel = null;
		$this->program = null;
		$this->consideringintake = null;
		$this->currentstatus = null;
		$this->source = null;
		$this->notes = null;
		$this->status = null;
    }

    public function store()
    {
        $this->validate([
        ]);

        Prospect::create([
			'name' => $this-> name,
			'tel' => $this-> tel,
			'parent_name' => $this-> parent_name,
			'parent_tel' => $this-> parent_tel,
			'program' => $this-> program,
			'consideringintake' => $this-> consideringintake,
			'currentstatus' => $this-> currentstatus,
			'source' => $this-> source,
			'notes' => $this-> notes,
			'status' => $this-> status
        ]);

        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Prospect Successfully created.');
    }

    public function edit($id)
    {
        $record = Prospect::findOrFail($id);

        $this->selected_id = $id;
		$this->name = $record-> name;
		$this->tel = $record-> tel;
		$this->parent_name = $record-> parent_name;
		$this->parent_tel = $record-> parent_tel;
		$this->program = $record-> program;
		$this->consideringintake = $record-> consideringintake;
		$this->currentstatus = $record-> currentstatus;
		$this->source = $record-> source;
		$this->notes = $record-> notes;
		$this->status = $record-> status;

        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
        ]);

        if ($this->selected_id) {
			$record = Prospect::find($this->selected_id);
            $record->update([
			'name' => $this-> name,
			'tel' => $this-> tel,
			'parent_name' => $this-> parent_name,
			'parent_tel' => $this-> parent_tel,
			'program' => $this-> program,
			'consideringintake' => $this-> consideringintake,
			'currentstatus' => $this-> currentstatus,
			'source' => $this-> source,
			'notes' => $this-> notes,
			'status' => $this-> status
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Prospect Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Prospect::where('id', $id);
            $record->delete();
        }
    }
}
