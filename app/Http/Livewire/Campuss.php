<?php

namespace App\Http\Livewire;

use App\Imports\CampusImport;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Campus;
use Exception;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Campuss extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $name, $address, $link, $files;
    public $updateMode = false;

    public function render()
    {
        $keyWord = '%' . $this->keyWord . '%';
        return view('livewire.campuss.view', [
            'campuses' => Campus::latest()
                ->orWhere('name', 'LIKE', $keyWord)
                ->orWhere('address', 'LIKE', $keyWord)
                ->paginate(10),
        ]);
    }
    public function updatedFile()
    {
        $this->validate([
            'file' => 'mimes:pdf,doc,docx,xlsx,xls|max:2002400', // 20MB Max
        ]);
    }
    public function import()
    {
        $filename = "campus";
        $name = $filename . '.' . $this->files->extension();

        $this->files->storeAs('import-tmp', $name);
        // Storage::disk('livewire-tmp')->allFiles();
        // $file = new Filesystem;
        // $file->cleanDirectory('storage/app/livewire-tmp');
        Storage::deleteDirectory('livewire-tmp');

        try {
            Excel::import(new CampusImport, 'import-tmp/' . $name);
        } catch (Exception $ex) {
            session()->flash('errorU', 'Please check format. Make sure all column exist.');
        }
        // Storage::disk('import-tmp')->allFiles();
        // $file->cleanDirectory('storage/app/import-tmp');
        Storage::deleteDirectory('import-tmp');
    }
    public function downloadTemplete()
    {
        return Storage::download('templete/campus.xlsx');

        // $file = Storage::get("templete/campus.xlsx");
        // // dd($file);
        // return (new Response($file, 200))
        //     ->header('Content-Type', 'file');
    }
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }

    private function resetInput()
    {
        $this->name = null;
        $this->link = null;
        $this->address = null;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'link' => 'required',
            // 'academic_term_id' => 'required',
            // 'campus_id' => 'required',
        ]);

        Campus::create([
            'name' => $this->name,
            'link' => $this->link,
            'address' => $this->address
        ]);

        $this->resetInput();
        $this->emit('closeModal');
        session()->flash('message', 'Campus Successfully created.');
    }

    public function edit($id)
    {
        $record = Campus::findOrFail($id);

        $this->selected_id = $id;
        $this->name = $record->name;
        $this->link = $record->link;
        $this->address = $record->address;

        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'link' => 'required',

        ]);

        if ($this->selected_id) {
            $record = Campus::find($this->selected_id);
            $record->update([
                'name' => $this->name,
                'link' => $this->link,
                'address' => $this->address
            ]);

            $this->resetInput();
            $this->updateMode = false;
            session()->flash('message', 'Campus Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Campus::where('id', $id);
            $record->delete();
            session()->flash('message', 'Academicterm Successfully deleted.');
        }
    }
}
