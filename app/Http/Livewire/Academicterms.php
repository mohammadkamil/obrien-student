<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Academicterm;

class Academicterms extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $name, $start_date, $end_date;
    public $updateMode = false;
    public $status;
    public function render()
    {

        $keyWord = '%' . $this->keyWord . '%';
        return view('livewire.academicterms.view', [
            'academicterms' => Academicterm::latest()
                ->orWhere('name', 'LIKE', $keyWord)
                ->orWhere('start_date', 'LIKE', $keyWord)
                ->orWhere('end_date', 'LIKE', $keyWord)
                ->orWhere('status', 'LIKE', $keyWord)
                ->paginate(10),
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
        $this->start_date = null;
        $this->end_date = null;
        $this->status = 0;
    }

    public function store()
    {

        // if(auth()->user()){
        //     auth()->user()->assignRole('superadmin');
        // }
        $this->validate([
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            // 'student_id' => 'required',

        ]);
        if ($this->status == 1) {
            $activeacademic = Academicterm::where("status", '=', 1)->where('id', '!=', $this->selected_id)->get();
            if (sizeof($activeacademic) == 0) {


                Academicterm::create([
                    'name' => $this->name,
                    'start_date' => $this->start_date,
                    'end_date' => $this->end_date,
                    'status' => $this->status
                ]);

                $this->resetInput();
                $this->emit('closeModal');
                session()->flash('message', 'Academicterm Successfully created.');
            } else {
                session()->flash('errorU', 'Only one academic term can be active');
            }
        } else {
            Academicterm::create([
                'name' => $this->name,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'status' => $this->status
            ]);

            $this->resetInput();
            $this->emit('closeModal');
            session()->flash('message', 'Academicterm Successfully created.');
        }
    }
public function updatestatus($id,$termstatus)
{
    if ($termstatus == 1) {
        $activeacademic = Academicterm::where("status", '=', 1)->where('id', '!=', $id)->get();
        if (sizeof($activeacademic) == 0) {


            $record = Academicterm::find($id);
            $record->update([

                'status' => $termstatus
            ]);

            $this->resetInput();
            // $this->updateMode = false;
            session()->flash('message', 'Academicterm Successfully updated.');
        } else {
            session()->flash('errorU', 'Only one academic term can be active');
        }
    } else {
        $record = Academicterm::find($id);
        $record->update([

            'status' => $termstatus
        ]);

        $this->resetInput();
        // $this->updateMode = false;
        session()->flash('message', 'Academicterm Successfully updated.');
    }}
    public function edit($id)
    {
        $record = Academicterm::findOrFail($id);

        $this->selected_id = $id;
        $this->name = $record->name;
        $this->start_date = $record->start_date;
        $this->end_date = $record->end_date;
        $this->status = $record->status;

        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        if ($this->selected_id) {
            if ($this->status == 1) {
                $activeacademic = Academicterm::where("status", '=', 1)->where('id', '!=', $this->selected_id)->get();
                if (sizeof($activeacademic) == 0) {


                    $record = Academicterm::find($this->selected_id);
                    $record->update([
                        'name' => $this->name,
                        'start_date' => $this->start_date,
                        'end_date' => $this->end_date,
                        'status' => $this->status
                    ]);

                    $this->resetInput();
                    $this->updateMode = false;
                    session()->flash('message', 'Academicterm Successfully updated.');
                } else {
                    session()->flash('errorU', 'Only one academic term can be active');
                }
            } else {
                $record = Academicterm::find($this->selected_id);
                $record->update([
                    'name' => $this->name,
                    'start_date' => $this->start_date,
                    'end_date' => $this->end_date,
                    'status' => $this->status
                ]);

                $this->resetInput();
                $this->updateMode = false;
                session()->flash('message', 'Academicterm Successfully updated.');
            }
            // dd(sizeof($activeacademic));
            // if()

        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Academicterm::where('id', $id);
            $record->delete();
            session()->flash('message', 'Academicterm Successfully deleted.');
        }
    }
}
