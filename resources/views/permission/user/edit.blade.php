@extends('dashboard')
@section('title')
    Create User
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
        {{ Form::open(['route' => ['permission.update',$user->id], 'files' => 'true']) }}
        @csrf
        <div class="card card-default">
            <div class="card-body">

                <div class="row">
                    <div class="card card-default">
                        <div class="card-header">
                            <h4>Registration Details</h4>
                        </div>
                        {{-- @php
                            dd($user);
                        @endphp --}}
                        <div class="card-body">
                            <div class="form-group col-xl-6 col-md-6 col-sm-12">
                                <div class="form-check form-switch">
                                    {{ Form::label(__('name') . ':') }}
                                    {{-- <a class="form-control">{{ $user->first_name }}</a> --}}
                                    {{ Form::text('name', $user->first_name , ['placeholder' => 'name', 'class' => 'form-control', 'required']) }}
                                </div>
                            </div>
                            <div class="form-group col-xl-6 col-md-6 col-sm-12">
                                <div class="form-check form-switch">
                                    {{ Form::label(__('email') . ':') }}
                                    <a class="form-control">{{ $user->email }}</a>
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
                                        <h4>Role</h4>
                                    </div>
                                </div>
                            </div>
                            {{-- @php
                                dd($role);
                            @endphp --}}
                            <div class="card-body">
                                <div class="form-group col-xl-6 col-md-6 col-sm-12">
                                    {{ Form::label(__('select_role') . ':') }}

                                            {{-- @php
                                                dd($rolename[0]->role_id);
                                            @endphp --}}
                                    <select class="role form-control m-bot15" name="role" id="role">
                                        <option value="">select role</option>
                                            @foreach ($role as $value)
                                                <option data-role-id="{{$value->id}}" data-role-slug="{{$value->slug}}" value="{{ $value->id }}"{{ $rolename[0]->role_id == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
{{-- $rolename --}}
                                                {{-- <option data-role-id="{{$value->id}}" data-role-slug="{{$value->slug}}" value="{{ $value->id }}" @if($value->id == $role) selected @endif>{{ $value->name }}</option> --}}
                                            @endForeach
                                    </select>
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
                                    <div class="form-group col-xl-6 col-md-6 col-sm-12">
                                        <label for="roles">Permissions</label>
                                        <div id="permissions_box" >
                                            <div id="permissions_ckeckbox_list">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group col-sm-12 pt-4">
                {{ Form::submit(__('Save'), ['class' => 'btn btn-primary save-btn']) }}
                <a href="{{ url('per') }}" class="btn btn-default">{{ __('Cancel') }}</a>
            </div>

        </div>
        {{ Form::close() }}
        {{-- </div> --}}
    </div>

    @endsection
    @section('scripts')

    <!-- Your HTML code remains the same -->

<script type="text/javascript">
    $(document).ready(function(){
        let userUrl = "{{ url('/permission/{id}/edit') }}";
        var permissions_box = $('#permissions_box');
        var permissions_ckeckbox_list = $('#permissions_ckeckbox_list');

        permissions_box.hide();

        function generateCheckboxes(role_id, role_slug) {
            permissions_ckeckbox_list.empty();

            $.ajax({
                url: userUrl,
                method: 'get',
                dataType: 'json',
                data: {
                    role_id: role_id,
                    role_slug: role_slug,
                }
            }).done(function(data) {
                permissions_box.show();
                permissions_ckeckbox_list.empty();

                $.each(data, function(index, element){
                    $(permissions_ckeckbox_list).append(
                        '<div class="custom-control custom-checkbox">'+
                            // '<input type="checkbox" class="custom-control-input" id="'+ element.slug +'" name="permissions[]" value="'+ element.id +'">'+
                            '<label class="custom-control-label" for="'+ element.slug +'">'+ element.name +'</label>'+
                        '</div>'
                    );
                });
            });
        }

        $('#role').on('change', function() {
            var role = $(this).find(':selected');
            var role_id = role.data('role-id');
            var role_slug = role.data('role-slug');

            generateCheckboxes(role_id, role_slug);
        });

        // Trigger change event on page load to generate checkboxes for the initially selected role
        var initialRole = $('#role').find(':selected');
        var initialRoleID = initialRole.data('role-id');
        var initialRoleSlug = initialRole.data('role-slug');

        generateCheckboxes(initialRoleID, initialRoleSlug);
    });
    </script>


    {{-- <script type="text/javascript">
        $(document).ready(function(){
            let userUrl = "{{ url('/permission/{id}/edit') }}";
            var permissions_box = $('#permissions_box');
            var permissions_ckeckbox_list =$('#permissions_ckeckbox_list')

            permissions_box.hide();

            $('#role').on('change', function() {
                var role = $(this).find(':selected');
                var role_id = role.data('role-id');
                var role_slug = role.data('role-slug');

                // console.log(role_slug);

                permissions_ckeckbox_list.empty();

                $.ajax({
                    url: userUrl,
                    method: 'get',
                    dataType: 'json',
                    data: {
                        role_id: role_id,
                        role_slug: role_slug,
                    }
                }).done(function(data) {

                    console.log(data);

                    permissions_box.show();
                    permissions_ckeckbox_list.empty();

                    $.each(data, function(index, element){
                        $(permissions_ckeckbox_list).append(
                            '<div class="custom-control custom-checkbox">'+
                                // '<input class="custom-control-input" type="checkbox" name="permission[]" id="'+ element.slug +'" value="'+ element.id +'" checked disabled>' +
                                '<label class="custom-control-label" for="'+ element.slug +'">'+ element.name +'</label>'+
                            '</div>'
                        );
                    });
                });
            });
        });
    </script> --}}
@endsection
