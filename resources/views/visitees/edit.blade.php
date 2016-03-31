@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">

                <h3>Edit {{ $visitee->first }}'s Details</h3>

                <form class="form" role="form" method="POST" action="{{ url('/visitees/'.$visitee->id.'/edit') }}">

                    {!! csrf_field() !!}

                    <div class="form-group{{ $errors->has('group') ? ' has-error' : '' }}" style="margin-top: 20px;">

                        <label class="control-label" for="form-group">Group</label>
                        <select class="form-control" id="form-group" name="group">

                            @foreach ($groups as $group)
                                <option value="{{ $group->id }}"{{ ($group->id == $visitee->groups->first()->id) ? ' selected' : '' }}>
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
                                <option value="{{ $category->id }}"{{ ($category->id == $visitee->category_id) ? ' selected' : '' }}>
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
                        <input type="text" class="form-control" id="form-first" name="first" placeholder="{{ old('first') }}" value="{{ (old('first')) ? (old('first')) : $visitee->first }}">

                        @if ($errors->has('first'))
                            <span class="help-block">
                                <strong>{{ $errors->first('first') }}</strong>
                            </span>
                        @endif

                    </div> <!-- // first name -->

                    <div class="form-group{{ $errors->has('last') ? ' has-error' : '' }}">

                        <label class="control-label" for="form-last">
                            Last Name
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" id="form-last" name="last" placeholder="{{ old('last') }}" value="{{ (old('last')) ? (old('last')) : $visitee->last }}">

                        @if ($errors->has('last'))
                            <span class="help-block">
                                <strong>{{ $errors->first('last') }}</strong>
                            </span>
                        @endif

                    </div> <!-- // last name -->

                    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}" style="margin-top: 20px;">

                        <label class="control-label" for="form-address">Address</label>
                        <input type="text" class="form-control" id="form-address" name="address" placeholder="{{ old('address') }}" value="{{ (old('address')) ? (old('address')) : $visitee->address }}">

                        @if ($errors->has('address'))
                            <span class="help-block">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                        @endif

                    </div> <!-- // address -->

                    <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}" style="margin-top: 20px;">

                        <label class="control-label" for="form-city">City</label>
                        <input type="text" class="form-control" id="form-city" name="city" placeholder="{{ old('city') }}" value="{{ (old('city')) ? (old('city')) : $visitee->city }}">

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
                                <option value="{{ $state->abbr }}" {{ ($visitee->state == $state->abbr) ? 'selected' : null }}>
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
                        <input type="text" class="form-control" id="form-zip" name="zip" placeholder="{{ old('zip') }}" value="{{ (old('zip')) ? (old('zip')) : $visitee->zip }}">

                        @if ($errors->has('zip'))
                            <span class="help-block">
                                <strong>{{ $errors->first('zip') }}</strong>
                            </span>
                        @endif

                    </div> <!-- // zip -->

                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}" style="margin-top: 20px;">

                        <label class="control-label" for="form-phone">Phone Number</label>
                        <input type="text" class="form-control" id="form-phone" name="phone" placeholder="{{ old('phone') }}" value="{{ (old('phone')) ? (old('phone')) : $visitee->phone }}">

                        @if ($errors->has('phone'))
                            <span class="help-block">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif

                    </div> <!-- // phone -->

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}" style="margin-top: 20px;">

                        <label class="control-label" for="form-email">Email Address</label>
                        <input type="text" class="form-control" id="form-email" name="email" placeholder="{{ old('email') }}" value="{{ (old('email')) ? (old('email')) : $visitee->email }}">

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif

                    </div> <!-- // email -->

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <span class="fa fa-pencil"></span> Update Visitee
                        </button>

                        <a class="btn btn-link" href="{{ url('/visitees') }}">
                            Cancel
                        </a>
                    </div>

            </div>
        </div>

    </div>
@endsection