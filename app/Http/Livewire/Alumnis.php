<?php

namespace App\Http\Livewire;

use App\Exports\AlumniExport;
use App\Models\Academicterm;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Alumni;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class Alumnis extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $student_id, $graduate_year, $status, $selected_academic_term;
    public $updateMode = false;

    public function render()
    {
        $this->graduate_year=Carbon::now()->format('Y');
        $academicterm = Academicterm::orderBy('status', 'desc')->get();

        $keyWord = '%' . $this->keyWord . '%';
        // return view('livewire.alumnis.view', [
        //     'alumnis' => Alumni::latest()
        //         ->orWhere('student_id', 'LIKE', $keyWord)
        //         ->orWhere('graduate_year', 'LIKE', $keyWord)
        //         ->orWhere('status', 'LIKE', $keyWord)
        //         ->paginate(10), 'academicterm' => $academicterm,
        // ]);
        if ($this->selected_academic_term != "" || $this->selected_academic_term != null) {
            // return view('livewire.intake.view', [
            //     'intakes' => Student::with('studentprofile','programme','institution','campus','academicterm')->latest()->Where('academic_term_id','=',$this->selected_academic_term)
            //                 ->paginate(10),'academicterm'=>$academicterm
            // ]);
            $count = Student::where('status','=',5)->where('academic_term_id', '=', $this->selected_academic_term)
                ->Where(function ($query) use ($keyWord) {
                    $query->orwhereHas('studentprofile', function ($query) use ($keyWord) {
                        $query->where('name', 'like', $keyWord );
                    })
                        ->orwhereHas('alumnis', function ($query) use ($keyWord) {
                            $query->where('graduate_year', 'like', $keyWord);
                        })
                        ->orwhereHas('alumnis', function ($query) use ($keyWord) {
                            $query->where('status', 'like', $keyWord );
                        });
                })->get()->count();

            return view('livewire.alumnis.view', [
                'alumnis' => Student::with('studentprofile', 'programme', 'institution', 'campus', 'academicterm','alumnis')->latest()->where('status','=',5)->where('academic_term_id', '=', $this->selected_academic_term)
                    ->Where(function ($query) use ($keyWord) {
                        $query->orwhereHas('studentprofile', function ($query) use ($keyWord) {
                            $query->where('name', 'like', $keyWord);
                        })
                            ->orwhereHas('alumnis', function ($query) use ($keyWord) {
                                $query->where('graduate_year', 'like', $keyWord );
                            })
                            ->orwhereHas('alumnis', function ($query) use ($keyWord) {
                                $query->where('status', 'like', $keyWord );
                            });
                    })->paginate(10), 'academicterm' => $academicterm,"count"=>$count
            ]);
        } else {
            $count = Student::where('status','=',5)->Where(function ($query) use ($keyWord) {$query->orwhereHas('studentprofile', function ($query) use ($keyWord) {
                $query->where('name', 'like', $keyWord );
            })
            ->orwhereHas('alumnis', function ($query) use ($keyWord) {
                $query->where('graduate_year', 'like', $keyWord);
            })
            ->orwhereHas('alumnis', function ($query) use ($keyWord) {
                $query->where('status', 'like', $keyWord );
            });})->get()->count();


            return view('livewire.alumnis.view', [
                'alumnis' => Student::with('studentprofile', 'programme', 'institution', 'campus', 'academicterm','alumnis')->latest()->where('status','=',5) ->Where(function ($query) use ($keyWord) {$query->orwhereHas('studentprofile', function ($query) use ($keyWord) {
                    $query->where('name', 'like', $keyWord);
                })
                ->orwhereHas('alumnis', function ($query) use ($keyWord) {
                    $query->where('graduate_year', 'like', $keyWord );
                })
                ->orwhereHas('alumnis', function ($query) use ($keyWord) {
                    $query->where('status', 'like', $keyWord );
                });})->paginate(10), 'academicterm' => $academicterm,"count"=>$count
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
        $this->student_id = null;
        $this->graduate_year = null;
        $this->status = null;
    }

    public function store()
    {
        $this->validate([
            'student_id' => 'required',
            'graduate_year' => 'required',
            'status' => 'required',
        ]);

        Alumni::create([
            'student_id' => $this->student_id,
            'graduate_year' => $this->graduate_year,
            'status' => $this->status
        ]);

        $this->resetInput();
        $this->emit('closeModal');
        session()->flash('message', 'Alumni Successfully created.');
    }

    public function edit($id)
    {
        $record = Alumni::findOrFail($id);

        $this->selected_id = $id;
        $this->student_id = $record->student_id;
        $this->graduate_year = $record->graduate_year;
        $this->status = $record->status;

        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'graduate_year' => 'required',
            'status' => 'required',
        ]);

        if ($this->selected_id) {
            $record = Alumni::find($this->selected_id);
            $record->update([
                'student_id' => $this->student_id,
                'graduate_year' => $this->graduate_year,
                'status' => $this->status
            ]);

            $this->resetInput();
            $this->updateMode = false;
            session()->flash('message', 'Alumni Successfully updated.');
        }
    }
    public function export()
    {
        # code...
        return Excel::download(new AlumniExport($this->selected_academic_term, $this->keyWord), 'alumni_'.Carbon::now().'.xlsx');
    }
    public function destroy($id)
    {
        if ($id) {
            $record = Alumni::where('id', $id);
            $record->delete();
            session()->flash('message', 'Academicterm Successfully deleted.');
        }
    }
}
