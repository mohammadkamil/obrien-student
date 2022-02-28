@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                {{-- @livewire('students') --}}
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card">

                                <div class="card-body">

                                    <button class="btn btn-danger" style="width: 49%;height: 250px;font-size: 50px" onclick="location.href='{{ url('/survey') }}'">Survey</button>
                                    <button class="btn btn-danger" style="width: 49%;height: 250px;font-size: 50px" onclick="location.href='{{ url('/tracerstudy') }}'">Tracer Study</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
