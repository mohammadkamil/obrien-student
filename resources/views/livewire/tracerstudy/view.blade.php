@section('title', __('Tracer Study'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">


                <div class="card-body">
                    @if (session()->has('message'))
                        <div wire:poll.500ms>
                            <script>
                                $('#exampleModal').hide();
                                $(".modal-backdrop ").remove();
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

                    @include('livewire.tracerstudy.create')
                    @php
                        // dd($tracer)
                        // && isset($student->graduate_year) &&
                        // dd($alumni->graduate_year.'-1');
                    @endphp
                    @if (!isset($tracer[0]))

                        @if (isset($alumni->graduate_year))
                            @php
                                $dategratuate = Carbon\Carbon::parse($alumni->graduate_year . '-1');
                                $datenow = Carbon\Carbon::now();
                                // dd($dategratuate);
                                $diff_in_months = $dategratuate->diffInMonths($datenow);
                                // dd($diff_in_months)
                            @endphp
                            @if ($diff_in_months > 6)
                                <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal"
                                    style="height: 250px;width: 250px;">
                                    Make Tracer Study
                                </button>
                            @else
                                <button class="btn btn-sm btn-danger" style="height: 250px;width: 250px;">
                                    Not Ready
                                </button>
                            @endif



                        @else
                            <button class="btn btn-sm btn-danger" style="height: 250px;width: 250px;">
                                Not Ready
                            </button>
                        @endif

                    @else
                        <div class="card">
                            <div class="card-header">
                                Status Study: {{ $tracer[0]->study_status }}
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <tr>
                                        <th>Current address</th>
                                        <td>{{ $tracer[0]->current_address }}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone No</th>
                                        <td>{{ $tracer[0]->phone_no }}</td>
                                    </tr>
                                    <tr>
                                        <th>Employer Name</th>
                                        <td> {{ $tracer[0]->employer_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Employer Address</th>
                                        <td> {{ $tracer[0]->employer_address }}</td>
                                    </tr>
                                    <tr>
                                        <th>Working Status</th>
                                        <td> {{ $tracer[0]->working_status }}</td>
                                    </tr>
                                    <tr>
                                        <th>Job Position</th>
                                        <td> {{ $tracer[0]->working_jobposition }}</td>
                                    </tr>
                                    <tr>
                                        <th>Salary</th>
                                        <td>
                                            @if ($tracer[0]->salary == 1)
                                                {{ '<RM 1- 2K' }}
                                            @elseif ($tracer[0]->salary == 2)
                                                {{ '>RM 2K -4K' }}

                                            @elseif ($tracer[0]->salary == 3)
                                                {{ '>RM 4K - 6K ' }}

                                            @elseif ($tracer[0]->salary == 4)
                                                {{ '> RM 6K' }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Further Study</th>
                                        <td> {{ $tracer[0]->futher_study }}</td>
                                    </tr>
                                </table>


                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
