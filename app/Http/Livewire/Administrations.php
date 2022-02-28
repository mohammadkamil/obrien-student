<?php

namespace App\Http\Livewire;

use App\Exports\AdministrationExport;
use App\Models\Academicterm;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Administration;
use App\Models\Parentprofile;
use App\Models\Student;
use App\Models\Studentprofile;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class Administrations extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $student_id, $vaccine_type, $second_dose, $address, $flight_routing, $date_arrival, $selected_academic_term, $student_name,
    $student_ic,
    $student_tel,
    $student_passport,
    $parent_name,$parent_tel,$parent_address,$parent_email;
    public $updateMode = false;

    public function render()
    {
        $keyWord = '%' . $this->keyWord . '%';
        // return view('livewire.administrations.view', [
        //     'administrations' => Administration::latest()
        // 				->orWhere('student_id', 'LIKE', $keyWord)
        // 				->orWhere('vaccine_type', 'LIKE', $keyWord)
        // 				->orWhere('second_dose', 'LIKE', $keyWord)
        // 				->orWhere('address', 'LIKE', $keyWord)
        // 				->orWhere('flight_routing', 'LIKE', $keyWord)
        // 				->orWhere('date_arrival', 'LIKE', $keyWord)
        // 				->paginate(10),
        // ]);
        $academicterm = Academicterm::orderBy('status', 'desc')->get();

        $keyWord = '%' . $this->keyWord . '%';
        // return view('livewire.alumnis.view', [
        //     'alumnis' => Alumni::latest()
        //         ->orWhere('student_id', 'LIKE', $keyWord)
        //         ->orWhere('graduate_year', 'LIKE', $keyWord)
        //         ->orWhere('status', 'LIKE', $keyWord)
        //         ->paginate(10), 'academicterm' => $academicterm,
        // ]);
        $selected_academic = $this->selected_academic_term;
        if ($this->selected_academic_term != "" || $this->selected_academic_term != null) {
            // return view('livewire.intake.view', [
            //     'intakes' => Administration::with('studentprofile','programme','institution','campus','academicterm')->latest()->Where('academic_term_id','=',$this->selected_academic_term)
            //                 ->paginate(10),'academicterm'=>$academicterm
            // ]);
            $count = Administration::Where(function ($query) use ($keyWord) {
                $query->whereHas('student', function ($query) use ($keyWord) {
                    $query->where('academic_term_id', '=', $this->selected_academic_term);
                })->Where(function ($query) use ($keyWord) {
                    $query->orwhereHas('student.studentprofile', function ($query) use ($keyWord) {
                        $query->where('name', 'like', $keyWord);
                    })->orWhere('vaccine_type', 'LIKE', $keyWord)
                        ->orWhere('second_dose', 'LIKE', $keyWord)
                        ->orWhere('address', 'LIKE', $keyWord)
                        ->orWhere('flight_routing', 'LIKE', $keyWord)
                        ->orWhere('date_arrival', 'LIKE', $keyWord);
                });
            })->get()->count();

            return view('livewire.administrations.view', [
                'administrations' => Administration::with('student.studentprofile')->latest()
                    ->Where(function ($query) use ($keyWord) {
                        $query->whereHas('student', function ($query) use ($keyWord) {
                            $query->where('academic_term_id', '=', $this->selected_academic_term);
                        })->Where(function ($query) use ($keyWord) {
                            $query->orwhereHas('student.studentprofile', function ($query) use ($keyWord) {
                                $query->where('name', 'like', $keyWord);
                            })->orWhere('vaccine_type', 'LIKE', $keyWord)
                                ->orWhere('second_dose', 'LIKE', $keyWord)
                                ->orWhere('address', 'LIKE', $keyWord)
                                ->orWhere('flight_routing', 'LIKE', $keyWord)
                                ->orWhere('date_arrival', 'LIKE', $keyWord);
                        });
                    })->paginate(10), 'academicterm' => $academicterm, "count" => $count
            ]);
        } else {
            $count = Administration::orwhereHas('student.studentprofile', function ($query) use ($keyWord) {
                $query->where('name', 'like', $keyWord);
            })->orWhere('vaccine_type', 'LIKE', $keyWord)
                ->orWhere('second_dose', 'LIKE', $keyWord)
                ->orWhere('address', 'LIKE', $keyWord)
                ->orWhere('flight_routing', 'LIKE', $keyWord)
                ->orWhere('date_arrival', 'LIKE', $keyWord)->get()->count();


            return view('livewire.administrations.view', [
                'administrations' => Administration::with('student.studentprofile')->latest()->orwhereHas('student.studentprofile', function ($query) use ($keyWord) {
                    $query->where('name', 'like', $keyWord);
                })->orWhere('vaccine_type', 'LIKE', $keyWord)
                    ->orWhere('second_dose', 'LIKE', $keyWord)
                    ->orWhere('address', 'LIKE', $keyWord)
                    ->orWhere('flight_routing', 'LIKE', $keyWord)
                    ->orWhere('date_arrival', 'LIKE', $keyWord)->paginate(10), 'academicterm' => $academicterm, "count" => $count
            ]);
            // return view('livewire.intake.view', [
            //     'intakes' => Administration::with('studentprofile','programme','institution','campus','academicterm')->latest()->where('academic_term_id','=',$this->selected_academic_term)
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
        $this->student_id = null;
        $this->vaccine_type = null;
        $this->second_dose = null;
        $this->address = null;
        $this->flight_routing = null;
        $this->date_arrival = null;
        $this->student_name = null;
        $this->student_ic = null;
        $this->student_tel = null;
        $this->student_passport = null;
        $this->parent_name = null;
        $this->parent_address = null;
        $this->parent_tel= null;
        $this->parent_email = null;
    }

    public function store()
    {
        $this->validate([
            'vaccine_type' => 'required',
            'second_dose' => 'required',
        ]);

        Administration::create([
            'student_id' => $this->student_id,
            'vaccine_type' => $this->vaccine_type,
            'second_dose' => $this->second_dose,
            'address' => $this->address,
            'flight_routing' => $this->flight_routing,
            'date_arrival' => $this->date_arrival
        ]);
        Parentprofile::create(['student_id' => $this->student_id,
        'name' => $this->parent_name, 'contact_no' => $this->parent_tel, 'address' => $this->parent_address, 'email'=> $this->parent_email]);
        $this->resetInput();
        $this->emit('closeModal');
        session()->flash('message', 'Administration Successfully created.');
    }

    public function edit($id)
    {
        $record = Administration::with('student.studentprofile','student.parentprofile')->findOrFail($id);

        $this->selected_id = $id;
        $this->student_id = $record->student_id;
        $this->vaccine_type = $record->vaccine_type;
        $this->second_dose = $record->second_dose;
        $this->address = $record->address;
        $this->flight_routing = $record->flight_routing;
        $this->date_arrival = $record->date_arrival;
        $this->student_name = $record->student->studentprofile->name;
        $this->student_ic = $record->student->studentprofile->ic_no;
        $this->student_tel = $record->student->studentprofile->tel;
        $this->student_email = $record->student->studentprofile->email;
        $this->student_passport = $record->student->studentprofile->passport_no;
        $this->parent_name=$record->student->parentprofile->name;
        $this->parent_tel=$record->student->parentprofile->contact_no;
        $this->parent_address=$record->student->parentprofile->address;
        $this->parent_email=$record->student->parentprofile->email;
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'vaccine_type' => 'required',
            'second_dose' => 'required',
        ]);

        if ($this->selected_id) {
            $record = Administration::find($this->selected_id);
            $record_parent=Parentprofile::where('student_id','=',$this->selected_id);
            $record_student=Student::find($this->selected_id);
            $record_student_profile = Studentprofile::find($record_student->student_profile_id);
            $record_student_profile->update([
                'name' => $this->student_name,
                'tel' => $this->student_tel,
                'ic_no' => $this->student_ic,
                'email' => $this->student_email,
                'passport_no' => $this->student_passport,

            ]);            $record->update([
                'student_id' => $this->student_id,
                'vaccine_type' => $this->vaccine_type,
                'second_dose' => $this->second_dose,
                'address' => $this->address,
                'flight_routing' => $this->flight_routing,
                'date_arrival' => $this->date_arrival
            ]);
            $record_parent->update([
                'name' => $this->parent_name, 'contact_no' => $this->parent_tel, 'address' => $this->parent_address, 'email'=> $this->parent_email
            ]);
            // $this->resetInput();
            $this->updateMode = false;
            session()->flash('message', 'Administration Successfully updated.');
        }
    }
    public function export()
    {
        # code...
        return Excel::download(new AdministrationExport($this->selected_academic_term, $this->keyWord), 'administration_'.Carbon::now().'.xlsx');
    }
    public function destroy($id)
    {
        if ($id) {
            $record = Administration::where('id', $id);
            $record->delete();
        }
    }
}
