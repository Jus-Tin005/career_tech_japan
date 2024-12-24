@extends('layouts.app')
@section('content')
    {{-- Current Page Title --}}
    <h1 class="h3 mb-3 current-page-title">
        <strong>{{ ucfirst(\Request::segment(1)) }}</strong>
        /
        <a
            href="{{ url()->previous() }}">{{ \Str::title(preg_replace('/[[:punct:]]+[[:alnum:]]+/', '', str_replace(\Request::root() . '/', '', url()->previous()))) }}</a>
    </h1>




    {{-- Begin:Create Data --}}
    <div class="row">
        <div class="col-12">
            <div class="card flex-fill">
                <div class="card-body">
                    <h5 class="card-title mb-3">Create Employee</h5>

                    <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-sm-6 ps-5">
                                <div class="row">
                                    <label for="name" class="col-sm-2 col-form-label p-0">Name:*</label>
                                    <div class="col-sm-10 p-0">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" placeholder="Enter company name">
                                        @error('name')
                                            <span class="mt-2 invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 ps-5">
                                <div class="row">
                                    <label for="email" class="col-sm-2 col-form-label p-0">Email:</label>
                                    <div class="col-sm-10 p-0">
                                        <input type="email" class="form-control" name="email"
                                            placeholder="Enter company email">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-6 ps-5">
                                <div class="row">
                                    <label for="logo" class="col-sm-2 col-form-label p-0">Logo:</label>
                                    <div class="col-sm-10 p-0">
                                        <input type="file" class="form-control" name="logo">
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12 ps-5">
                                <div class="row">
                                    <label for="website" class="col-1 col-form-label p-0">Website:</label>
                                    <div class="col-sm-11 p-0">
                                        <input type="text" class="form-control" name="website"
                                            placeholder="Enter company website">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3 float-end">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
    {{-- End:Create Data --}}

    {{-- Begin:Table List --}}
    <div class="row">
        <div class="col-12">
            <div class="card flex-fill">
                <div class="card-header">
                    <h5 class="card-title mb-0">List Of Companies</h5>
                </div>
                {{-- Search & Filter --}}
                <div class="row g-3 align-items-center mb-4">
                    <!-- Search Bar -->
                    <div class="col-md-6 ps-3" style="padding-top: 30px;">
                        <form class="d-flex" method="GET" action="{{ route('companies.index') }}">
                            <input type="text" name="search" class="form-control me-2" placeholder="Search by keyword"
                                title="Enter search keyword">
                            <button type="submit" class="btn btn-sm rounded-sm btn-primary">
                                <i class="bi bi-search fs-6"></i>
                            </button>
                        </form>
                    </div>

                    <!-- Date Range Filter -->
                    <div class="col-md-6">
                        <form method="GET" action="{{ route('companies.index') }}" class="row g-2">
                            <div class="col">
                                <label for="start-date" class="form-label fs-6">Start Date</label>
                                <input type="date" id="start-date" name="start_date" class="form-control"
                                    title="Select start date">
                            </div>
                            <div class="col">
                                <label for="end-date" class="form-label fs-6">End Date</label>
                                <input type="date" id="end-date" name="end_date" class="form-control"
                                    title="Select end date">
                            </div>
                            <div class="col-auto align-self-end pe-3">
                                <button type="submit" class="btn btn-sm btn-secondary rounded-sm">
                                    <i class="bi bi-funnel fs-6"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>


                {{-- Table List --}}
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th class="text-center">Company Logo</th>
                            <th class="text-center">Company Name</th>
                            <th class="text-center">Company Email</th>
                            <th class="text-center">Company Website</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($companies as $company)
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
                                <td class="text-center">
                                    <a data-href="{{ route('companies.edit', $company->id) }}"
                                        class="badge bg-info text-decoration-none edit-btn">Edit</a>
                                    <a data-href="{{ route('companies.destroy', $company->id) }}"
                                        class="badge bg-danger text-decoration-none delete-btn">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    {{ $companies->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
    {{-- End:Table List --}}


    {{-- Begin:Edit Modal --}}
    <div class="modal fade" id="edit_modal" tabindex="-1"></div>
    {{-- End:Edit Modal --}}
@endsection
@section('script')
    <script>
        $(document).ready(function() {

            // Global Token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });



            /* Begin:Edit */
            $(document).on('click', 'a.edit-btn', function(e) {
                e.preventDefault();
                var url = $(this).data('href');

                $.ajax({
                    method: 'GET',
                    url: url,
                    dataType: 'json',
                    success: function(result) {
                        if (result.success == true) {
                            $('#edit_modal').html(result.html);
                            $('#edit_modal').modal('show');
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text: result.msg,
                                icon: "error"
                            });
                        }
                    }
                });
            });
            /* End:Edit */


            /* Begin:Update */

            $('#edit_modal').on('shown.bs.modal', function() {
                $('form#update-form').validate({
                    rules: {
                        edit_name: {
                            required: true,
                        },
                    },
                    messages: {
                        edit_name: {
                            required: "Enter company name",
                        },
                    },
                    errorPlacement: function(error, element) {
                        error.addClass('text-danger pt-2');
                        error.insertAfter(element);
                    },
                    submitHandler: function(form) {
                        var url = $(form).attr('action');
                        var formData = new FormData(form);

                        $.ajax({
                            method: 'POST',
                            url: url,
                            dataType: 'json',
                            data: formData,
                            processData: false,
                            contentType: false,
                            beforSend:function(){
                                $('.update-btn').text('Sending...');
                                $('.update-btn').attr('disabled',true);
                            },
                            success: function(result) {
                                if (result.success) {
                                    $('#edit_modal').modal('hide');
                                    Swal.fire({
                                        title: "Success!",
                                        text: result.msg,
                                        icon: "success",
                                    });
                                    window.location.reload();
                                } else {
                                    Swal.fire({
                                        title: "Error!",
                                        text: result.msg,
                                        icon: "error",
                                    });
                                }
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    title: "Error!",
                                    text: "An error occurred while processing the request.",
                                    icon: "error",
                                });
                            },
                        });
                    },
                });
            });

            /* End:Update */




            /* Begin:Delete */
            $(document).on('click', 'a.delete-btn', function(e) {
                e.preventDefault();
                var url = $(this).data('href');
                var deleteBtn = $(this);
                Swal.fire({
                    title: "Are you sure?",
                    text: `You won't be able to revert !`,
                    icon: "warning",
                    showCancelButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: 'DELETE',
                            url: url,
                            dataType: 'json',
                            success: function(result) {
                                if (result.success == true) {
                                    deleteBtn.closest('tr').remove();
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: result.msg,
                                        icon: "success"
                                    });
                                } else {
                                    Swal.fire({
                                        title: "Error!",
                                        text: result.msg,
                                        icon: "error"
                                    });
                                }
                            }
                        });
                    }
                });
            });
            /* End:Delete */
        });
    </script>
@endsection
