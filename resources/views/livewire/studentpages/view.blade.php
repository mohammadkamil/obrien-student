@section('title', __('Students'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4>
							Student Listing </h4>
						</div>

						@if (session()->has('message'))

                            <div wire:poll.500ms>
                                <script >
                                    toastrsuccess("{{ session('message') }}");
                                </script>
                            </div>

                        @endif
                        @if (session()->has('errorU'))

                            <div wire:poll.500ms>
                                <script >
                                    toastrerror("{{ session('errorU') }}");
                                </script>
                            </div>
                        @endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Search Students">
						</div>
						<div class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal">
						<i class="bi bi-plus-square"></i>
						</div>
					</div>
				</div>

				<div class="card-body">  <div wire:loading wire:target="update">
                        <div class="loading">Loading&#8230;</div>
                    </div> <div wire:loading wire:target="store">
                        <div class="loading">Loading&#8230;</div>
                    </div>
                    <div wire:loading wire:target='destroy'>
                        <div class="loading " >Loading&#8230;</div>

                    </div>
                    <div wire:loading wire:target='edit'>
                        <div class="loading" >Loading&#8230;</div>

                    </div>

						@include('livewire.students.create')
						@include('livewire.students.update')
				<div class="table-responsive">
                        <table class="table ">
                            <thead class="thead">
							<tr>
								<th>#</th>
								<th>Student Profile Id</th>
								<th>Programme Id</th>
								<th>Institution Id</th>
								<th>Academic Term Id</th>
								<th>Campus Id</th>
								<th>ACTIONS</th>
							</tr>
						</thead>
						<tbody>
							@foreach($students as $row)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $row->student_profile_id }}</td>
								<td>{{ $row->programme_id }}</td>
								<td>{{ $row->institution_id }}</td>
								<td>{{ $row->academic_term_id }}</td>
								<td>{{ $row->campus_id }}</td>
								<td width="90">
								<div class="dropdown">
                                    <button class="btn btn-danger
                                       " type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class='bx bx-dots-vertical-rounded'></i>
									</button>
									                                                <div class="dropdown-menu dropdown-menu-left">

									<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="bi bi-pencil-square"></i> Edit </a>
									<a class="dropdown-item" onclick="confirm('Confirm Delete Student id {{$row->id}}? \nDeleted Students cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="bi bi-trash"></i> Delete </a>
									</div>
								</div>
								</td>
							@endforeach
						</tbody>
					</table>
					{{ $students->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
