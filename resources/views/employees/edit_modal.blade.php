<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Employee</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="update-form" action="{{ route('employees.update',$employee->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-sm-6 ps-5">
                        <div class="row">
                            <label for="edit_name" class="col-sm-2 col-form-label p-0">Name:*</label>
                            <div class="col-sm-10 p-0">
                                <input type="text" class="form-control"
                                    id="edit_name" name="edit_name" value="{{ $employee->name }}">

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 ps-5">
                        <div class="row">
                            <label for="email" class="col-sm-2 col-form-label p-0">Email:</label>
                            <div class="col-sm-10 p-0">
                                <input type="email" class="form-control" name="email"
                                value="{{ $employee->email ?? null }}">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row mb-3">
                    <div class="col-sm-6 ps-5">
                        <div class="row">
                            <label for="phone" class="col-sm-2 col-form-label p-0">Phone:</label>
                            <div class="col-sm-10 p-0">
                                <input type="text" class="form-control" name="phone"
                                value="{{ $employee->phone ?? null }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 ps-5">
                        <div class="row">
                            <label for="profile" class="col-sm-2 col-form-label p-0">Profile:</label>
                            <div class="col-sm-10 p-0">
                                <input type="file" class="form-control" name="profile">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-6 ps-5">
                        <div class="row">
                            <label for="edit_company_id" class="col-3 col-form-label p-0">Company:*</label>
                            <div class="col-sm-9 p-0">
                                <select name="edit_company_id" class="form-control" value="">
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->id }}" @if ($employee->company_id == $company->id) selected @endif>{{ $company->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary ms-2 update-btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
