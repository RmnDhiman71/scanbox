@extends('layouts.app')

@section('content')
<h5>Configurations</h5>

<section class="section my-4">
    <h5>Mobile Version</h5>

    <form class="form my-3">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Mobile App Version :</label>
                    <input type="text" class="form-control @error('app_version') is-invalid @enderror" id="app_version" placeholder="Enter your Mobile App Version" name="app_version">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>App Update Required :</label>
                    <input type="text" class="form-control @error('update_required') is-invalid @enderror" id="update_required" placeholder="Enter your Mobile App Version" name="update_required">
                </div>
            </div>
        </div>
    </form>
</section>

@endsection