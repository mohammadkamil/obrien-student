<?php

namespace App\Http\Livewire;

use App\Exports\IntakeExport;
use App\Imports\IntakeImport;
use App\Models\Academicterm;
use App\Models\Administration;
use App\Models\Alumni;
use App\Models\Campus;
use App\Models\Institution;
use App\Models\Parentprofile;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Programme;
use App\Models\Student;
use App\Models\Studentdoc;
use App\Models\StudentLogin;
use App\Models\Studentprofile;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Intakes extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $student_profile_id, $programme_id, $academic_term_id,
        $institution_id, $campus_id, $status, $selected_academic_term, $student_name, $student_ic,
        $student_tel, $student_gander, $student_email, $student_studentno, $student_funding, $student_fee, $file_name, $file_file, $files, $parent_name, $parent_tel, $parent_address, $parent_email, $import_academic_id;
    public $updateMode = false;
    protected $rules = [
        'parent_tel' => 'regex:/^\d+$/',
        'parent_name' => 'regex:/^\d+$/',
    ];
    public function render()
    {
        $keyWord = '%' . $this->keyWord . '%';
        $academicterm = Academicterm::orderBy('status', 'desc')->get();
        $programme = Programme::get();
        $institution = Institution::get();
        $campus = Campus::get();
        if ($this->selected_academic_term != "" || $this->selected_academic_term != null) {
            // return view('livewire.intake.view', [
            //     'intakes' => Student::with('studentprofile','programme','institution','campus','academicterm')->latest()->Where('academic_term_id','=',$this->selected_academic_term)
            //                 ->paginate(10),'academicterm'=>$academicterm
            // ]);
            $count = Student::where('academic_term_id', '=', $this->selected_academic_term)
                ->Where(function ($query) use ($keyWord) {
                    $query->orwhereHas('studentprofile', function ($query) use ($keyWord) {
                        $query->where('name', 'like', $keyWord . '%');
                    })
                        ->orwhereHas('programme', function ($query) use ($keyWord) {
                            $query->where('name', 'like', $keyWord . '%');
                        })
                        ->orwhereHas('institution', function ($query) use ($keyWord) {
                            $query->where('name', 'like', $keyWord . '%');
                        })
                        ->orwhereHas('campus', function ($query) use ($keyWord) {
                            $query->where('name', 'like', $keyWord . '%');
                        });
                })->select('status', DB::raw('count(*) as total'))
                ->groupBy('status')->orderBy('status', 'asc')->get();
            $countsarray = [];
            foreach ($count as $row) {
                $countsarray[$row['status']] = $row['total'];
            }
            return view('livewire.intake.view', [
                'intakes' => Student::with('studentprofile', 'programme', 'institution', 'campus', 'academicterm')->latest()->where('academic_term_id', '=', $this->selected_academic_term)
                    ->Where(function ($query) use ($keyWord) {
                        $query->orwhereHas('studentprofile', function ($query) use ($keyWord) {
                            $query->where('name', 'like', $keyWord . '%');
                        })
                            ->orwhereHas('programme', function ($query) use ($keyWord) {
                                $query->where('name', 'like', $keyWord . '%');
                            })
                            ->orwhereHas('institution', function ($query) use ($keyWord) {
                                $query->where('name', 'like', $keyWord . '%');
                            })
                            ->orwhereHas('campus', function ($query) use ($keyWord) {
                                $query->where('name', 'like', $keyWord . '%');
                            });
                    })->paginate(10), 'academicterm' => $academicterm, 'programme' => $programme, 'institution' => $institution, 'campus' => $campus, 'count' => $count, 'countsarray' => $countsarray
            ]);
        } else {
            $count = Student::orwhereHas('studentprofile', function ($query) use ($keyWord) {
                $query->where('name', 'like', $keyWord . '%');
            })
                ->orwhereHas('programme', function ($query) use ($keyWord) {
                    $query->where('name', 'like', $keyWord . '%');
                })
                ->orwhereHas('institution', function ($query) use ($keyWord) {
                    $query->where('name', 'like', $keyWord . '%');
                })
                ->orwhereHas('campus', function ($query) use ($keyWord) {
                    $query->where('name', 'like', $keyWord . '%');
                })->select('status', DB::raw('count(*) as total'))
                ->groupBy('status')->orderBy('status', 'asc')->get();
            $countsarray = [];
            $totals = 0;
            foreach ($count as $row) {
                $totals = $totals + $row['total'];
                $countsarray[$row['status']] = $row['total'];
            }
            $countsarray['total'] = $totals;

            return view('livewire.intake.view', [
                'intakes' => Student::with('studentprofile', 'programme', 'institution', 'campus', 'academicterm')->latest()->orwhereHas('studentprofile', function ($query) use ($keyWord) {
                    $query->where('name', 'like', $keyWord . '%');
                })
                    ->orwhereHas('programme', function ($query) use ($keyWord) {
                        $query->where('name', 'like', $keyWord . '%');
                    })
                    ->orwhereHas('institution', function ($query) use ($keyWord) {
                        $query->where('name', 'like', $keyWord . '%');
                    })
                    ->orwhereHas('campus', function ($query) use ($keyWord) {
                        $query->where('name', 'like', $keyWord . '%');
                    })->paginate(10), 'academicterm' => $academicterm, 'programme' => $programme, 'institution' => $institution, 'campus' => $campus, 'count' => $count, 'countsarray' => $countsarray
            ]);
            // return view('livewire.intake.view', [
            //     'intakes' => Student::with('studentprofile','programme','institution','campus','academicterm')->latest()->where('academic_term_id','=',$this->selected_academic_term)
            //     ->Where(function($query) use ($keyWord){
            //         $query->orwhereHas('studentprofile', function ($query) use ($keyWord) { $query->where('name', 'like', $keyWord.'%'); })
            //             ->orwhereHas('programme', function ($query) use ($keyWord) { $query->where('name', 'like', $keyWord.'%'); })
            //             ->orwhereHas('institution', function ($query) use ($keyWord) { $query->where('name', 'like', $keyWord.'%'); })
            //             ->orwhereHas('campus', function ($query) use ($keyWord) { $query->where('name', 'like', $keyWord.'%'); });
            //     })->paginate(10),'academicterm'=>$academicterm
            // ]);

        }
    }

    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }

    private function resetInput()
    {
        $this->student_profile_id = null;
        $this->programme_id = null;
        $this->academic_term_id = null;
        $this->status = null;
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
        $this->file_name = null;
        $this->file_file = null;
        $this->parent_name = null;
        $this->parent_address = null;
        $this->parent_tel = null;
        $this->parent_email = null;
        $this->import_academic_id = null;
    }
    public function export()
    {
        # code...
        return Excel::download(new IntakeExport($this->selected_academic_term, $this->keyWord), 'intake_' . Carbon::now() . '.xlsx');
    }
    public function store()
    {
        $this->validate([
            'student_name' => 'required',
            'student_tel' => 'regex:/^\d+$/',
            'student_ic' => 'regex:/^\d+$/',
            'student_fee' => 'regex:/^\d+$/',
            'programme_id' => 'required',
            'academic_term_id' => 'required',
            'campus_id' => 'required',
            'institution_id' => 'required',
            'parent_tel' => 'regex:/^\d+$/'
        ]);

        $studentprofile = Studentprofile::create([
            'name' => $this->student_name,
            'tel' => $this->student_tel,
            'ic_no' => $this->student_ic,
            'email' => $this->student_email,
            'gander' => $this->student_gander,
            'funding' => $this->student_funding,
            'student_no' => $this->student_studentno,
            'fees' => $this->student_fee,
        ]);
        $student = Student::create([
            'student_profile_id' => $studentprofile->id,
            'programme_id' => $this->programme_id,
            'academic_term_id' => $this->academic_term_id,
            'institution_id' => $this->institution_id,
            'campus_id' => $this->campus_id,
            'status' => $this->status
        ]);
        Parentprofile::create([
            'student_id' => $student->id,
            'name' => $this->parent_name, 'contact_no' => $this->parent_tel, 'address' => $this->parent_address, 'email' => $this->parent_email
        ]);
        $this->resetInput();
        $this->emit('closeModal');
        session()->flash('message', 'Intake Successfully created.');
    }


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function edit($id)
    {
        $this->resetInput();

        $record = Student::with('studentprofile', 'parentprofile')->findOrFail($id);
        // dd($record);
        $this->selected_id = $id;
        $this->student_profile_id = $record->student_profile_id;
        $this->programme_id = $record->programme_id;
        $this->academic_term_id = $record->academic_term_id;
        $this->institution_id = $record->institution_id;
        $this->campus_id = $record->campus_id;
        $this->status = $record->status;
        $this->student_name = $record->studentprofile->name;
        $this->student_ic = $record->studentprofile->ic_no;
        $this->student_tel = $record->studentprofile->tel;
        $this->student_gander = $record->studentprofile->gander;
        $this->student_email = $record->studentprofile->email;
        $this->student_studentno = $record->studentprofile->student_no;
        $this->student_funding = $record->studentprofile->funding;
        $this->student_fee = $record->studentprofile->fees;

        $this->parent_name = $record->parentprofile->name;
        $this->parent_tel = $record->parentprofile->contact_no;
        $this->parent_address = $record->parentprofile->address;
        $this->parent_email = $record->parentprofile->email;

        $this->updateMode = true;
    }
    public function display($id)
    {
        $record = Student::with('studentprofile', 'parentprofile')->findOrFail($id);
        // dd($record);
        $this->selected_id = $id;
        $this->student_profile_id = $record->student_profile_id;
        $this->programme_id = $record->programme_id;
        $this->academic_term_id = $record->academic_term_id;
        $this->institution_id = $record->institution_id;
        $this->campus_id = $record->campus_id;
        $this->status = $record->status;
        $this->student_name = $record->studentprofile->name;
        $this->student_ic = $record->studentprofile->ic_no;
        $this->student_tel = $record->studentprofile->tel;
        $this->student_gander = $record->studentprofile->gander;
        $this->student_email = $record->studentprofile->email;
        $this->student_studentno = $record->studentprofile->student_no;
        $this->student_funding = $record->studentprofile->funding;
        $this->student_fee = $record->studentprofile->fees;
        $this->parent_name = $record->parentprofile->name;
        $this->parent_tel = $record->parentprofile->contact_no;
        $this->parent_address = $record->parentprofile->address;
        $this->parent_email = $record->parentprofile->email;
    }
    public function updatedFile()
    {
        $this->validate([
            'file' => 'mimes:pdf,doc,docx,xlsx,xls|max:2002400', // 20MB Max
        ]);
    }
    public function addFile($id)
    {
        # code...
        $this->resetInput();

        $record = Student::with('studentprofile')->findOrFail($id);
        // dd($record);
        $this->selected_id = $id;
        $this->student_name = $record->studentprofile->name;
    }
    public function storeFile()
    {
        # code...
        // $this->resetInput();
        $this->validate([
            'file_name' => 'required',
            'file_file' => 'required',

        ]);
        // $filename=$this->files->storeAs('officialdocs', 'public_upload');
        // $filename = $this->files->store('officialdocs', 'public');
        $filename = strtolower(str_replace(' ', '', $this->file_name));
        $name = $filename . '_' . $this->selected_id . '.' . $this->file_file->extension();

        $this->file_file->storeAs('studentdocs', $name);

        // $this->file->store('officialdocs');
        Studentdoc::create([
            'student_id' => $this->selected_id,
            'type_doc' => $this->file_name,
            'url' => $name
        ]);

        $this->resetInput();
        $this->emit('closeModal');
        $this->file_file = null;
        session()->flash('message', 'Student File Successfully created.');
    }
    public function viewFile($id)
    {
        # code...
        $record = Student::with('studentprofile')->findOrFail($id);
        $recordfile = Studentdoc::where('student_id', '=', $id);
        // dd($record);
        $this->selected_id = $id;
        $this->student_name = $record->studentprofile->name;
        $this->files = $recordfile;
    }
    public function import()
    {
        $this->validate([
            'import_academic_id' => 'required',
            'files' => 'required',

        ]);
        $filename = "prospect";
        $name = $filename . '.' . $this->files->extension();

        $this->files->storeAs('import-tmp', $name);
        // Storage::disk('livewire-tmp')->allFiles();
        // $file = new Filesystem;
        // $file->cleanDirectory('storage/app/livewire-tmp');
        Storage::deleteDirectory('livewire-tmp');

        try {
            Excel::import(new IntakeImport($this->import_academic_id), 'import-tmp/' . $name);
        } catch (Exception $ex) {
            session()->flash('errorU', 'Please check format. Make sure all column exist.');
        }
        // Storage::disk('import-tmp')->allFiles();
        // $file->cleanDirectory('storage/app/import-tmp');
        Storage::deleteDirectory('import-tmp');
        $this->resetInput();
        $this->emit('closeModal');
        session()->flash('message', 'Intake import Successfully created.');
    }
    public function downloadTemplete()
    {
        return Storage::download('templete/intake.xlsx');

        // $file = Storage::get("templete/campus.xlsx");
        // // dd($file);
        // return (new Response($file, 200))
        //     ->header('Content-Type', 'file');
    }
    public function update()
    {
        // dd($this->campus_id);
        $this->validate([
            'student_name' => 'required',
            'programme_id' => 'required',
            'institution_id' => 'required',
            'academic_term_id' => 'required',
            'campus_id' => 'required',
            'status' => 'required',
        ]);

        if ($this->selected_id) {

            $record = Student::find($this->selected_id);
            $record_student = Studentprofile::find($record->student_profile_id);
            $record_parent = Parentprofile::where('student_id', '=', $this->selected_id);
            $record_student->update([
                'name' => $this->student_name,
                'tel' => $this->student_tel,
                'ic_no' => $this->student_ic,
                'email' => $this->student_email,
                'gander' => $this->student_gander,
                'funding' => $this->student_funding,
                'student_no' => $this->student_studentno,
                'fees' => $this->student_fee,
            ]);
            $record->update([
                'student_profile_id' => $this->student_profile_id,
                'programme_id' => $this->programme_id,
                'institution_id' => $this->institution_id,
                'academic_term_id' => $this->academic_term_id,
                'campus_id' => $this->campus_id,
                // 'status' => $this-> status
            ]);
            $record_parent->update([
                'name' => $this->parent_name, 'contact_no' => $this->parent_tel, 'address' => $this->parent_address, 'email' => $this->parent_email
            ]);

            // $this->resetInput();
            $this->updateMode = false;
            session()->flash('message', 'Student Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $records = Student::where('id', $id)->get();
            // dd($records);
            $record = Student::where('id', $id);
            $record_student = Studentprofile::where('id', $records[0]->student_profile_id);
            $record_parent = Parentprofile::where("student_id", '=', $records[0]->id);
            $record_file = Studentdoc::where("student_id", '=', $records[0]->id)->get();
            foreach ($record_file as $file) {
                Storage::delete('studentdocs/' . $file->url);
            }
            $record_files = Studentdoc::where("student_id", '=', $records[0]->id);

            $record->delete();
            $record_student->delete();
            $record_parent->delete();
            $record_files->delete();
            // dd($record_file);
        }
    }
    public function statusedit($id)
    {
        # code...
        $this->selected_id = $id;
    }
    public function updateStatus($id, $statusupdate)
    {
        # code...
        $record = Student::find($id);
        if ($statusupdate == 5) {
             Alumni::create([
                'student_id' => $id,
                'graduate_year' => null,
                'status' => null,

            ]);
            StudentLogin::create([
                'student_id' => $id,
                'email' => $record->email,
                'password' => bcrypt($record->student_no),

            ]);
        }
        $record->update([

            'status' => $statusupdate
        ]);
        session()->flash('message', 'Status Successfully updated.');
    }
    public function updateStatus2($statusupdate)
    {
        # code...
        $record = Student::with('studentprofile')->find($this->selected_id);
        // dd($record);
        if ($statusupdate == 3) {
            Administration::create([
                'student_id' => $this->selected_id,
                'vaccine_type' => null,
                'second_dose' => null,
                'address' => null,
                'flight_routing' => null,
                'date_arrival' => null
            ]);
        }else   if ($statusupdate == 5) {
            $alumnis=Alumni::create([
               'student_id' => $this->selected_id,
               'graduate_year' => null,
               'status' => null,

           ]);
           StudentLogin::create([
               'alumnis_id' => $alumnis->id,
               'email' => $record->studentprofile->email,
               'password' => bcrypt($record->studentprofile->ic_no),

           ]);
       }

        $record->update([

            'status' => $statusupdate
        ]);
        session()->flash('message', 'Status Successfully updated.');
    }
}
