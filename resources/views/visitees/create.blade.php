@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">

                <h3>Add a Visitee</h3>
                <p class="text-muted">
                    If someone in your group needs a visit, add them to the list! Other members of your group will be able to see the list, check in when they visit, and leave notes about their visit when visiting someone. Once a visitee is created, members of your group will also be able to update the visitee's information so everyone can help keep the visitee's information up to date.
                </p>
                <p>
                    The details you enter here will only be available to members of your group!
                </p>

                <form class="form" role="form" method="POST" action="{{ url('/visitees/create') }}">

                    {!! csrf_field() !!}

                    <div class="form-group{{ $errors->has('group') ? ' has-error' : '' }}" style="margin-top: 20px;">

                        <label class="control-label" for="form-group">Add to Group</label>
                        <select class="form-control" id="form-group" name="group">

                            @foreach ($groups as $group)
                                <option value="{{ $group->id }}"{{ ($group->id == $userDefaultGroup) ? ' selected' : '' }}>
                                    {{ $group->name }}
                                </option>
                            @endforeach

                        </select>

                        @if ($errors->has('group'))
                            <span class="help-block">
                                <strong>{{ $errors->first('group') }}</strong>
                            </span>
                        @endif

                    </div> <!-- // group -->

                    <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}" style="margin-top: 20px;">

                        <label class="control-label" for="form-category">Visitee Type</label>
                        <select class="form-control" id="form-category" name="category_id">

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"{{ ($category->id == old('category_id')) ? ' selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach

                        </select>

                        @if ($errors->has('category_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('category_id') }}</strong>
                            </span>
                        @endif

                    </div> <!-- // category -->

                    <div class="form-group{{ $errors->has('first') ? ' has-error' : '' }}" style="margin-top: 20px;">

                        <label class="control-label" for="form-first">
                            First Name
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" id="form-first" name="first" placeholder="{{ old('first') }}">

                        @if ($errors->has('first'))
                            <span class="help-block">
                                <strong>{{ $errors->first('first') }}</strong>
                            </span>
                        @endif

                    </div> <!-- // first name -->

                    <div class="form-group{{ $errors->has('first') ? ' has-error' : '' }}">

                        <label class="control-label" for="form-last">
                            Last Name
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" id="form-last" name="last" placeholder="{{ old('last') }}">

                        @if ($errors->has('last'))
                            <span class="help-block">
                                <strong>{{ $errors->first('last') }}</strong>
                            </span>
                        @endif

                    </div> <!-- // last name -->

                    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}" style="margin-top: 20px;">

                        <label class="control-label" for="form-address">Address</label>
                        <input type="text" class="form-control" id="form-address" name="address" placeholder="{{ old('address') }}">

                        @if ($errors->has('address'))
                            <span class="help-block">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                        @endif

                    </div> <!-- // address -->

                    <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}" style="margin-top: 20px;">

                        <label class="control-label" for="form-city">City</label>
                        <input type="text" class="form-control" id="form-city" name="city" placeholder="{{ old('city') }}">

                        @if ($errors->has('city'))
                            <span class="help-block">
                                <strong>{{ $errors->first('city') }}</strong>
                            </span>
                        @endif

                    </div> <!-- // city -->

                    <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}" style="margin-top: 20px;">

                        <label class="control-label" for="form-state">State</label>
                        <select class="form-control" id="form-state" name="state">

                            <option value="">
                                -- Select State --
                            </option>
                            @foreach ($usStates as $state)
                                <option value="{{ $state->abbr }}">
                                    {{ $state->name }}
                                </option>
                            @endforeach

                        </select>

                        @if ($errors->has('state'))
                            <span class="help-block">
                                <strong>{{ $errors->first('state') }}</strong>
                            </span>
                        @endif

                    </div> <!-- // state -->

                    <div class="form-group{{ $errors->has('zip') ? ' has-error' : '' }}" style="margin-top: 20px;">

                        <label class="control-label" for="form-zip">Zip Code</label>
                        <input type="text" class="form-control" id="form-zip" name="zip" placeholder="{{ old('zip') }}">

                        @if ($errors->has('zip'))
                            <span class="help-block">
                                <strong>{{ $errors->first('zip') }}</strong>
                            </span>
                        @endif

                    </div> <!-- // zip -->

                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}" style="margin-top: 20px;">

                        <label class="control-label" for="form-phone">Phone Number</label>
                        <input type="text" class="form-control" id="form-phone" name="phone" placeholder="{{ old('phone') }}">

                        @if ($errors->has('phone'))
                            <span class="help-block">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif

                    </div> <!-- // phone -->

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}" style="margin-top: 20px;">

                        <label class="control-label" for="form-email">Email Address</label>
                        <input type="text" class="form-control" id="form-email" name="email" placeholder="{{ old('email') }}">

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif

                    </div> <!-- // email -->

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <span class="glyphicon glyphicon-pushpin"></span> Add Visitee
                        </button>

                        <a class="btn btn-link" href="{{ url('/visitees') }}">
                            Cancel
                        </a>
                    </div>

            </div>
        </div>

    </div>
@endsection