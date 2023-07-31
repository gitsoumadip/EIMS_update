@extends('backend.structure.structure')
@section('supplier-active', 'active')
@section('title', __('supplier'))
@push('styles')
    <style>
        span {
            color: red;
        }
    </style>
@endpush

@section('main')
    <div class="row bg-secondary rounded p-4 mx-0">

        <div class="col-12">
            <h4>Supplier</h3>
                <hr>
                <div class="px-2 d-flex justify-content-between align-items-end">
                    @include('backend.includes.search-form', [
                        'keyword' => true,
                        'column' => false,
                        // 'column_arr' => [
                        //     'sub_module_name' => 'Name',
                        //     // 'controller_name' => 'Controller',
                        //     'code' => 'Code',
                        // ],
                        'master' => false,
                        // 'master_name' => 'Module',
                        // 'master_data' => $modules ?? '',
                    ])
                    {{-- Button to Open the Modal  --}}
                    <button type="button" class="btn btn-primary" id="openModalButton">
                        Add Supplier
                    </button>
                </div>
                <div class="bg-secondary rounded p-2 mt-3">
                    <div class="table-responsive">
                        <table class="table" id="moduleTable" style="width: 100%">
                        </table>
                    </div>


                    <!-- Modal Form -->
                    <div class="modal" id="moduleFormModal">
                        <div class="modal-dialog">
                            <form id="moduleModalForm" action="" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="POST" id="formMethod">
                                <input type="hidden" name="id" id="id">
                                <div class="modal-content bg-secondary">
                                    <!-- Modal Header -->
                                    <div class="modal-header bg-secondary">
                                        <h4 class="modal-title text-primary" id="formHead">Add Supplier</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="modal-body bg-secondary">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group mb-3">
                                                    <label for="name" class="form-label">Supplier Name</label>
                                                    <input type="text" class="form-control" name="name" id="name"
                                                        placeholder="Enter Supplier Name" class="w-100" >
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="phone" class="form-label">Supplier Phone</label>
                                                    <input type="text" class="form-control" name="phone"
                                                        placeholder="Enter Supplier Phone" class="w-100" id="phone">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="company_name" class="form-label">Supplier Company Name</label>
                                                    <input type="text" class="form-control" name="company_name"
                                                        placeholder="Enter Supplier Company Name" class="w-100" id="company_name">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="address" class="form-label">Supplier Address</label>
                                                    <textarea class="form-control" name="address" placeholder="Enter Supplier Address" class="w-100" id="address">
                                                    </textarea>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="company_phone" class="form-label">Supplier Company Phone</label>
                                                    <input type="text" class="form-control" name="company_phone"
                                                        placeholder="Enter Supplier Company Phone" class="w-100" id="company_phone">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="company_email" class="form-label">Supplier Company Email</label>
                                                    <input type="text" class="form-control" name="company_email"
                                                        placeholder="Enter Supplier Company Email" class="w-100" id="company_email">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="" class="form-label">Supplier Status</label>
                                                    <select name="status" class="w-100 form-select" id="status">
                                                        <option value="">Select</option>
                                                        <option value="1" selected>active</option>
                                                        <option value="0">inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="modal-footer bg-secondary">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('public/backend/assets/js/pages/supplier.js?v=' . config('custom.CACHE_VERSION')) }}"></script>
@endpush
