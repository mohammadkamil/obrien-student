<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Studentprofile</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close" wire:click.prevent="cancel()">
                </button>
            </div>
            <div class="modal-body">
                <form>
					<input type="hidden" wire:model="selected_id">
            <div class="form-group">
                <label for="name"></label>
                <input wire:model="name" type="text" class="form-control" id="name" placeholder="Name">@error('name') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="tel"></label>
                <input wire:model="tel" type="text" class="form-control" id="tel" placeholder="Tel">@error('tel') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="ic_no"></label>
                <input wire:model="ic_no" type="text" class="form-control" id="ic_no" placeholder="Ic No">@error('ic_no') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="email"></label>
                <input wire:model="email" type="text" class="form-control" id="email" placeholder="Email">@error('email') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="gander"></label>
                <input wire:model="gander" type="text" class="form-control" id="gander" placeholder="Gander">@error('gander') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="funding"></label>
                <input wire:model="funding" type="text" class="form-control" id="funding" placeholder="Funding">@error('funding') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="student_no"></label>
                <input wire:model="student_no" type="text" class="form-control" id="student_no" placeholder="Student No">@error('student_no') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="fees"></label>
                <input wire:model="fees" type="text" class="form-control" id="fees" placeholder="Fees">@error('fees') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="update()" wire:loading.attr="disabled" class="btn btn-primary" data-dismiss="modal">Save</button>
            </div>
       </div>
    </div>
</div>
