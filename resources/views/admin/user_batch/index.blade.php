@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6">
        @php($text = "User Money Request's")

        @if(Route::currentRouteName() == 'approved-money-requests')
            <?php $text = "User's Approved Money Request's"; ?>
        @endif

        @if(Route::currentRouteName() == 'transferred-money-requests')
            <?php $text = "User's Transferred Money Request's"; ?>
        @endif
        <h5>{{ $text }}</h5></h5>
    </div>
    <div class="col-md-6 total-amount">
        <span>Total : </span> {{ $data->sum('amount') }} INR
    </div>
</div>

<div class="mt-3">
    @if (Session::has('success'))
        <div class="alert alert-success text-color">{{ Session::get('success') }}</div>
    @endif
    <table class="data-table">
        <thead>
            <tr>
                <th style="width:20px">Sr. No.</th>
                <th style="width:100px">User</th>
                <th style="width:100px">Amount</th>
                <th style="width:100px">Requested at</th>
                <th style="width:100px">Transfer at</th>
                <th style="width:100px">Type</th>
                <th style="width:200px">Action</th>
            </tr>
        </thead>
        <tbody>
            @php($i=0)
            @forelse($data as $value)
            @php($i++)
            <tr>
                <td>{{ $i }}</td>
                <td>
                    {{ $value->user->name }}
                </td>
                <td>{{ $value->amount.' '.$value->currency }}</td>
                <td>{{ date("d/m/Y", strtotime($value->request_at)) }}</td>
                <td>
                    @if(!empty($value->transfer_at))
                    {{ date("d/m/Y", strtotime($value->transfer_at)) }}
                    @endif
                </td>
                <td>
                    @if($value->type == 0)
                        <button class="btn btn-secondary btn-sm">Credit</button>
                    @elseif($value->type == 1)
                        <button class="btn btn-success btn-sm">Debit</button>
                    @endif
                </td>
                <td>
                    @if($value->status == 3)
                        <button class="btn btn-info btn-style" data-bs-toggle="modal" data-bs-target="#view_{{$value->id}}">View Info</button>
                    @else
                        <button class="btn btn-info btn-style" data-bs-toggle="modal" data-bs-target="#update_{{$value->id}}">Update Status</button>
                    @endif
                </td>
            </tr>
            
            @if($value->status != 3)
                <div class="modal fade" id="update_{{$value->id}}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Update Status</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <?php 
                                    if($value->status == '1')
                                    {
                                        $text = 'Approved';
                                        $status = '2';
                                    }

                                    if($value->status == '2')
                                    {
                                        $text = 'Transferred';
                                        $status = '3';
                                    }
                                ?>

                                Are you sure want to <b>{{ $text }}</b> this Request ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <a href="{{ route('edit-money-status', ['transaction' => $value->id, 'status' => $status]) }}" class="btn btn-info btn-style">Update</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                
                <div class="modal fade" id="view_{{$value->id}}" tabindex="-1" aria-hidden="true">
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