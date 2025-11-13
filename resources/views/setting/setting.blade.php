@extends('dashboard')
@section('title')
    Settings
@endsection
@section('content')
    @can('app-setting-access')
        <div class="row">
            <div class="col-md-12">
                @if (session()->has('message'))
                    <div class="alert alert-danger">
                        {{ session()->get('message') }}
                    </div>
                @endif
                {{ Form::open(['route' => 'payment.settings.store', 'files' => 'true']) }}
                <div class="card card-default">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-12 col-sm-12">
                                <div class="row">
                                    <div class="form-group col-md-12 col-sm-12">
                                        <div class="mb-3">
                                            {{ Form::label(__('select_app')) }}
                                            <select name="apps[]" class="selectpicker ml-3" multiple
                                                aria-label="size 3 select example">
                                                @foreach ($apps as $app)
                                                    <option value="{{ $app->id }}">{{ $app->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="payment_gateway"
                                                role="switch" id="payment_gateway">
                                            {{ Form::label(__('payment_gateway')) }}
                                        </div>
                                        <div id="paymentGateway" class="">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" name="razor_pay"
                                                            role="switch">
                                                        {{ Form::label(__('razor_pay')) }}
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    {{ Form::label(__('merchant_key') . ':') }}
                                                    {{ Form::text('razor_merchant_key', null, ['class' => 'form-control']) }}
                                                </div>
                                                <div class="col-md-4">
                                                    {{ Form::label(__('solt_key') . ':') }}
                                                    {{ Form::text('razor_solt_key', null, ['class' => 'form-control']) }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" name="payu_new"
                                                            role="switch">
                                                        {{ Form::label(__('payu_new')) }}
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    {{ Form::label(__('merchant_key') . ':') }}
                                                    {{ Form::text('payu_new_merchant_key', null, ['class' => 'form-control']) }}
                                                </div>
                                                <div class="col-md-4">
                                                    {{ Form::label(__('solt_key') . ':') }}
                                                    {{ Form::text('payu_new_solt_key', null, ['class' => 'form-control']) }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" name="payu_old"
                                                            role="switch">
                                                        {{ Form::label(__('payu_old')) }}
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    {{ Form::label(__('merchant_key') . ':') }}
                                                    {{ Form::text('payu_old_merchant_key', null, ['class' => 'form-control']) }}
                                                </div>
                                                <div class="col-md-4">
                                                    {{ Form::label(__('solt_key') . ':') }}
                                                    {{ Form::text('payu_old_solt_key', null, ['class' => 'form-control']) }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" name="cash_free"
                                                            role="switch">
                                                        {{ Form::label(__('cash_free')) }}
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    {{ Form::label(__('merchant_key') . ':') }}
                                                    {{ Form::text('cash_merchant_key', null, ['class' => 'form-control']) }}
                                                </div>
                                                <div class="col-md-4">
                                                    {{ Form::label(__('solt_key') . ':') }}
                                                    {{ Form::text('cash_solt_key', null, ['class' => 'form-control']) }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" name="paytm"
                                                            role="switch">
                                                        {{ Form::label(__('paytm')) }}
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    {{ Form::label(__('merchant_key') . ':') }}
                                                    {{ Form::text('paytm_merchant_key', null, ['class' => 'form-control']) }}
                                                </div>
                                                <div class="col-md-4">
                                                    {{ Form::label(__('solt_key') . ':') }}
                                                    {{ Form::text('paytm_solt_key', null, ['class' => 'form-control']) }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" name="upi"
                                                            role="switch">
                                                        {{ Form::label(__('upi')) }}
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    {{ Form::label(__('upi_merchant') . ':') }}
                                                    {{ Form::text('upi_merchant', null, ['class' => 'form-control']) }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                            {{ isset($setting) && $setting->upi_api == '1' ? 'checked' : '' }}
                                                            name="upi_api" role="switch">
                                                        {{ Form::label(__('UPI API')) }}
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    {{ Form::label(__('upi_api_merchant_key') . ':') }}
                                                    {{ Form::text('upi_api_merchant_key', null, ['class' => 'form-control']) }}
                                                </div>
                                                <div class="col-md-3">
                                                    {{ Form::label(__('upi_api_token') . ':') }}
                                                    {{ Form::text('upi_api_token', null, ['class' => 'form-control']) }}
                                                </div>
                                                <div class="col-md-3">
                                                    {{ Form::label(__('upi_api_call_back_url') . ':') }}
                                                    {{ Form::text('upi_api_call_back_url', null, ['class' => 'form-control']) }}
                                                </div>
                                            </div><br>


                                            <div class="row">
                                                <div class="col-md-4">
                                                    {{ Form::label(__('JSON')) }}
                                                </div>
                                                <div class="col-md-8">
                                                    <textarea  type="textarea" id="jsonInput" name="json" class="form-control" oninput="validateJSON()" rows="15"></textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @can('app-setting-edit')
                            {{-- <div class="card card-default"> --}}
                                <div class="card-body d-flex justify-content-end">
                                    {{ Form::submit(__('Save'), ['class' => 'btn btn-primary']) }}
                                    {{ Form::close() }}
                                </div>
                            {{-- </div> --}}
                        @endcan
                    </div>
                </div>
            @endcan
@endsection


@section('scripts')

<script>
    function validateJSON() {
        const inputElement = document.getElementById('jsonInput');
        const jsonString = inputElement.value;
        try {
            // Attempt to parse the JSON string
            JSON.parse(jsonString);
            inputElement.setCustomValidity(''); // Clear any previous validation message
        } catch (error) {
            // Invalid JSON, set a custom validation message
            inputElement.setCustomValidity('Invalid JSON format');
        }
        // Update the element's validity state, which triggers the browser's validation
        inputElement.reportValidity();
    }
</script>
@endsection
