<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tracer Study</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="study_status">Status Study</label>
                        {{-- <input wire:model="study_status" type="text" class="form-control" id="study_status"
                            placeholder="Student Profile Id"> --}}
                        <select wire:model="study_status" name="study_status" id="study_status" class="form-control">
                            <option value="">Plaese select status</option>

                            <option value="complete">Complete</option>
                            <option value="1 paper">1 paper</option>
                            <option value="2 paper">2 paper</option>
                            <option value="3 paper">3 paper</option>
                        </select>
                        @error('study_status') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="current_address">Current Address</label>
                        <br>
                        <textarea wire:model="current_address" name="current_address" id="current_address" rows="3" style="width: 100%"></textarea>
                        @error('current_address') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone_no">Phone No</label>
                        <input wire:model="phone_no" type="tel" class="form-control" id="phone_no"
                            placeholder="Phone No:eg 0124567892" minlength="10" maxlength="10">@error('phone_no') <span
                            class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="employer_info">Employer Info</label>
                        <input wire:model="employer_name" type="text" class="form-control" id="employer_name"
                            placeholder="Employer Name">@error('employer_name') <span
                            class="error text-danger">{{ $message }}</span> @enderror
                        <textarea wire:model="employer_address" name="employer_address" id="employer_address" style="width: 100%;margin-top: 5%"
                            rows="3" placeholder="Company Address"></textarea>
                        @error('employer_address') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="working_info">Working Info</label>
                        <select wire:model="working_status" name="working_status" id="working_status" class="form-control">
                            <option value="">Select working status</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                        <input wire:model="working_jobposition" type="text" class="form-control"
                            id="working_jobposition" placeholder="Job Position">
                    </div>
                    <div class="form-group">
                        <label for="salary">Pay Range</label>
                        <select wire:model="salary" name="salary" id="salary" class="form-control">
                            <option value="">Select pay range</option>
                            <option value="1">&#60 RM 1 - 2K</option>
                            <option value="2">&#62 2k - 4K</option>
                            <option value="3">&#62 4K -6K</option>
                            <option value="4">&#62 6K</option>
                        </select>@error('salary') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="futher_study">Further Study</label>
                        <select wire:model="futher_study" name="salary" id="salary" class="form-control">
                            <option value="">Select Further Study status</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>

                        </select>@error('futher_study') <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="store()" wire:loading.attr="disabled"
                    class="btn btn-primary close-modal">Save</button>
            </div>
        </div>
    </div>
</div>
