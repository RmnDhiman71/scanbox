@extends('layouts.app')

@section('content')

<div>
    <div class="row">
        <div class="col-md-6">
            <h5>Bar Code Cards</h5>
        </div>
        <div class="col-md-6">
            <a href="" onclick="printDiv('bar_codes_scanners_list')" class="btn btn-info btn-style right mx-8">
                Print
            </a>
        </div>
    </div>

    <div class="row mb-6" id="bar_codes_scanners_list">
        @forelse($data as $key => $value)
        <div class="col-md-6 qr-code-card">
            <div class="card qr-card-body mt-3" id="bar_code" data-id="{{ $value->id }}"
                data-batch="{{ $value->batch_id }}">
                <div class="scratch-code">
                    <span class="scratch-code-letter">{{ $value->scratch_code }}</span>
                </div>
                <div class="card-body qr-body-content">
                    <div class="row mx-1">
                        <div class="col-md-12 mx-4">
                            <h5 class="card-title">₹ {{ $value->amount }}</h5>
                            <p class="card-text">Valid {{ ($value->validity == '1') ? "for" : "upto"}}
                                {{ $value->valid_for }} @if($value->validity == '1') Days @endif</p>
                        </div>
                    </div>
                    <div class="row mb-3 mar-left">
                        <div class="col-md-12 description">
                            {{ $value->description }}
                        </div>
                    </div>
                    <div class="row mx-4 my-1">
                        {!! DNS2D::getBarcodeSVG($value->bar_code, 'QRCODE', 3,3) !!}
                    </div>
                </div>
            </div>
        </div>
        @empty
        @endforelse
    </div>

</div>
@endsection

@section('js')
<script>
var url = "<?php echo url('/'); ?>";
var id = document.getElementById('bar_code').dataset.batch;
console.log('id --- ', id);

function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    window.location.href = url + '/barcode/update/' + id;
    document.body.innerHTML = originalContents;
}
</script>
@endsection