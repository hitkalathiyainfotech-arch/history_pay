@extends('dashboard')
@section('title')
    Settings
@endsection

@section('header')
@can('setting-edit')
    <div class="d-flex px-4 px-sm-0 pt-2 pt-sm-0">
        <button type="submit" form="setting_form" class="btn btn-primary">Save</button>
    </div>
@endcan
@endsection

@section('content')
@can('setting-access')
@if (isset($setting))
<div class="row">
    <div class="col-md-12">
        @if ($errors->any())
            <div class="alert alert-danger pb-0 pt-0">
                <ul class="j-error-padding list-unstyled p-2 mb-0">
                    <li>{{ $errors->first() }}</li>
                </ul>
            </div>
        @endif
        {{ Form::model($setting, ['route' => ['settings.store'], 'files' => 'true', 'id' => 'setting_form']) }}
        <div class="card card-default">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-12 col-sm-12">
                        <div class="row">

                            <div class="form-group col-xl-6 col-md-6 col-sm-12">
                                {{ Form::label(__('show_user_data_on_leaderboard') . ':') }}
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        {{ isset($setting) && $setting->show_all_user == '1' ? 'checked' : '' }}
                                        name="show_all_user" role="switch" id="show_all_user">
                                    {{ Form::label(__('Show All Data')) }}
                                </div>
                            </div>

                            <div class="form-group col-xl-6 col-md-6 col-sm-12">
                                {{ Form::label(__('app') . ':') }}
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        {{ isset($setting) && $setting->app_update == '1' ? 'checked' : '' }}
                                        name="app_update" role="switch" id="app_update">
                                    {{ Form::label(__('app update')) }}
                                </div>
                            </div>
                            <div class="form-group col-xl-6 col-md-6 col-sm-12 {{ isset($setting) && $setting->show_all_user == '1' ? 'd-none' : '' }}"
                                id="show_count">
                                {{ Form::label(__('show users count') . ':') }}
                                {{ Form::text('show_user_count', null, ['class' => 'form-control']) }}
                            </div>
                            <div class="form-group col-xl-6 col-md-6 col-sm-12">
                                {{ Form::label(__('mining_session_time') . ':') }}
                                <select class="form-select col-md-12 col-sm-12" name="mining_session_time"
                                    id="mining_session_time">
                                    <option value="">select Time</option>
                                    <option value="1"{{ $setting->mining_session_time == 1 ? 'selected' : '' }}>1
                                    </option>
                                    <option value="2"{{ $setting->mining_session_time == 2 ? 'selected' : '' }}>2
                                    </option>
                                    <option value="3"{{ $setting->mining_session_time == 3 ? 'selected' : '' }}>3
                                    </option>
                                    <option value="4"{{ $setting->mining_session_time == 4 ? 'selected' : '' }}>4
                                    </option>
                                    <option value="5"{{ $setting->mining_session_time == 5 ? 'selected' : '' }}>5
                                    </option>
                                    <option value="6"{{ $setting->mining_session_time == 6 ? 'selected' : '' }}>6
                                    </option>
                                    <option value="7"{{ $setting->mining_session_time == 7 ? 'selected' : '' }}>7
                                    </option>
                                    <option value="8"{{ $setting->mining_session_time == 8 ? 'selected' : '' }}>8
                                    </option>
                                    <option value="9"{{ $setting->mining_session_time == 9 ? 'selected' : '' }}>9
                                    </option>
                                    <option value="10"{{ $setting->mining_session_time == 10 ? 'selected' : '' }}>10
                                    </option>
                                    <option value="11"{{ $setting->mining_session_time == 11 ? 'selected' : '' }}>11
                                    </option>
                                    <option value="12"{{ $setting->mining_session_time == 12 ? 'selected' : '' }}>12
                                    </option>
                                    <option value="13"{{ $setting->mining_session_time == 13 ? 'selected' : '' }}>13
                                    </option>
                                    <option value="14"{{ $setting->mining_session_time == 14 ? 'selected' : '' }}>14
                                    </option>
                                    <option value="15"{{ $setting->mining_session_time == 15 ? 'selected' : '' }}>15
                                    </option>
                                    <option value="16"{{ $setting->mining_session_time == 16 ? 'selected' : '' }}>16
                                    </option>
                                    <option value="17"{{ $setting->mining_session_time == 17 ? 'selected' : '' }}>17
                                    </option>
                                    <option value="18"{{ $setting->mining_session_time == 18 ? 'selected' : '' }}>18
                                    </option>
                                    <option value="19"{{ $setting->mining_session_time == 19 ? 'selected' : '' }}>19
                                    </option>
                                    <option value="20"{{ $setting->mining_session_time == 20 ? 'selected' : '' }}>20
                                    </option>
                                    <option value="21"{{ $setting->mining_session_time == 21 ? 'selected' : '' }}>21
                                    </option>
                                    <option value="22"{{ $setting->mining_session_time == 22 ? 'selected' : '' }}>22
                                    </option>
                                    <option value="23"{{ $setting->mining_session_time == 23 ? 'selected' : '' }}>23
                                    </option>
                                    <option value="24"{{ $setting->mining_session_time == 24 ? 'selected' : '' }}>24
                                    </option>
                                </select>
                            </div>

                            <div class="form-group col-xl-6 col-md-6 col-sm-12">
                                {{ Form::label(__('app_update_type_immediate') . ':') }}
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        {{ isset($setting) && $setting->app_update_type_immediate == '1' ? 'checked' : '' }}
                                        name="app_update_type_immediate" role="switch" id="app_update_type_immediate">
                                    {{ Form::label(__('App Update Type Immediate')) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox"
                                                {{ isset($setting) && $setting->in_app_purchase == '1' ? 'checked' : '' }}
                                                name="in_app_purchase" role="switch" id="in_app_purchase">
                                            {{ Form::label(__('in_app_purchase')) }}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox"
                                                {{ isset($setting) && $setting->isAppRemove == '1' ? 'checked' : '' }}
                                                name="isAppRemove" role="switch" id="isAppRemove">
                                            {{ Form::label(__('is_app_remove')) }}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox"
                                                {{ isset($setting) && $setting->isShowFailPurchase == '1' ? 'checked' : '' }}
                                                name="isShowFailPurchase" role="switch" id="isShowFailPurchase">
                                            {{ Form::label(__('is_Show_Fail_Purchase')) }}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox"
                                                {{ isset($setting) && $setting->isShowPurchaseEntryInFirebase == '1' ? 'checked' : '' }}
                                                name="isShowPurchaseEntryInFirebase" role="switch"
                                                id="isShowPurchaseEntryInFirebase">
                                            {{ Form::label(__('is_Show_Purchase_EntryIn_Firebase')) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 {{ !isset($setting) || (isset($setting) && $setting->in_app_purchase == '0') ? 'd-none' : '' }}"
                                id="inAppPurchase">
                                <div class="col-md-4">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox"
                                            {{ isset($setting) && $setting->show_all_world == '1' ? 'checked' : '' }}
                                            name="show_all_world" role="switch">
                                        {{ Form::label(__('show_all_world')) }}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox"
                                            {{ isset($setting) && $setting->outside_india == '1' ? 'checked' : '' }}
                                            name="outside_india" role="switch">
                                        {{ Form::label(__('show_only_outside_india')) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-xl-4 col-md-4 col-sm-12">
                        {{ Form::label(__('support_email') . ':') }}
                        {{ Form::text('support_email', null, ['class' => 'form-control']) }}
                        {{ Form::hidden('id', null, ['class' => 'form-control']) }}
                    </div>

                    <div class="form-group col-xl-4 col-md-4 col-sm-12">
                        {{ Form::label(__('privacy_policy') . ':') }}
                        {{ Form::text('privacy_policy', null, ['class' => 'form-control']) }}
                    </div>

                    <div class="form-group col-xl-4 col-md-4 col-sm-12">
                        {{ Form::label(__('terms_and_condition') . ':') }}
                        {{ Form::text('terms_and_condition', null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group col-md-12 col-sm-12">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox"
                                {{ isset($setting) && $setting->payment_gateway == '1' ? 'checked' : '' }}
                                name="payment_gateway" role="switch" id="payment_gateway">
                            {{ Form::label(__('payment_gateway')) }}
                        </div>
                        <div id="paymentGateway"
                            class="{{ !isset($setting) || (isset($setting) && $setting->payment_gateway == '0') ? 'd-none' : '' }}">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox"
                                            {{ isset($setting) && $setting->razor_pay == '1' ? 'checked' : '' }}
                                            name="razor_pay" role="switch">
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
                                        <input class="form-check-input" type="checkbox"
                                            {{ isset($setting) && $setting->payu_new == '1' ? 'checked' : '' }}
                                            name="payu_new" role="switch">
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
                                        <input class="form-check-input" type="checkbox"
                                            {{ isset($setting) && $setting->payu_old == '1' ? 'checked' : '' }}
                                            name="payu_old" role="switch">
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
                                        <input class="form-check-input" type="checkbox"
                                            {{ isset($setting) && $setting->cash_free == '1' ? 'checked' : '' }}
                                            name="cash_free" role="switch">
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
                                        <input class="form-check-input" type="checkbox"
                                            {{ isset($setting) && $setting->paytm == '1' ? 'checked' : '' }}
                                            name="paytm" role="switch">
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
                                        <input class="form-check-input" type="checkbox"
                                            {{ isset($setting) && $setting->upi == '1' ? 'checked' : '' }}
                                            name="upi" role="switch">
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
                                    <textarea  type="textarea" id="jsonInput" name="json" class="form-control" oninput="validateJSON()" rows="15">{{ $setting->json }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="card card-default">
                    <div class="card-header">
                        <h3>Ads Setting</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group col-md-12 col-sm-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox"
                                    {{ isset($setting) && $setting->admob_ads == '1' ? 'checked' : '' }}
                                    name="admob_ads" role="switch">
                                {{ Form::label(__('show ads')) }}
                            </div>
                        </div>
                        <div class="form-group col-md-12 col-sm-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox"
                                    {{ isset($setting) && $setting->isTestAd == '1' ? 'checked' : '' }}
                                    name="isTestAd" role="switch">
                                {{ Form::label(__('Is Test Ad')) }}
                            </div>
                        </div>
                        <div class="form-group col-md-12 col-sm-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox"
                                    {{ isset($setting) && $setting->isAdmobAndFBMeditation == '1' ? 'checked' : '' }}
                                    name="isAdmobAndFBMeditation" role="switch">
                                {{ Form::label(__('Is Admob And FB Meditation')) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="form-group col-md-6 col-sm-12">
                    <div class="card card-default">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>Facebook Ads</h3>
                                </div>
                                <div class="col-md-6 text-end">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox"
                                            {{ isset($setting) && $setting->facebook_ads == '1' ? 'checked' : '' }}
                                            name="facebook_ads" role="switch" id="facebook_ads">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="" id="facebook">
                                {{ Form::label(__('fb_native_ad') . ':') }}
                                {{ Form::text('fb_native_ad', null, ['class' => 'form-control']) }}
                                {{ Form::label(__('fb_native_banner_ad') . ':') }}
                                {{ Form::text('fb_native_banner_ad', null, ['class' => 'form-control']) }}
                                {{ Form::label(__('fb_banner_ad') . ':') }}
                                {{ Form::text('fb_banner_ad', null, ['class' => 'form-control']) }}
                                {{ Form::label(__('fb_medium_rectangle_250') . ':') }}
                                {{ Form::text('fb_medium_rectangle_250', null, ['class' => 'form-control']) }}
                                {{ Form::label(__('fb_interstitial_ad') . ':') }}
                                {{ Form::text('fb_interstitial_ad', null, ['class' => 'form-control']) }}
                                {{ Form::label(__('fb_rewarded_video_ad') . ':') }}
                                {{ Form::text('fb_rewarded_video_ad', null, ['class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-6 col-sm-12">
                    <div class="card card-default">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>Admob Ads</h3>
                                </div>
                                <div class="col-md-6 text-end">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox"
                                            {{ isset($setting) && $setting->admob_ads_id == '1' ? 'checked' : '' }}
                                            name="admob_ads_id" role="switch" id="admob_ads_id">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="" id="admob">
                                {{ Form::label(__('admob_native_ad') . ':') }}
                                {{ Form::text('admob_native_ad', null, ['class' => 'form-control']) }}
                                  {{ Form::label(__('admob_native_banner_ad') . ':') }}
                                {{ Form::text('admob_native_banner_ad', null, ['class' => 'form-control']) }}
                                {{ Form::label(__('admob_banner_ad') . ':') }}
                                {{ Form::text('admob_banner_ad', null, ['class' => 'form-control']) }}
                                {{ Form::label(__('admob_interstitial_ad') . ':') }}
                                {{ Form::text('admob_interstitial_ad', null, ['class' => 'form-control']) }}
                                {{ Form::label(__('admob_rewarded_video_ad') . ':') }}
                                {{ Form::text('admob_rewarded_video_ad', null, ['class' => 'form-control']) }}
                                {{ Form::label(__('admob_app_open') . ':') }}
                                {{ Form::text('admob_app_open', null, ['class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-6 col-sm-12">
                    <div class="card card-default">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>Applovin Ads</h3>
                                </div>
                                <div class="col-md-6 text-end">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox"
                                            {{ isset($setting) && $setting->applovin_ads == '1' ? 'checked' : '' }}
                                            name="applovin_ads" role="switch" id="applovin_ads">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="" id="applovin">
                                {{ Form::label(__('applovin_small_native_ad') . ':') }}
                                {{ Form::text('applovin_small_native_ad', null, ['class' => 'form-control']) }}
                                {{ Form::label(__('applovin_medium_banner_ad') . ':') }}
                                {{ Form::text('applovin_medium_banner_ad', null, ['class' => 'form-control']) }}
                                {{ Form::label(__('applovin_large_native_ad') . ':') }}
                                {{ Form::text('applovin_large_native_ad', null, ['class' => 'form-control']) }}
                                {{ Form::label(__('applovin_interstitial_ad') . ':') }}
                                {{ Form::text('applovin_interstitial_ad', null, ['class' => 'form-control']) }}
                                {{ Form::label(__('applovin_rewarded_video_ad') . ':') }}
                                {{ Form::text('applovin_rewarded_video_ad', null, ['class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @can('setting-edit')
            <div class="card card-default">
                <div class="card-body d-flex justify-content-end">
                    {{ Form::submit(__('Save'), ['class' => 'btn btn-primary']) }}
                    {{ Form::close() }}
                </div>
            </div>
        @endcan
    </div>
</div>
@endif

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
    <script>
        $('#show_all_user').on('click', function() {
            $('#show_count').toggleClass('d-none');
        });
        $('#in_app_purchase').on('click', function() {
            $('#inAppPurchase').toggleClass('d-none');
        });
        $('#payment_gateway').on('click', function() {
            $('#paymentGateway').toggleClass('d-none');
        });
        // $('#facebook_ads').on('click',function(){
        //         $('#facebook').toggleClass('d-none');
        // });
        // $('#admob_ads_id').on('click',function(){
        //         $('#admob').toggleClass('d-none');
        // });
        // $('#applovin_ads').on('click',function(){
        //         $('#applovin').toggleClass('d-none');
        // });
    </script>
@endsection
