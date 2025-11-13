@extends('dashboard')
@section('title')
    Create Role
@endsection

@section('content')
    <div class="row">
        {{-- <div class="col-md-12"> --}}

        @if ($errors->any())
            <div class="alert alert-danger pb-0 pt-0">
                <ul class="j-error-padding list-unstyled p-2 mb-0">
                    <li>{{ $errors->first() }}</li>
                </ul>
            </div>
        @endif
        {{ Form::open(['route' => 'role.store', 'files' => 'true']) }}
        @csrf
        <div class="card card-default">
            <div class="card-body">
            </div>


            <div class="col-md-12">
                <div class="row">
                    <div class="form-group">
                        <div class="card card-default">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4>Role</h4>
                                    </div>
                                </div>
                            </div>



                            <div class="card-body">
                                <div class="form-group col-xl-7 col-md-6 col-sm-12">
                                    {{ Form::label(__('Role name') . ':') }}
                                    <input id="role_name" type="text" name="name" value="{{ old('name') }}"
                                        placeholder="Enter role"
                                        class="form-control"/>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="form-group">
                        <div class="card card-default">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4>Permission</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-check">
                                    <div class="form-group col-xl-7 col-md-6 col-sm-12">

                                        <div class="flex flex-col justify-cente">
                                            <div class="flex flex-col">
                                                <label for="roles"><strong>App : </strong></label>&nbsp;&nbsp;
                                                <label class="inline-flex items-center mt-3">
                                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-inherit-600"
                                                        name="permissions[]" value="7"><span class="ml-2 text-gray-700">App Create</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                                </label><label class="inline-flex items-center mt-3">
                                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600"
                                                        name="permissions[]" value="9"><span class="ml-2 text-gray-700">App Edit</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                                </label>
                                            </div>
                                        </div><hr>
                                        <div class="flex flex-col justify-cente">
                                            <div class="flex flex-col">
                                                <label for="roles">App Open : </label>&nbsp;&nbsp;
                                                <label class="inline-flex items-center mt-3">
                                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600"
                                                        name="permissions[]" value="19"><span class="ml-2 text-gray-700">Call Universal</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                                </label><label class="inline-flex items-center mt-3">
                                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600"
                                                        name="permissions[]" value="20"><span class="ml-2 text-gray-700">Call Blue White</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                                </label><label class="inline-flex items-center mt-3">
                                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600"
                                                        name="permissions[]" value="21"><span class="ml-2 text-gray-700">Call OB</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                                </label><label class="inline-flex items-center mt-3">
                                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600"
                                                        name="permissions[]" value="24"><span class="ml-2 text-gray-700">Call Green</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                                </label>
                                                @foreach($app_permission as $key => $app_permi)
                                                <label class="inline-flex items-center mt-3">
                                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600"
                                                        name="permissions[]" value="{{ $app_permi->id }}"><span class="ml-2 text-gray-700">{{ $app_permi->name }}</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                                </label>
                                                @endforeach
                                            </div>
                                        </div><hr>


                                        <div class="flex flex-col justify-cente">
                                            <div class="flex flex-col">
                                                <label for="roles"><b>App Setting : </b></label>&nbsp;&nbsp;
                                                <label class="inline-flex items-center mt-3">
                                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600"
                                                        name="permissions[]" value="35"><span class="ml-2 text-gray-700">App Setting Access</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                                </label><label class="inline-flex items-center mt-3">
                                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600"
                                                        name="permissions[]" value="36"><span class="ml-2 text-gray-700">App Setting Edit</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                                </label>
                                            </div>
                                        </div><hr>
                                        <div class="flex flex-col justify-cente">
                                            <div class="flex flex-col">
                                                <label for="roles"><b>Authentication : </b></label>&nbsp;&nbsp;
                                                <label class="inline-flex items-center mt-3">
                                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600"
                                                        name="permissions[]" value="40"><span class="ml-2 text-gray-700">Withdraw Access</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                                </label>
                                            </div>
                                        </div><hr>
                                        <div class="flex flex-col justify-cente">
                                            <div class="flex flex-col">
                                                <label for="roles"><b>Roles : </b></label>&nbsp;&nbsp;
                                                <label class="inline-flex items-center mt-3">
                                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600"
                                                        name="permissions[]" value="11"><span class="ml-2 text-gray-700">Role Access</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                                </label><label class="inline-flex items-center mt-3">
                                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600"
                                                        name="permissions[]" value="13"><span class="ml-2 text-gray-700">Role Create</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                                </label><label class="inline-flex items-center mt-3">
                                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600"
                                                        name="permissions[]" value="12"><span class="ml-2 text-gray-700">Role Edit</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                                </label><label class="inline-flex items-center mt-3">
                                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600"
                                                        name="permissions[]" value="14"><span class="ml-2 text-gray-700">Role Delete</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                                </label>
                                            </div>
                                        </div><hr>
                                        <div class="flex flex-col justify-cente">
                                            <div class="flex flex-col">
                                                <label for="roles"><b>Permission : </b></label>&nbsp;&nbsp;
                                                <label class="inline-flex items-center mt-3">
                                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600"
                                                        name="permissions[]" value="15"><span class="ml-2 text-gray-700">Permission Access</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                                </label><label class="inline-flex items-center mt-3">
                                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600"
                                                        name="permissions[]" value="17"><span class="ml-2 text-gray-700">Permission Create</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                                </label><label class="inline-flex items-center mt-3">
                                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600"
                                                        name="permissions[]" value="16"><span class="ml-2 text-gray-700">Permission Edit</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                                </label><label class="inline-flex items-center mt-3">
                                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600"
                                                        name="permissions[]" value="18"><span class="ml-2 text-gray-700">Permission Delete</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                                </label>
                                            </div>
                                        </div><hr>

                                        <div class="flex flex-col justify-cente">
                                            <div class="flex flex-col">
                                                <label for="roles"><b>Setting : </b></label>&nbsp;&nbsp;
                                                <label class="inline-flex items-center mt-3">
                                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600"
                                                        name="permissions[]" value="33"><span class="ml-2 text-gray-700">Setting Access</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                                </label><label class="inline-flex items-center mt-3">
                                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600"
                                                        name="permissions[]" value="34"><span class="ml-2 text-gray-700">Setting Edit</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                                </label>
                                            </div>
                                        </div><hr>
                                        <div class="flex flex-col justify-cente">
                                            <div class="flex flex-col">
                                                <label for="roles"><b>Purchage : </b></label>&nbsp;&nbsp;
                                                <label class="inline-flex items-center mt-3">
                                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600"
                                                        name="permissions[]" value="37"><span class="ml-2 text-gray-700">Purchage Access</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                                </label>
                                            </div>
                                        </div><hr>







                                        {{-- @foreach ($permissions as $permission)
                                            <div class="flex flex-col justify-cente">
                                                <div class="flex flex-col">
                                                    <label class="inline-flex items-center mt-3">
                                                        <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600"
                                                            name="permissions[]" value="{{ $permission->id }}"><span
                                                            class="ml-2 text-gray-700">{{ $permission->name }}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach --}}

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group col-sm-12 pt-4">
                {{ Form::submit(__('Save'), ['class' => 'btn btn-primary save-btn']) }}
                <a href="{{ url('role') }}" class="btn btn-default">{{ __('Cancel') }}</a>
            </div>

        </div>
        {{ Form::close() }}
        {{-- </div> --}}
    </div>
@endsection
