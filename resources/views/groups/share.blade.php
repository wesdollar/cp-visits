@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">

                <h3>Share Your Visitation List</h3>
                <p class="text-muted">
                    Sharing your visitation list is easy! Enter the email address of each person you would like to invite to join your list. We'll send them an email with a few simple steps they'll need to complete that will enable them to subscribe to your list.
                </p>

                <form class="form" role="form" method="POST" action="{{ url('/groups/'.$groupId.'/share') }}">

                    {!! csrf_field() !!}

                    <div class="form-group" style="margin-top: 20px;">

                        <label class="control-label" for="form-name">Email Address</label>
                        <input type="text" class="form-control" id="form-name" name="email[]" placeholder="email address">

                        <div id="extraEmails"></div>

                        <br><a style="cursor: pointer;" id="addEmail">
                            <i class="fa fa-plus"></i>
                            Add Email Address
                        </a>

                    </div> <!-- // name -->

                    <div class="form-group top-margin">
                        <button type="submit" class="btn btn-primary">
                            <span class="glyphicon glyphicon-pushpin"></span> Submit
                        </button>

                        <a class="btn btn-link" href="{{ url('/groups') }}">
                            Cancel
                        </a>
                    </div>

                </form>

            </div>
        </div>

    </div>

@endsection
