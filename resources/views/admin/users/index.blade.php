@extends('layouts.app')

@section('content')
<div class="row">
    <h5>User's List</h5>
</div>

<div class="mt-3">
    @if (Session::has('success'))
        <div class="alert alert-success text-color">{{ Session::get('success') }}</div>
    @endif
    <table class="data-table">
        <thead>
            <tr>
                <th style="width:20px">Sr. No.</th>
                <th style="width:100px">Name</th>
                <th style="width:100px">Email</th>
                <th style="width:100px">Total Amount</th>
                <th style="width:100px">Received Amount</th>
                <th style="width:100px">Pending Amount</th>
                <th style="width:400px">Action</th>
            </tr>
        </thead>
        <tbody>
            @php($i=0)
            @forelse($data as $value)
            @php($i++)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->email }}</td>
                <td>{{ $value->codes->sum('amount') }} INR</td>
                <td>{{ $value->transactions->sum('amount') }} INR</td>
                <td>
                    {{ $value->codes->sum('amount') -  $value->transactions->sum('amount') }} INR
                </td>
                <td>
                    <button class="btn btn-info btn-style" data-bs-toggle="modal" data-bs-target="#view_code_{{$value->id}}">User Info</button>
                </td>
            </tr>

            <div class="modal fade" id="view_code_{{$value->id}}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">User Info</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h6>User Info</h6>
                            <div class="row my-1">
                                <div class="col-md-4">Identity Number : </div>
                                <div class="col-md-8">{{ $value->identity_number }}</div>
                            </div>

                            <div class="row my-1 mb-3">
                                <div class="col-md-4">PAN Number : </div>
                                <div class="col-md-8">{{ $value->pan_number }}</div>
                            </div>
                            <h6>Bank Info</h6>
                            
                            <div class="row my-1">
                                <div class="col-md-4">Customer Name : </div>
                                <div class="col-md-8">{{ !empty($value->bank) ? $value->bank->customer_name : '' }}</div>
                            </div>

                            <div class="row my-1">
                                <div class="col-md-4">Account Number : </div>
                                <div class="col-md-8">{{ !empty($value->bank) ? $value->bank->account_number : '' }}</div>
                            </div>

                            <div class="row my-1">
                                <div class="col-md-4">IFSC Code : </div>
                                <div class="col-md-8">{{ !empty($value->bank) ? $value->bank->ifsc_code : '' }}</div>
                            </div>

                            <div class="row my-1">
                                <div class="col-md-4">UPI Id : </div>
                                <div class="col-md-8">{{ !empty($value->bank) ? $value->bank->upi_id : '' }}</div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>


            @empty
            @endforelse
        </tbody>
    </table>        
</div>
@endsection