@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6">
        <h5>Bar Code's</h5>
    </div>
    <div class="col-md-6">
        <a href="{{ route('add-barcode') }}" class="btn btn-info btn-style right">+ Create Bar Code</a>
    </div>
</div>

<div class="">
    @if (Session::has('success'))
        <div class="alert alert-success text-color">{{ Session::get('success') }}</div>
    @endif
    <table class="data-table">
        <thead>
            <tr>
                <th style="width:20px">Sr. No.</th>
                <th style="width:100px">Type</th>
                <th style="width:100px">Bar Code</th>
                <th style="width:100px">Status</th>
                <th>Created at</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php($i=0)
            @forelse($data as $value)
            @php($i++)
            <tr>
                <td>{{ $i }}</td>
                <td>
                    {{ ($value->type == 2) ? "Bar (Public)" : "Batch (Private)" }}
                </td>
                <td>{{ $value->bar_code }}</td>
                <td>
                    @if($value->is_active == 1)
                        <button class="btn btn-success  btn-sm">Active</button>
                    @elseif($value->is_active == 0)
                        <button class="btn btn-secondary btn-sm">Inactive</button>
                    @endif
                </td>
                <td>{{ $value->created_at->format('d/m/Y') }}</td>
                <td>
                    <span class="mx-2">
                        <i class="fa fa-eye" data-bs-toggle="modal" data-bs-target="#view_code_{{$value->id}}"></i>
                    </span>
                </td>
            </tr>

            <div class="modal fade" id="view_code_{{$value->id}}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">View Bar Code</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row my-1">
                                <div class="col-md-4">Type : </div>
                                <div class="col-md-8">{{ ($value->type == 2) ? "Bar (Public)" : "Batch (Private)" }}</div>
                            </div>

                            <div class="row my-1">
                                <div class="col-md-4">Bar Code : </div>
                                <div class="col-md-8">{{ $value->bar_code }}</div>
                            </div>

                            @if($value->type == 1)
                                <!-- <div class="row my-1">
                                    <div class="col-md-4">Scratch Code : </div>
                                    <div class="col-md-8">{{ $value->scratch_code }}</div>
                                </div> -->
                                <div class="row my-1">
                                    <div class="col-md-4">Validity Type : </div>
                                    <div class="col-md-8">{{ ($value->validity == '1') ? "Days" : "Date" }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">Valid Until : </div>
                                    <div class="col-md-8">
                                        @if($value->validity == '1')
                                            {{ $value->valid_for }}
                                        @else
                                            {{ date("d/m/Y", strtotime($value->valid_for)) }}
                                        @endif
                                    </div>
                                </div>
                                <div class="row my-1">
                                    <div class="col-md-4">Amount : </div>
                                    <div class="col-md-8">{{ $value->amount }}</div>
                                </div>
                                <div class="row my-1">
                                    <div class="col-md-4">Currency : </div>
                                    <div class="col-md-8">{{ $value->currency }}</div>
                                </div>
                            @else
                                <div class="row my-1">
                                    <div class="col-md-4">Description : </div>
                                    <div class="col-md-8" style="white-space: pre-wrap;">{{ $value->description }}</div>
                                </div>
                            @endif
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