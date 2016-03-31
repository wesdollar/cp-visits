@extends('layouts.app')

@section('content')
    <div class="container">

        @include('partials.flashMessage')

        <div class="row">
            <div class="col-md-12">
                <p>
                    <a href="{{ url('/visitees/create') }}" class="btn btn-primary btn-block">
                        Add New Visitee
                        <i class="fa fa-forward"></i>
                    </a>
                </p>
            </div>
        </div>

        @if ($iVisitees < 1)
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info">
                        <p>None of your groups have any visitees. To get started, click below to add a visitee.</p>
                        <p class="top-margin">
                            <a href="{{ url('visitees/create') }}" class="btn btn-lg btn-success btn-block">
                                Add a Visitee
                            </a>
                        </p>
                    </div>
                </div>
            </div>

        @else

            @foreach ($user->groups as $group)

                @if ($group->visitees->count() >= 1)
                    <div class="row">
                        <div class="col-md-12">

                            <h3>{{ $group->name }}</h3>

                            <ul class="list-group top-margin">
                                @foreach ($group->visitees as $visitee)
                                    <li class="list-group-item">

                                        <div class="row">
                                            <div class="col-md-6">

                                                <p>
                                                    <strong>{{ $visitee->first }} {{ $visitee->last }} <br></strong>
                                                    {!! ($visitee->address) ? $visitee->address . '<br>' : null !!}
                                                    {{ ($visitee->city) ? $visitee->city . ', ' : null }}
                                                    {{ ($visitee->state) ? $visitee->state : null }}
                                                    {{ ($visitee->zip) ? $visitee->zip : null }}
                                                </p>

                                                <div class="row">
                                                    <div class="col-md-3">
                                                        Total Visits
                                                    </div>
                                                    <div class="col-md-9">
                                                        @if ($visitee->visits->count() > 0)
                                                            <a class="btn btn-link" href="{{ url('/visitees/'. $visitee->id . '/visits') }}">
                                                                {{ $visitee->visits->count() }}
                                                                <sup><i class="fa fa-calendar-check-o"></i></sup>
                                                            </a>
                                                        @else
                                                            <span class="btn btn-link disabled text-muted">
                                                        {{ $visitee->visits->count() }}
                                                    </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        Visitor Notes
                                                    </div>
                                                    <div class="col-md-9">
                                                        @if ($visitee->notes->count() > 0)
                                                            <a class="btn btn-link" href="{{ url('/visitees/'. $visitee->id . '/notes') }}">
                                                                {{ $visitee->notes->count() }}
                                                                <sup><i class="fa fa-comment"></i></sup>
                                                            </a>
                                                        @else
                                                            <span class="btn btn-link disabled text-muted">
                                                        {{ $visitee->notes->count() }}
                                                    </span>
                                                        @endif
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-md-6">

                                                @if ($user->visits()->where('visitee_id', $visitee->id)->whereDate('created_at', '=', date('Y-m-d'))->first())
                                                    <a href="#" class="btn btn-lg btn-success disabled btn-block">
                                                        <span class="glyphicon glyphicon-ok"></span>
                                                        You Checked In!
                                                    </a>
                                                @else
                                                    <a href="{{ url('visitees/' . $visitee->id . '/visits/create') }}" class="btn btn-lg btn-primary btn-block">
                                                        <span class="glyphicon glyphicon-ok"></span>
                                                        Check In
                                                    </a>
                                                @endif

                                                @if ($visitee->phone)
                                                    <a href="tel:{{ $visitee->phone }}" class="btn btn-lg btn-primary btn-block">
                                                        <span class="glyphicon glyphicon-phone"></span>
                                                        Call
                                                    </a>
                                                @endif

                                                    <a href="{{ url('visitees/'. $visitee->id . '/edit') }}" class="btn btn-lg btn-warning btn-block">
                                                        <i class="fa fa-trash"></i>
                                                        Edit Details
                                                    </a>

                                                    <a href="{{ url('visitees/'. $visitee->id . '/remove') }}" class="btn btn-lg btn-danger btn-block">
                                                        <i class="fa fa-trash"></i>
                                                        Remove from List
                                                    </a>

                                            </div>
                                        </div>

                                    </li>
                                @endforeach
                            </ul>

                        </div>
                    </div>

                @endif

            @endforeach

        @endif

    </div>
@endsection
