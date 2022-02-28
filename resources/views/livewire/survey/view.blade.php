@section('title', __('Survey'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <h4>
                                Subject Listing </h4>
                        </div>

                        @if (session()->has('message'))

                            <div wire:poll.500ms>
                                <script>
                                    toastrsuccess("{{ session('message') }}");
                                </script>
                            </div>

                        @endif
                        @if (session()->has('errorU'))

                            <div wire:poll.500ms>
                                <script>
                                    toastrerror("{{ session('errorU') }}");
                                </script>
                            </div>
                        @endif

                    </div>
                </div>

                <div class="card-body">
                    <div wire:loading wire:target="update">
                        <div class="loading">Loading&#8230;</div>
                    </div>
                    <div wire:loading wire:target="store">
                        <div class="loading">Loading&#8230;</div>
                    </div>
                    <div wire:loading wire:target='destroy'>
                        <div class="loading ">Loading&#8230;</div>

                    </div>
                    <div wire:loading wire:target='edit'>
                        <div class="loading">Loading&#8230;</div>

                    </div>

                    @include('livewire.survey.create')
                    @include('livewire.survey.update')
                    @include('livewire.survey.survey')
                    <div class="table-responsive">
                        <table class="table ">
                            <thead class="thead">
                                <tr>
                                    <th>#</th>
                                    <th>Subject Name</th>
                                    <th>Lecturer Name</th>

                                    <th>Survey Status</th>
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>
                            {{-- {{ dd($subject) }} --}}
                            <tbody>
                                @foreach ($subject as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $row->name }}</td>
                                        <td>
                                            @isset($row->lecturer->name)
                                                {{ $row['lecturer']['name'] }}
                                            @endisset
                                        </td>
                                        <td>
                                            @if (isset($row->survey->subject_id))
                                                done

                                            @else
                                                Not Yet
                                            @endif
                                        </td>
                                        <td width="90">
                                            @if (isset($row->survey->subject_id))
                                                Completed

                                            @else
                                                <button class="btn btn-danger" data-toggle="modal"
                                                    data-target="#surveymodal"
                                                    wire:click='surversubjectid({{ $row->id }})'>Survey</button>
                                            @endif
                                        </td>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $subject->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
