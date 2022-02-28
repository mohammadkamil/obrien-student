<?php

namespace App\Http\Livewire;

use App\Imports\InstitutionImport;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Institution;
use Exception;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class Institutions extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $name, $link, $address;
    public $updateMode = false;

    public function render()
    {
        $keyWord = '%' . $this->keyWord . '%';
        return view('livewire.institutions.view', [
            'institutions' => Institution::latest()
                ->orWhere('name', 'LIKE', $keyWord)
                ->orWhere('link', 'LIKE', $keyWord)
                ->orWhere('address', 'LIKE', $keyWord)
                ->paginate(10),
        ]);
    }
    public function import()
    {
        $filename = "institution";
        $name = $filename . '.' . $this->files->extension();

        $this->files->storeAs('import-tmp', $name);
        // Storage::disk('livewire-tmp')->allFiles();
        // $file = new Filesystem;
        // $file->cleanDirectory('storage/app/livewire-tmp');
        Storage::deleteDirectory('livewire-tmp');

        try {
            Excel::import(new InstitutionImport, 'import-tmp/' . $name);
        } catch (Exception $ex) {
            session()->flash('errorU', 'Please check format. Make sure all column exist.');
        }
        // Storage::disk('import-tmp')->allFiles();
        // $file->cleanDirectory('storage/app/import-tmp');
        Storage::deleteDirectory('import-tmp');
    }
    public function downloadTemplete()
    {
        return Storage::download('templete/institution.xlsx');

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

        ]);

        Institution::create([
            'name' => $this->name,
            'link' => $this->link,
            'address' => $this->address
        ]);

        $this->resetInput();
        $this->emit('closeModal');
        session()->flash('message', 'Institution Successfully created.');
    }

    public function edit($id)
    {
        $record = Institution::findOrFail($id);

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
            $record = Institution::find($this->selected_id);
            $record->update([
                'name' => $this->name,
                'link' => $this->link,
                'address' => $this->address
            ]);

            $this->resetInput();
            $this->updateMode = false;
            session()->flash('message', 'Institution Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Institution::where('id', $id);
            $record->delete();
        }
    }
}
