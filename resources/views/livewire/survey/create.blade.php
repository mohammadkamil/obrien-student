<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New Student</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="student_profile_id"></label>
                        <input wire:model="student_profile_id" type="text" class="form-control" id="student_profile_id"
                            placeholder="Student Profile Id">@error('student_profile_id') <span
                            class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="programme_id"></label>
                        <input wire:model="programme_id" type="text" class="form-control" id="programme_id"
                            placeholder="Programme Id">@error('programme_id') <span
                            class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="institution_id"></label>
                        <input wire:model="institution_id" type="text" class="form-control" id="institution_id"
                            placeholder="Institution Id">@error('institution_id') <span
                            class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="academic_term_id"></label>
                        <input wire:model="academic_term_id" type="text" class="form-control" id="academic_term_id"
                            placeholder="Academic Term Id">@error('academic_term_id') <span
                            class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="campus_id"></label>
                        <input wire:model="campus_id" type="text" class="form-control" id="campus_id"
                            placeholder="Campus Id">@error('campus_id') <span
                            class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                <button type="button" wire:click="store()" wire:loading.attr="disabled"
                    class="btn btn-primary close-modal">Save</button>
            </div>
        </div>
    </div>
</div>
