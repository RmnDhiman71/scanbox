@extends('layouts.app')

@section('content')
<h5>Update Money Request Status</h5>
<div class="custom-form">
    <form method="POST" action="{{ route('edit-money-status', $transaction->id) }}">
        @csrf
        <div class="form-group">
            <label>Status :</label>
            <select class="form-control @error('status') is-invalid @enderror" name="status">
                <option value="">Select Bar Code Type</option>

                @if($transaction->status == '1')
                <option value="2" {{ old('status') == '2' ? 'selected' : '' }}>
                    Approved
                </option>
                @endif
                <option value="3" {{ old('status') == '3' ? 'selected' : '' }}>
                    Transferred
                </option>
            </select>
            
            @error('status')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>        
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection