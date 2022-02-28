<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Address;

class Addresss extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $address1, $address2, $address3, $city, $state, $country, $postcode;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.addresss.view', [
            'addresses' => Address::latest()
						->orWhere('address1', 'LIKE', $keyWord)
						->orWhere('address2', 'LIKE', $keyWord)
						->orWhere('address3', 'LIKE', $keyWord)
						->orWhere('city', 'LIKE', $keyWord)
						->orWhere('state', 'LIKE', $keyWord)
						->orWhere('country', 'LIKE', $keyWord)
						->orWhere('postcode', 'LIKE', $keyWord)
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
		$this->address1 = null;
		$this->address2 = null;
		$this->address3 = null;
		$this->city = null;
		$this->state = null;
		$this->country = null;
		$this->postcode = null;
    }

    public function store()
    {
        $this->validate([
            'address1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'postcode' => 'required',
        ]);

        Address::create([
			'address1' => $this-> address1,
			'address2' => $this-> address2,
			'address3' => $this-> address3,
			'city' => $this-> city,
			'state' => $this-> state,
			'country' => $this-> country,
			'postcode' => $this-> postcode
        ]);

        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Address Successfully created.');
    }

    public function edit($id)
    {
        $record = Address::findOrFail($id);

        $this->selected_id = $id;
		$this->address1 = $record-> address1;
		$this->address2 = $record-> address2;
		$this->address3 = $record-> address3;
		$this->city = $record-> city;
		$this->state = $record-> state;
		$this->country = $record-> country;
		$this->postcode = $record-> postcode;

        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate(['address1' => 'required',
        'city' => 'required',
        'state' => 'required',
        'country' => 'required',
        'postcode' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Address::find($this->selected_id);
            $record->update([
			'address1' => $this-> address1,
			'address2' => $this-> address2,
			'address3' => $this-> address3,
			'city' => $this-> city,
			'state' => $this-> state,
			'country' => $this-> country,
			'postcode' => $this-> postcode
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Address Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Address::where('id', $id);
            $record->delete();            session()->flash('message', 'Academicterm Successfully deleted.');

        }
    }
}
