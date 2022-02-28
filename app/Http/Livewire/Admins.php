<?php

namespace App\Http\Livewire;

use App\Models\Roles;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Admins extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $name, $email, $password, $role;
    public $updateMode = false;

    public function render()
    {
        $keyWord = '%' . $this->keyWord . '%';

        if (auth()->user()->hasRole("super admin")) {
            $roles = Roles::all();
            $admin = User::with('rolesadmin.role')->latest()
                ->orWhere('name', 'LIKE', $keyWord)
                ->orWhere('email', 'LIKE', $keyWord)
                ->orWhere('password', 'LIKE', $keyWord)
                // ->orWhere('role', 'LIKE', $keyWord)
                ->paginate(10);
        } else if (auth()->user()->hasRole("admin malaysia")) {
            $roles = Roles::where("name", '=', "admin malaysia")->get();
            $admin = User::with('rolesadmin.role')->whereHas(
                'roles',
                function ($q) {
                    $q->where('name', 'admin malaysia');
                }
            )->latest()
                ->orWhere('name', 'LIKE', $keyWord)
                ->orWhere('email', 'LIKE', $keyWord)
                ->orWhere('password', 'LIKE', $keyWord)
                // ->orWhere('role', 'LIKE', $keyWord)
                ->paginate(10);
        } else if (auth()->user()->hasRole("admin iceland")) {
            $roles = Roles::where("name", '=', "admin iceland")->get();
            $admin = User::with('rolesadmin.role')->whereHas(
                'roles',
                function ($q) {
                    $q->where('name', 'admin iceland');
                }
            )->latest()
                ->orWhere('name', 'LIKE', $keyWord)
                ->orWhere('email', 'LIKE', $keyWord)
                ->orWhere('password', 'LIKE', $keyWord)
                // ->orWhere('role', 'LIKE', $keyWord)
                ->paginate(10);
        }

        return view('livewire.admin.view', [
            'admin' => $admin,
            'roles'=>$roles
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
        $this->email = null;
        $this->password = null;
        $this->role = null;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:8',
            'role' => 'required',
        ]);

        $users=User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password)
        ]);
        $roles=Roles::where('id','=',$this->role)->get();
        // dd($roles);
        $users->assignRole($roles[0]->name);
        $this->resetInput();
        $this->emit('closeModal');
        session()->flash('message', 'Admin Successfully created.');
    }

    public function edit($id)
    {
        // dd(1);
        // $record = User::findOrFail($id);
        $record = User::with('rolesadmin.role')->findOrFail($id);

        $this->selected_id = $id;
        $this->name = $record->name;
        $this->email = $record->email;
        $this->password = $record->password;
        $this->role = $record->rolesadmin->role_id;

        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            // 'email' => 'required',	'password' => 'required',
            // 'role' => 'required',
        ]);

        if ($this->selected_id) {
            $record = User::find($this->selected_id);
            $record->update([
                'name' => $this->name,
                'email' => $this->email
            ]);

            $this->resetInput();
            $this->updateMode = false;
            session()->flash('message', 'Admin Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = User::where('id', $id);
            $record->delete();
        }
    }
}
