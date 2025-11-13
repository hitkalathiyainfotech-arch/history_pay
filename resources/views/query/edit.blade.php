@extends('dashboard')
@section('title1') Message @endsection
@section('heading')
<div class="card-title m-0 pl-4" style="padding-top: 5px;">
    <div>
        <label>Ticket Id : </label>
        <span class="badge badge-secondary">{{ $query->id }}</span>
    </div>
    <div>
        <span>{{ $user->email }}</span>
    </div>
    <div>
        <label>Title : </label>
        <span>{{ $query->title }}</span>
    </div></div>
@endsection
@section('header')
    <a href="{{ route('get_query') }}" class="btn btn-default"><i class="fa-solid fa-arrow-left mr-1"></i>{{ __('Back') }}
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
            <div class="col-md-12">
                @php
                    dd($message[0]->user_id);
                @endphp
                @foreach($message as $value)
                <div class="card card-default">
                    <div class="card-body">
                        <div class="row">
                            {{-- @if($value) --}}
                                <div>
                                    <label>Description : </label>
                                    <span>{{ $value->message }}</span>
                                </div>
                            {{-- @endif --}}
                        </div>
                    </div>
                </div>
                @endforeach



                <div class="card card-default">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger pb-0 pt-0">
                                <ul class="j-error-padding list-unstyled p-2 mb-0">
                                    <li>{{ $errors->first() }}</li>
                                </ul>
                            </div>
                        @endif
                        {{ Form::open(['route' => 'get_query.store', 'files' => 'true']) }}
                        <div class="row">
                            <div class="form-group">
                                {{ Form::label(__('Message') . ':') }} <span class="mandatory">*</span>
                                {{ Form::text('message', null, ['class' => 'form-control', 'required']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label(__('image') . ':') }}
                                <input class="form-control" name="file" type="file" style="display: block;">
                            </div>
                            <!-- Hidden input field for post_id -->
                            {{ Form::hidden('query_id', $query->id) }}
                            {{ Form::hidden('user_id', $user->id) }}
                            <div class="form-group col-sm-12 pt-4">
                                {{ Form::submit(__('Save'), ['class' => 'btn btn-primary save-btn']) }}
                                <a href="{{ route('get_query') }}" class="btn btn-default">{{ __('Cancel') }}</a>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>

                {{-- <div class="card card-default">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label>History : </label>
                            </div>

                            <div class="col-md-12">
                                <div class="card card-default">
                                    <div class="card-body table-responsive">
                                        @include('query.table')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}


            </div>
        </div>
    </div>
@endsection
