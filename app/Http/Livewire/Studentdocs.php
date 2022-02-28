<?php

namespace App\Http\Livewire;

use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Studentdoc;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class Studentdocs extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $student_id, $type_doc, $url, $student_name;
    public $updateMode = false;
    public function mount()
    {
        $contact = Student::with('studentprofile')->find(base64_decode(request()->id));

        $this->student_id = base64_decode(request()->id);
        $this->student_name = $contact->studentprofile->name;
        // $this->email = $contact->email;
    }
    public function render()
    {
        $keyWord = '%' . $this->keyWord . '%';
        return view('livewire.studentdocs.view', [
            'studentdocs' => Studentdoc::latest()->where('student_id', '=', $this->student_id)->Where(function ($query) use ($keyWord) {
                $query->orWhere('student_id', 'LIKE', $keyWord)
                    ->orWhere('type_doc', 'LIKE', $keyWord)
                    ->orWhere('url', 'LIKE', $keyWord);
            })->paginate(10),
        ]);
    }

    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }

    private function resetInput()
    {
        // $this->student_id = null;
        $this->type_doc = null;
        $this->url = null;
    }

    public function store()
    {

        $this->validate([
            'type_doc' => 'required',
            'url' => 'required|mimes:pdf,doc,docx,xlsx,xls',

        ]);
        // $filename=$this->files->storeAs('officialdocs', 'public_upload');
        // $filename = $this->files->store('officialdocs', 'public');
        $filename = strtolower(str_replace(' ', '', $this->type_doc));
        $name = $filename . '_' . $this->student_id . '.' . $this->url->extension();

        $this->url->storeAs('studentdocs', $name);
            Storage::deleteDirectory('livewire-tmp');

        // $this->file->store('officialdocs');
        Studentdoc::create([
            'student_id' => $this->student_id,
            'type_doc' => $this->type_doc,
            'url' => $name
        ]);

        $this->resetInput();
        $this->emit('closeModal');
        $this->url = null;
        session()->flash('message', 'Student File Successfully created.');
    }
    public function updatedUrl()
    {
        $this->validate([
            'url' => 'mimes:pdf,doc,docx,xlsx,xls|max:2002400', // 20MB Max
        ]);
    }
    public function edit($id)
    {
        $record = Studentdoc::findOrFail($id);

        $this->selected_id = $id;
        // $this->student_id = $record->student_id;
        $this->type_doc = $record->type_doc;
        $this->url = $record->url;

        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'student_id' => 'required',
        ]);

        if ($this->selected_id) {
            $record = Studentdoc::find($this->selected_id);

            $this->validate([
                'type_doc' => 'required',
                'url' => 'required|mimes:pdf,doc,docx,xlsx,xls',

            ]);
            // $filename=$this->files->storeAs('officialdocs', 'public_upload');
            // $filename = $this->files->store('officialdocs', 'public');
            $name=$record->url;
            if($this->url!=null){
                Storage::delete('studentdocs/' . $record->url);

                $filename = strtolower(str_replace(' ', '', $this->type_doc));
                $name = $filename . '_' . $this->student_id . '.' . $this->url->extension();

                $this->url->storeAs('studentdocs', $name);
                Storage::deleteDirectory('livewire-tmp');

            }

            $record->update([
                // 'student_id' => $this->student_id,
                'type_doc' => $this->type_doc,
                'url' => $name
            ]);

            $this->resetInput();
            $this->emit('closeModal');
            $this->file_file = null;
            session()->flash('message', 'Student File Successfully created.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Studentdoc::where('id', $id);
            Storage::delete('studentdocs/' . $record->url);


            $record->delete();
            session()->flash('message', 'Academicterm Successfully deleted.');
        }
    }
}
