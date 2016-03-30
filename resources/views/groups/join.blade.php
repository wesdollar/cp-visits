@extends('layouts.app')

@section('content')
    <div class="container">

        @include('partials.flashMessage')

        <div class="row top-margin">
            <div class="col-md-12">

                @foreach ($groups as $group)
                    <a href="{{ url('groups/join/'. $group->id) }}" class="btn btn-lg btn-block btn-primary">
                        {{ $group->name }}
                    </a>
                @endforeach

            </div>
        </div>
    </div>
@endsection