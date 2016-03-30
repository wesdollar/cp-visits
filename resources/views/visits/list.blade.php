@extends('layouts.app')

@section('content')
    <div class="container">

        @include('partials.listHeader')

        <div class="row">
            <div class="col-md-12">

                <ul class="list-group top-margin">
                    @foreach ($visitee->visits as $visit)
                        <li class="list-group-item">
                            <div class="container">
                                <div class="col-md-12">

                                    <p>
                                        {{ $visit->user->first }} {{ $visit->user->last }}<br>
                                        {{ ($visit->type) ? $visit->type->name : 'Visited' }} on {{ $visit->created_at->format('M d, Y \a\t g:ia') }}<br>
                                        <span class="text-muted">More user information</span>
                                    </p>

                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>

            </div>
        </div>

    </div>
@endsection
