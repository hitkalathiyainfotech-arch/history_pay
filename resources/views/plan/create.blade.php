@extends('dashboard')
@section('title')
    Add Plan
@endsection
@section('header')
    <a href="{{ route('plans') }}" class="btn btn-default"><i class="fa-solid fa-arrow-left mr-1"></i>{{__('Back')}}
    </a>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            @if ($errors->any())
                <div class="alert alert-danger pb-0 pt-0">
                    <ul class="j-error-padding list-unstyled p-2 mb-0">
                        <li>{{ $errors->first() }}</li>
                    </ul>
                </div>
            @endif
            <div class="card card-default">
                <div class="card-body">
                    {{ Form::open(['route' => 'plans.store', 'files' => 'true']) }}
                    <div class="row">
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('plan_name').':') }} <span class="mandatory">*</span>
                            {{ Form::text('plan_name', null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('price').':') }} <span class="mandatory">*</span>
                            {{ Form::number('price', null, ['class' => 'form-control', 'required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('speed').':') }} <span class="mandatory">*</span>
                            {{ Form::number('speed', null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('contract').':') }} <span class="mandatory">*</span>
                            {{ Form::number('contract', null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('minimum_withdraw').':') }} <span class="mandatory">*</span>
                            {{ Form::text('minimum_withdraw', null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('availability').':') }} <span class="mandatory">*</span>
                            {{ Form::text('availability', null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('category').':') }} <span class="mandatory">*</span>
                            {{ Form::select('category', $category,null, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('image').':') }} <span class="mandatory">*</span>
                            {{-- {{ Form::file('image',null, ['class' => '',"multiple"=>true]) }} --}}
                            <input class="form-control" name="file" type="file" style="display: block;">
                        </div>
                        <div class="form-group col-sm-12 pt-4">
                            {{ Form::submit(__('Save'), ['class' => 'btn btn-primary save-btn']) }}
                            <a href="{{ route('plans') }}"
                               class="btn btn-default">{{__('Cancel')}}</a>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
