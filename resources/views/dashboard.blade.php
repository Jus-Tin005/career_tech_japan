@extends('layouts.app')
@section('content')
    {{-- Current Page Title --}}
    <h1 class="h3 mb-3 current-page-title">
        <strong>{{ ucfirst(\Request::segment(1)) }}</strong>
        /
        <a
            href="{{ url()->previous() }}">{{ \Str::title(preg_replace('/[[:punct:]]+[[:alnum:]]+/', '', str_replace(\Request::root() . '/', '', url()->previous()))) }}</a>
    </h1>


    {{-- Begin:Total List --}}
    <div class="row">
        <div class="col-xl-12 col-xxl-12 d-flex">
            <div class="w-100">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Total Companies</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="bi bi-bank align-middle"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">{{ $total_company }}</h1>
                                <div class="mb-0">
                                    <span class="text-muted">{{ $today }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Total Employess</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle bi bi-people"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">{{ $total_employee }}</h1>
                                <div class="mb-0">
                                    <span class="text-muted">{{ $today }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Total Users</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle bi bi-person"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">{{ $total_user }}</h1>
                                <div class="mb-0">
                                    <span class="text-muted">{{ $today }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End:Total List --}}


    {{-- Begin:Recent Company Table List --}}
        <div class="row mb-3">
            <div class="col-12">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Recent Company</h5>
                    </div>

                    {{-- Table List --}}
                    <table class="table table-hover my-0">
                        <thead>
                            <tr>
                                <th class="text-center">Company Logo</th>
                                <th class="text-center">Company Name</th>
                                <th class="text-center">Company Email</th>
                                <th class="text-center">Company Website</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recent_companies as $company)
                                <tr>
                                    <td class="text-center">
                                        @if ($company->logo)
                                            <img src="{{ $company->logo }}" class="img-fluid rounded object-fit-cover"
                                                width="50" height="50" alt="{{ $company->name ?? null }}">
                                        @else
                                            <img src="{{ asset('assets/image/default-image/default.png') }}"
                                                class="img-fluid rounded object-fit-cover" width="50" height="50"
                                                alt="{{ $company->name ?? null }}">
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ $company->name ?? null }}
                                    </td>
                                    <td class="text-center">
                                        {{ $company->email ?? null }}
                                    </td>
                                    <td class="text-center">
                                        {{ $company->website ?? null }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    {{-- End:Recent Company Table List --}}


    {{-- Begin:Recent Employee Table List --}}
    <div class="row">
        <div class="col-12">
            <div class="card flex-fill">
                <div class="card-header">
                    <h5 class="card-title mb-0">Recent Employee</h5>
                </div>

                {{-- Table List --}}
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th class="text-center">Employee Profile</th>
                            <th class="text-center">Employee Name</th>
                            <th class="text-center">Employee Email</th>
                            <th class="text-center">Employee phone</th>
                            <th class="text-center">Employee Company</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recent_employees as $employee)
                            <tr>
                                <td class="text-center">
                                    @if ($employee->profile)
                                        <img src="{{ $employee->profile }}" class="img-fluid rounded object-fit-cover"
                                            width="50" height="50" alt="{{ $employee->name ?? null }}">
                                    @else
                                        <img src="{{ asset('assets/image/default-image/default.png') }}"
                                            class="img-fluid rounded object-fit-cover" width="50" height="50"
                                            alt="{{ $employee->name ?? null }}">
                                    @endif
                                </td>
                                <td class="text-center">
                                    {{ $employee->name ?? null }}
                                </td>
                                <td class="text-center">
                                    {{ $employee->email ?? null }}
                                </td>
                                <td class="text-center">
                                    {{ $employee->phone ?? null }}
                                </td>
                                <td class="text-center">
                                    {{ $employee->company->name ?? null }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- End:Recent Employee Table List --}}



@endsection
