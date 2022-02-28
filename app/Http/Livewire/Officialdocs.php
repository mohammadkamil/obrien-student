<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Officialdoc;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class Officialdocs extends Component
{
    use WithPagination;
    use WithFileUploads;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $name, $url,$files;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.officialdocs.view', [
            'officialdocs' => Officialdoc::latest()
						->orWhere('name', 'LIKE', $keyWord)
						// ->orWhere('url', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }

    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
    public function updatedFile()
    {
        $this->validate([
            'file' => 'mimes:pdf,doc,docx,xlsx,xls|max:2002400', // 20MB Max
        ]);
    }
    private function resetInput()
    {
		$this->name = null;
		$this->url = null;
		$this->files = null;
    }

    public function store()
    {
        $this->validate([
             'name' => 'required',
        'files' => 'required',

        ]);
        // $filename=$this->files->storeAs('officialdocs', 'public_upload');
        // $filename = $this->files->store('officialdocs', 'public');
        $filename=strtolower(str_replace(' ', '', $this->name));
        $name =$filename.'.'.$this->files->extension();

        $this->files->storeAs('officialdocs', $name);
        // Storage::disk('livewire-tmp')->allFiles();
            Storage::deleteDirectory('livewire-tmp');

        // $this->file->store('officialdocs');
        Officialdoc::create([
			'name' => $this-> name,
			'url' => $name
        ]);

        $this->resetInput();
		$this->emit('closeModal');
        $this->files = null;
		session()->flash('message', 'Officialdoc Successfully created.');
    }

    public function edit($id)
    {
        $record = Officialdoc::findOrFail($id);

        $this->selected_id = $id;
		$this->name = $record-> name;
		$this->url = null;
		// $this->file = null;

        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([ 'name' => 'required',
        'file' => 'required',
        ]);


        if ($this->selected_id) {

			$record = Officialdoc::find($this->selected_id);
            $name=$record->url;
            if($this->url!=null){
                Storage::delete('officialdocs/' . $record->url);

                $filename = strtolower(str_replace(' ', '', $this->name));
                $name = $filename . '.' . $this->ufilel->extension();

                $this->file->storeAs('officialdocs', $name);
                    Storage::deleteDirectory('livewire-tmp');

            }
            $record->update([
			'name' => $this-> name,
			'url' => $name
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Officialdoc Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Officialdoc::where('id', $id)->get();
        // dd($record);
            Storage::delete('officialdocs/'.$record[0]->url);
            $record = Officialdoc::where('id', $id);

            $record->delete();

            session()->flash('message', 'Academicterm Successfully deleted.');

        }
    }
}
