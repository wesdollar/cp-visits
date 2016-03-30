@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">

                <h3>Create a New Group</h3>
                <p class="text-muted">
                    You will automatically be assigned as the owner of any new groups you create. Once the group is created, other users will be able to search for your group once they log in and send you a request to join your group. A group can have more than one owner; only owners may approve new members' request to join the group. A user must be a member of the group before they can be added as an owner. Any owner can assign a member as an owner.
                </p>

                <form class="form" role="form" method="POST" action="{{ url('/groups/create') }}">

                    {!! csrf_field() !!}

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}" style="margin-top: 20px;">

                        <label class="control-label" for="form-name">Group Name</label>
                        <input type="text" class="form-control" id="form-name" name="name" placeholder="{{ old('name') }}">

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif

                    </div> <!-- // name -->

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

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <span class="glyphicon glyphicon-pushpin"></span> Create Group
                        </button>

                        <a class="btn btn-link" href="{{ url('/groups') }}">
                            Cancel
                        </a>
                    </div>

            </div>
        </div>

    </div>
@endsection
