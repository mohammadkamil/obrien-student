<?php

namespace App\Http\Livewire;

use App\Exports\ApplicationExport;
use App\Imports\ProspectImport;
use App\Models\Academicterm;
use App\Models\Application;
use App\Models\Campus;
use App\Models\Institution;
use App\Models\Parentprofile;
use App\Models\Programme;
use App\Models\Student;
use App\Models\Studentprofile;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Prospect extends Component
{
    use WithPagination;
use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $name,
        $tel, $ic_no, $email, $gander,
        $current_status, $current_institution,
        $get_know_obrien, $funding,
        $programme_id, $academic_term_id,
        $status, $parent_name, $parent_tel,
        $considering_intake, $program,

        $intake_programme_id, $intake_academic_term_id,
        $institution_id, $campus_id, $intake_status, $selected_academic_term, $student_name,
         $student_ic, $student_tel, $student_gander, $student_email, $student_studentno, $student_funding, $student_fee

         ,$files;
    public $updateMode = false;

    public function render()
    {
//         $program = Programme::all()->pluck("id", "name");
// dd($program);
        $keyWord = '%' . $this->keyWord . '%';
        $academicterm = Academicterm::orderBy('status', 'desc')->get();
        $programme = Programme::get();
        $institution = Institution::get();
        $campus = Campus::get();
        // return view('livewire.prospect.view', [
        //     'prospect' => Application::latest()->where('status', '<', 1)->Where(function ($query) use ($keyWord) {
        //         $query->orWhere('name', 'LIKE', $keyWord)
        //             ->orWhere('tel', 'LIKE', $keyWord)
        //             ->orWhere('ic_no', 'LIKE', $keyWord)
        //             ->orWhere('email', 'LIKE', $keyWord)
        //             ->orWhere('gander', 'LIKE', $keyWord)
        //             ->orWhere('current_status', 'LIKE', $keyWord)
        //             ->orWhere('current_institution', 'LIKE', $keyWord)
        //             ->orWhere('get_know_obrien', 'LIKE', $keyWord)
        //             ->orWhere('funding', 'LIKE', $keyWord);
        //     })->paginate(10), 'academicterm' => $academicterm, 'programme' => $programme, 'institution' => $institution, 'campus' => $campus
        // ]);
        return view('livewire.prospect.view', [
            'prospect' => Application::Where(function ($query) use ($keyWord) {
                $query->orWhere('name', 'LIKE', $keyWord)
                    ->orWhere('tel', 'LIKE', $keyWord)
                    ->orWhere('ic_no', 'LIKE', $keyWord)
                    ->orWhere('email', 'LIKE', $keyWord)
                    ->orWhere('gander', 'LIKE', $keyWord)
                    ->orWhere('current_status', 'LIKE', $keyWord)
                    ->orWhere('current_institution', 'LIKE', $keyWord)
                    ->orWhere('get_know_obrien', 'LIKE', $keyWord)
                    ->orWhere('funding', 'LIKE', $keyWord);
            })->orderBy('status','asc')->paginate(10), 'academicterm' => $academicterm, 'programme' => $programme, 'institution' => $institution, 'campus' => $campus
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
        $this->current_status = null;
        $this->current_institution = null;
        $this->get_know_obrien = null;
        $this->funding = null;
        $this->notes = null;
        $this->programme_id = null;
        $this->academic_term_id = null;
        $this->status = null;
        $this->parent_tel = null;
        $this->parent_name = null;

        $this->intake_programme_id = null;
        $this->intake_academic_term_id = null;
        $this->intake_status = null;
        $this->institution_id = null;
        $this->campus_id = null;
        $this->selected_academic_term = null;
        $this->student_name = null;
        $this->student_ic = null;
        $this->student_tel = null;
        $this->student_gander = null;
        $this->student_email = null;
        $this->student_studentno = null;
        $this->student_funding = null;
        $this->student_fee = null;
        $this->files = null;
    }
    public function export()
    {
        # code...
        return Excel::download(new ApplicationExport($this->keyWord), 'prospect_'.Carbon::now().'.xlsx');
    }
    public function store()
    {
        $this->validate([
            'name' => 'required',
            'tel' => 'required|regex:/^\d+$/|min:10|max:11', 'ic_no' => 'required|regex:/^\d+$/|min:12|max:12',
            'email' => 'required', 'gander' => 'required',
            'current_status' => 'required', 'current_institution' => 'required',
            'get_know_obrien' => 'required',
            // 'funding' => 'required',
            // 'programme_id' => 'required',
            // 'academic_term_id' => 'required',
            // 'parent_tel' => 'required',
            // 'parent_name' => 'required',
            // 'considering_intake' => 'required',
            // 'program' => 'required',

        ]);

        Application::create([
            'name' => $this->name,
            'tel' => $this->tel,
            'ic_no' => $this->ic_no,
            'email' => $this->email,
            'gander' => $this->gander,
            'current_status' => $this->current_status,
            'current_institution' => $this->current_institution,
            'get_know_obrien' => $this->get_know_obrien,
            'funding' => $this->funding,
            'programme_id' => $this->programme_id,
            'academic_term_id' => $this->academic_term_id,
            'status' => 0,
            'parent_tel' => $this->parent_tel,
            'parent_name' => $this->parent_name,
            'considering_intake' => $this->considering_intake,
            'program' => $this->program,
            'year' => Carbon::now()->format('Y')
        ]);

        $this->resetInput();
        $this->emit('closeModal');
        session()->flash('message', 'Application Successfully created.');
    }

    public function edit($id)
    {
        $record = Application::findOrFail($id);

        $this->selected_id = $id;
        $this->name = $record->name;
        $this->tel = $record->tel;
        $this->ic_no = $record->ic_no;
        $this->email = $record->email;
        $this->gander = $record->gander;
        $this->current_status = $record->current_status;
        $this->current_institution = $record->current_institution;
        $this->get_know_obrien = $record->get_know_obrien;
        $this->funding = $record->funding;
        $this->notes = $record->notes;
        // $this->programme_id = $record->programme_id;
        // $this->academic_term_id = $record->academic_term_id;
        // $this->status = $record->status;
        $this->parent_name = $record->parent_name;
        $this->parent_tel = $record->parent_tel;
        $this->program = $record->program;
        $this->considering_intake = $record->considering_intake;
        $this->updateMode = true;
    }
    public function display($id)
    {
        $record = Application::findOrFail($id);

        $this->selected_id = $id;
        $this->name = $record->name;
        $this->tel = $record->tel;
        $this->ic_no = $record->ic_no;
        $this->email = $record->email;
        $this->gander = $record->gander;
        $this->current_status = $record->current_status;
        $this->current_institution = $record->current_institution;
        $this->get_know_obrien = $record->get_know_obrien;
        $this->funding = $record->funding;
        $this->notes = $record->notes;
        $this->parent_name = $record->parent_name;
        $this->parent_tel = $record->parent_tel;
        $this->program = $record->program;
        $this->considering_intake = $record->considering_intake;
        // $this->programme_id = $record->programme_id;
        // $this->academic_term_id = $record->academic_term_id;
        // $this->status = $record->status;

        $this->updateMode = true;
    }
    public function createintake($id)
    {
        $record = Application::findOrFail($id);

        $this->selected_id = $id;
        $this->student_name = $record->name;
        $this->student_tel = $record->tel;
        $this->student_ic = $record->ic_no;
        $this->student_email = $record->email;
        $this->student_gander = $record->gander;
        $this->student_funding = $record->funding;
        $this->student_studentno = null;
        $this->student_fee = null;
        $this->intake_programme_id = $record->program;
        $this->institution_id = null;
        $this->intake_academic_term_id = $record->considering_intake;
        $this->campus_id = null;
        $this->parent_name = $record->parent_name;
        $this->parent_tel = $record->parent_tel;
        $this->parent_address = null;
        $this->parent_email = null;

        }
    public function storeintake()
    {
        $this->validate([
            'student_name' => 'required',
            'student_tel' => 'required|regex:/^\d+$/|min:10|max:11', 'student_ic' => 'required|regex:/^\d+$/|min:12|max:12',
            'student_email' => 'required', 'student_gander' => 'required',

            'parent_tel'=>'regex:/^\d+$/|min:10|max:11'
        ]);
        $record = Application::find($this->selected_id);
        $record->update([

            'status' => 1
        ]);
        $Studentprofile = Studentprofile::create([
            'name' => $this->student_name,
            'tel' => $this->student_tel,
            'ic_no' => $this->student_ic,
            'email' => $this->student_email,
            'gander' => $this->student_gander,
            'funding' => $this->student_funding,
            'student_no' => $this->student_studentno,
            'fees' => $this->student_fee
        ]);
        $student = Student::create([
            'student_profile_id' => $Studentprofile->id,
            'programme_id' => $this->intake_programme_id,
            'institution_id' => $this->institution_id,
            'academic_term_id' => $this->intake_academic_term_id,
            'campus_id' => $this->campus_id,
            'year' => Carbon::now()->format('Y'),
            'status' => 1

        ]);
        Parentprofile::create(['student_id' => $student->id,
         'name' => $this->parent_name, 'contact_no' => $this->parent_tel, 'address' => $this->parent_address, 'email'=> $this->parent_email]);
        session()->flash('message', 'Successfully make application.');
    }
    public function makeApplication($id)
    {
        # code...
        // $record = Application::findOrFail($id);
        $record = Application::find($id);
        $record->update([

            'status' => 1
        ]);
        $Studentprofile = Studentprofile::create([
            'name' => $record->name,
            'tel' => $record->tel,
            'ic_no' => $record->ic_no,
            'email' => $record->email,
            'gander' => $record->gander,
            'funding' => $record->funding,
            'student_no' => 0,
            'fees' => 0,
        ]);
        Student::create([
            'student_profile_id' => $Studentprofile->id,
            'programme_id' => 0,
            'institution_id' => 0,
            'academic_term_id' => 0,
            'campus_id' => 0,
            'year' => Carbon::now()->format('Y'),
            'status' => 1

        ]);
        session()->flash('message', 'Successfully make application.');
    }
    public function import()
    {
        $filename = "prospect";
        $name = $filename . '.' . $this->files->extension();

        $this->files->storeAs('import-tmp', $name);
        // Storage::disk('livewire-tmp')->allFiles();
        // $file = new Filesystem;
        // $file->cleanDirectory('storage/app/livewire-tmp');
        Storage::deleteDirectory('livewire-tmp');

        try {
            Excel::import(new ProspectImport(9), 'import-tmp/' . $name);
        } catch (Exception $ex) {
            session()->flash('errorU', 'Please check format. Make sure all column exist.');
        }
        // Storage::disk('import-tmp')->allFiles();
        // $file->cleanDirectory('storage/app/import-tmp');
        Storage::deleteDirectory('import-tmp');
    }
    public function downloadTemplete()
    {
        return Storage::download('templete/prospect.xlsx');

        // $file = Storage::get("templete/campus.xlsx");
        // // dd($file);
        // return (new Response($file, 200))
        //     ->header('Content-Type', 'file');
    }
    public function update()
    {
        $this->validate([
            'name' => 'required',
            'tel' => 'required|regex:/^\d+$/|min:10|max:11', 'ic_no' => 'required|regex:/^\d+$/|min:12|max:12',
            'email' => 'required', 'gander' => 'required',
            'current_status' => 'required', 'current_institution' => 'required',
            'get_know_obrien' => 'required',
            'parent_tel'=>'regex:/^\d+$/|min:10|max:11'
        ]);

        if ($this->selected_id) {
            $record = Application::find($this->selected_id);
            $record->update([
                'name' => $this->name,
                'tel' => $this->tel,
                'ic_no' => $this->ic_no,
                'email' => $this->email,
                'gander' => $this->gander,
                'current_status' => $this->current_status,
                'current_institution' => $this->current_institution,
                'get_know_obrien' => $this->get_know_obrien,
                'funding' => $this->funding,
                'notes' => $this->notes,
                'parent_name' => $this->parent_name,
                'parent_tel' => $this->parent_tel,
                'considering_intake' => $this->considering_intake,
                'program' => $this->program,
                // 'programme_id' => $this->programme_id,
                // 'academic_term_id' => $this->academic_term_id,
                // 'status' => $this->status
            ]);

            // $this->resetInput();
            $this->updateMode = false;
            session()->flash('message', 'Application Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Application::where('id', $id);
            $record->delete();
            session()->flash('message', 'Academicterm Successfully deleted.');
        }
    }
}
