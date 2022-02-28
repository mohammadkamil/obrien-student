<?php

namespace App\Http\Livewire;

use App\Models\Institution;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Lecturer;
use App\Models\Programme;
use App\Models\Subject;

class Lecturers extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $institution_id, $programme_id, $subject_id, $name, $email,$password,$status;
    public $updateMode = false;

    public function render()
    {

        if($this->institution_id !=null&&$this->programme_id==null){
            $institution=Institution::all();
            $programme=Programme::where('institution_id','=',$this->institution_id)->get();
            $keyWord = '%'.$this->keyWord .'%';
            return view('livewire.lecturers.view', [
                'lecturers' => Lecturer::latest()
                            ->orWhere('institution_id', 'LIKE', $keyWord)
                            ->orWhere('programme_id', 'LIKE', $keyWord)
                            ->orWhere('subject_id', 'LIKE', $keyWord)
                            ->orWhere('name', 'LIKE', $keyWord)
                            ->orWhere('email', 'LIKE', $keyWord)
                            ->paginate(10),
                'institutions'=>$institution,
                'programmes'=>$programme,
                'subjects'=>[],
            ]);
        }elseif($this->institution_id !=null&&$this->programme_id!=null){
            $institution=Institution::all();
            $programme=Programme::where('institution_id','=',$this->institution_id)->get();
            $subject=Subject::where('programme_id','=',$this->programme_id)->get();
            // dd($this->programme_id);
            $keyWord = '%'.$this->keyWord .'%';
            return view('livewire.lecturers.view', [
                'lecturers' => Lecturer::latest()
                            ->orWhere('institution_id', 'LIKE', $keyWord)
                            ->orWhere('programme_id', 'LIKE', $keyWord)
                            ->orWhere('subject_id', 'LIKE', $keyWord)
                            ->orWhere('name', 'LIKE', $keyWord)
                            ->orWhere('email', 'LIKE', $keyWord)
                            ->paginate(10),
                'institutions'=>$institution,
                'programmes'=>$programme,
                'subjects'=>$subject,
            ]);
        }else{
            $institution=Institution::all();
            $keyWord = '%'.$this->keyWord .'%';
            return view('livewire.lecturers.view', [
                'lecturers' => Lecturer::latest()
                            ->orWhere('institution_id', 'LIKE', $keyWord)
                            ->orWhere('programme_id', 'LIKE', $keyWord)
                            ->orWhere('subject_id', 'LIKE', $keyWord)
                            ->orWhere('name', 'LIKE', $keyWord)
                            ->orWhere('email', 'LIKE', $keyWord)
                            ->paginate(10),
                'institutions'=>$institution,
                'programmes'=>[],
                'subjects'=>[],
            ]);
        }

    }

    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }

    private function resetInput()
    {
		$this->institution_id = null;
		$this->programme_id = null;
		$this->subject_id = null;
		$this->name = null;
		$this->email = null;
		$this->password = null;
		$this->status = null;
    }

    public function store()
    {
        $this->validate([
		'email' => 'required',
        ]);

        Lecturer::create([
			'institution_id' => $this-> institution_id,
			'programme_id' => $this-> programme_id,
			'subject_id' => $this-> subject_id,
			'name' => $this-> name,
			'email' => $this-> email,
            'password'=>bcrypt($this->password),
            'status'=>1
        ]);

        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Lecturer Successfully created.');
    }

    public function edit($id)
    {
        $record = Lecturer::findOrFail($id);

        $this->selected_id = $id;
		$this->institution_id = $record-> institution_id;
		$this->programme_id = $record-> programme_id;
		$this->subject_id = $record-> subject_id;
		$this->name = $record-> name;
		$this->email = $record-> email;
		$this->password = $record-> password;

        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'email' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Lecturer::find($this->selected_id);
            $record->update([
			'institution_id' => $this-> institution_id,
			'programme_id' => $this-> programme_id,
			'subject_id' => $this-> subject_id,
			'name' => $this-> name,
			'email' => $this-> email,
            'password'=>bcrypt($this->password)

            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Lecturer Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Lecturer::where('id', $id);
            $record->delete();
        }
    }public function updatestatus($id,$termstatus)
    {
        if ($termstatus == 1) {

                $record = Lecturer::find($id);
                $record->update([

                    'status' =>$termstatus
                ]);

                $this->resetInput();
                // $this->updateMode = false;
                session()->flash('message', 'Status lecturer have Successfully updated.');

        } else {
            $record = Lecturer::find($id);
            $record->update([

                'status' => $termstatus
            ]);

            $this->resetInput();
            // $this->updateMode = false;
            session()->flash('message', 'Status lecturer have Successfully updated.');
        }}
}
