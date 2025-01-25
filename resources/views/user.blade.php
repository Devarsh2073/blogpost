@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        {{ __('Users') }}
                        @if (auth()->user()->can('user-create'))
                            <button class="btn btn-sm btn-primary add-btn" data-bs-toggle="modal"
                                data-bs-target="#addRecordModal">Add New
                                Record</button>
                        @endif
                    </div>

                    <div class="table-responsive">
                        {!! $dataTable->table() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('modal.user_modal')
@include('modal.modal')

@push('scripts')
    <script src="{{ asset('assets/js/user.js') }}"></script>
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
