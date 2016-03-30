@extends('layouts.app')

@section('content')
    <div class="container">

        <h3>Tell us about your visit with {{ $visitee->first }}!</h3>

        <form class="form" role="form" method="POST" action="{{ url('/visitees/' . $visitee->id . '/visits/create') }}">

            {!! csrf_field() !!}

            <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}" style="margin-top: 20px;">

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

            <p class="text-muted">
                <button type="submit" class="btn btn-link">
                    Skip Leaving a Note
                </button>
            </p>
            <p>
                Include any information you would like. Other members of your group will be able to view the message you leave, so feel free to share anything you think would make their visit with {{ $visitee->first }} even better. For example,
            </p>
            <ul>
                <li>"{{ $visitee->first }} really enjoys playing chess. Be sure to bring a chess board!"</li>
                <li>"I had a hard time finding {{ $visitee->first }}'s room. It's around the corner on the right."</li>
            </ul>

            <div class="form-group{{ $errors->has('note') ? ' has-error' : '' }}" style="margin-top: 20px;">
                <label class="control-label" for="form-note">Your Message</label>
                <textarea class="form-control" id="form-note" name="note" rows="5">{{ old('note') }}</textarea>

                @if ($errors->has('note'))
                    <span class="help-block">
                        <strong>{{ $errors->first('note') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-pushpin"></span> Add Note
                </button>

                <a class="btn btn-link" href="{{ url('/visitees/check-in/' . $visitee->id) }}">
                    Don't Leave a Note
                </a>
            </div>

        </form>

    </div>
@endsection
