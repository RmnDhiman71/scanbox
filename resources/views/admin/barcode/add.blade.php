@extends('layouts.app')

@section('content')
<h5>Add Code</h5>
<div class="custom-form">
    <form method="POST" action="{{ route('store-barcode') }}" autocomplete="off">
        @csrf

        @if (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif

        <div class="form-group">
            <label>
                Type:
                <span class="label-span">
                    ( QR Scanner only created for Batch. )
                </span>
            </label>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="type" value="2" checked>
                <label class="form-check-label">Public (Bar)</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="type" value="1" {{ old('type') == '1' ? 'checked' : '' }}>
                <label class="form-check-label">Private (Batch)</label>
            </div>
            
            @error('type')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        
        <div id="bar_code_view" class="{{ (Session::has('type') || Session::get('type') != 1) ? '' : 'd-none' }}">
            <div class="form-group">
                <label>Bar Code:</label>
                <input type="text" class="form-control @error('bar_code') is-invalid @enderror" placeholder="Enter Bar Code" name="bar_code" value="{{ old('bar_code') }}">
                @error('bar_code')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label>
                Description: <span class="label-span">
                    ( You can Enter 5 lines for Batch in Description with New Line. )
                </span>
            </label>
            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" placeholder="Enter Description" rows="5">{{ old('description') }}</textarea>
            @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div id="batch_code_view" class="{{ (Session::has('type') && Session::get('type') == 1) ? '' : 'd-none' }}">
            <div class="form-group">
                <label>Validity Type:</label>
                <select class="form-control @error('validity') is-invalid @enderror" name="validity" id="validity_type">
                    <option value="">Select Validity Type</option>
                    <option value="1" {{ old('validity') == '1' ? 'selected' : '' }}>
                        Days
                    </option>
                    <option value="2" {{ old('validity') == '2' ? 'selected' : '' }}>
                        Date
                    </option>
                </select>

                @error('validity')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label>Valid For:</label>
                <input type="number" class="form-control @error('valid_for') is-invalid @enderror" id="valid_for" placeholder="Enter your Scratch Code" name="valid_for" value="{{ old('valid_for') }}">
                @error('valid_for')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label>Amount:</label>
                <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount" placeholder="Enter Amount" name="amount" value="{{ old('amount') }}">
                @error('amount')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label>Currency:</label>
                <select class="form-control @error('currency') is-invalid @enderror" name="currency">
                    <option value="">Select Currency</option>
                    <option value="INR" {{ old('currency') == 'INR' ? 'selected' : '' }}>
                        INR
                    </option>
                </select>

                @error('currency')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label>Count:</label>
                <input type="number" class="form-control @error('count') is-invalid @enderror" id="count" placeholder="Enter Bar Code Count that we need to create" name="count" value="{{ old('count') }}">
                @error('count')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">Add Bar Code</button>
    </form>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        $('input[name="type"]').change(function () {
            const value = $('input[name="type"]:checked').val();
            
            if(value == 2)
            {
                $('#batch_code_view').addClass('d-none');
                $('#bar_code_view').removeClass('d-none');
                $('#description').attr('maxlength','');
                $('#type-label-span').removeClass('d-none');
            }

            if(value == 1)
            {
                $('#batch_code_view').removeClass('d-none');
                $('#bar_code_view').addClass('d-none');
                $('#description').attr('maxlength','178');
                $('#type-label-span').addClass('d-none');
            }
        });

        $('#validity_type').change(function () {
            const value = $(this).val();

            if(value == '1')
            {
                $('#valid_for').attr('type','number');
            }

            if(value == '2')
            {
                $('#valid_for').attr('type','date');
            }
        });
    });
</script>
@endsection
