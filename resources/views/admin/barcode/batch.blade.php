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
    <table class="data-table table table-striped">
        <thead>
            <tr>
                <th style="width:20px">Sr. No.</th>
                <th style="width:100px">Batch Id</th>
                <th style="width:100px">Description</th>
                <th style="width:100px">Amount</th>
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
                    {{ $value->number }}
                </td>
                <td>{{ substr($value->description, 0, 40) }}....</td>
                <td>
                    {{ $value->amount.' '.$value->currency }}
                </td>
                <td>{{ $value->created_at->format('d/m/Y') }}</td>
                <td>
                    <span class="mx-2">
                        <a href="{{ route('batches-list', $value->id) }}">
                            <i class="fa fa-eye"></i>
                        </a>
                    </span>
                    @if($value->is_deleteable == 1)
                    <span class="mx-2">
                        <a data-bs-toggle="modal" data-bs-target="#delete_{{$value->id}}">
                            <i class="fa fa-trash"></i>
                        </a>
                    </span>
                    @endif
                </td>
            </tr>

            <div class="modal fade" id="delete_{{$value->id}}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Delete Batch</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure want to delete this Batch ?
                        </div>
                        <div class="modal-footer text-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a href="{{ route('delete-batch', $value->id) }}" class="btn btn-info btn-style">Delete</a>
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