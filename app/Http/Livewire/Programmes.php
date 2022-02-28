<?php

namespace App\Http\Livewire;

use App\Imports\ProgramImport;
use App\Models\Institution;
use Livewire\Component;
use Livewire\WithFileUploads;

use Livewire\WithPagination;
use App\Models\Programme;
use Exception;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class Programmes extends Component
{
    use WithPagination;
    use WithFileUploads;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $name, $code,$mara_status,$files,$institution_id;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.programmes.view', [
            'programmes' => Programme::latest()
						->orWhere('name', 'LIKE', $keyWord)
						->orWhere('code', 'LIKE', $keyWord)
						->paginate(10),
                        "institution"=>Institution::all()
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
		$this->institution_id = null;
		$this->mara_status = null;
    }

    public function store()
    {
        $this->validate([ 'name' => 'required',
        'code' => 'required',
        'mara_status' => 'required',
        ]);

        Programme::create([
			'name' => $this-> name,
			'code' => $this-> code,
			'institution_id' => $this-> institution_id,
            'mara_status'=>$this->mara_status
        ]);

        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Programme Successfully created.');
    }

    public function edit($id)
    {
        $record = Programme::findOrFail($id);

        $this->selected_id = $id;
		$this->name = $record-> name;
		$this->code = $record-> code;
		$this->institution_id = $record-> institution_id;
		$this->mara_status = $record-> mara_status;

        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate(['name' => 'required',
        'code' => 'required',
        'mara_status' => 'required',

        ]);

        if ($this->selected_id) {
			$record = Programme::find($this->selected_id);
            $record->update([
			'name' => $this-> name,
			'code' => $this-> code,
			'institution_id' => $this-> institution_id,
			'mara_status' => $this-> mara_status
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Programme Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Programme::where('id', $id);
            $record->delete();            session()->flash('message', 'Academicterm Successfully deleted.');

        }
    }public function import()
    {
        $filename = "campus";
        $name = $filename . '.' . $this->files->extension();

        $this->files->storeAs('import-tmp', $name);
        // Storage::disk('livewire-tmp')->allFiles();
        // $file = new Filesystem;
        // $file->cleanDirectory('storage/app/livewire-tmp');
        Storage::deleteDirectory('livewire-tmp');

        // try {
            Excel::import(new ProgramImport, 'import-tmp/' . $name);
        // } catch (Exception $ex) {
        //     session()->flash('errorU', 'Please check format. Make sure all column exist.');
        // }
        // Storage::disk('import-tmp')->allFiles();
        // $file->cleanDirectory('storage/app/import-tmp');
        Storage::deleteDirectory('import-tmp');
    }
    public function downloadTemplete()
    {
        return Storage::download('templete/programme.xlsx');

        // $file = Storage::get("templete/campus.xlsx");
        // // dd($file);
        // return (new Response($file, 200))
        //     ->header('Content-Type', 'file');
    }public function updatestatus($id,$termstatus)
    {
        if ($termstatus == 1) {

                $record = Programme::find($id);
                $record->update([

                    'mara_status' => $termstatus
                ]);

                $this->resetInput();
                // $this->updateMode = false;
                session()->flash('message', 'Programme Mara Status Successfully updated.');

        } else {
            $record = Programme::find($id);
            $record->update([

                'mara_status' => $termstatus
            ]);

            $this->resetInput();
            // $this->updateMode = false;
            session()->flash('message', 'Programme Mara Status Successfully updated.');
        }}
}
