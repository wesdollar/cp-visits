@extends('layouts.app')

@section('content')
    <div class="container">

        @include('partials.listHeader')

        <div class="row top-margin">
            <div class="col-md-12">

                <ul class="list-group">
                    @foreach ($visitee->notes as $note)
                        <li class="list-group-item">
                            <div class="container">
                                <div class="col-md-3">

                                    <p>
                                        {{ $note->visit->user->first }} {{ $note->visit->user->last }}<br>
                                        Visited on {{ Carbon\Carbon::createFromDate($note->create_at)->format('M d, Y \a\t g:ia') }}<br>
                                        <span class="text-muted">More user information</span>
                                    </p>

                                </div>
                                <div class="col-md-9">

                                    <p>{{ $note->note }}</p>

                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>

            </div>
        </div>

    </div>
@endsection
