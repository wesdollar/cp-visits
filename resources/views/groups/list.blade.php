@extends('layouts.app')

@section('content')
    <div class="container">

        @include('partials.flashMessage')

        @if ($user->groups->count() > 0)
            <div class="row">
                <div class="col-md-12">
                    @if (!$user->settings()->where('name', 'default_group')->first())
                        <div class="alert alert-danger">
                            <p><strong>You have not selected a default group!</strong></p>
                            <p>Selecting a default group will allow us to display information pertaining to the group you select as your default so that you'll be able to work within that group without having to return here to select a group each time you would like to perform an action.</p>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <p>
                    <a href="{{ url('/groups/create') }}" class="btn btn-block btn-primary">
                        <i class="fa fa-group"></i>
                        Create a New List
                    </a>
                </p>

                <p>
                    <input type="text" id="search-input" class="form-control" placeholder="Search for List to Join" />
                    <script src="//cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
                    <script src="//cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
                    <script>
                        var client = algoliasearch("LR7BM1EUM9", "88f9cf2ab4ea77179bf77285c7631fd9");
                        var index = client.initIndex('groups');
                        autocomplete('#search-input', {hint: false}, [
                            {
                                source: autocomplete.sources.hits(index, {hitsPerPage: 5}),
                                displayKey: 'name',
                                templates: {
                                    suggestion: function(suggestion) {
                                        return suggestion._highlightResult.name.value;
                                    }
                                }
                            }
                        ]).on('autocomplete:selected', function(event, suggestion, dataset) {
                            // console.log(suggestion.id, dataset);
                            window.location = '/groups/join/' + suggestion.id;
                        });
                    </script>
                </p>

                <h3>Your Lists</h3>
            </div>
        </div>

        @if ($user->groups->count() < 1)
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <em>You do not belong to any groups!</em> Join a group!
                    </p>
                </div>
            </div>
        @endif

        <div class="row top-margin">
            <div class="col-md-12">

                <ul class="list-group">

                    @foreach ($user->groups as $group)
                        <li class="list-group-item">

                            <div class="row">
                                <div class="col-md-6">
                                    <span style="font-size: 1.4em;">{{ $group->name }}<br></span>

                                    @if ($group->city != null || $group->state != null || $group->zip != null)

                                        <span class="text-muted">
                            @if ($group->city != null && $group->state != null)
                                                {{ $group->city }}, {{ $group->state }}
                                            @elseif ($group->city != null && $group->state == null)
                                                {{ $group->city }}
                                            @elseif ($group->city == null && $group->state != null)
                                                {{ $group->state }}
                                            @else
                                                {{-- display nothing --}}
                                            @endif

                                            @if ($group->zip != null)
                                                {{ $group->zip }}
                                            @endif
                            </span>

                                    @endif
                                </div>
                                <div class="col-md-6">

                                    <a href="{{ url('/groups/' . $group->id . '/share') }}" class="btn btn-lg btn-primary btn-block">
                                        Share List
                                    </a>

                                    @if (!$user->settings()->where('name', 'default_group')->first())

                                        <a href="{{ url('groups/set-default/' . $group->id) }}" class="btn btn-lg btn-success btn-block">
                                            Set as Default List
                                        </a>

                                    @else

                                        @if ($user->settings()->where('name', 'default_group')->first()->value != $group->id)
                                            <a href="{{ url('groups/set-default/' . $group->id) }}" class="btn btn-lg btn-success btn-block">
                                                Set as Default List
                                            </a>
                                        @else
                                            <i class="fa fa-star"></i> Default List
                                        @endif

                                    @endif

                                        <a href="{{ url('groups/' . $group->id . '/remove') }}" class="btn btn-lg btn-danger btn-block">
                                            <i class="fa fa-trash"></i>
                                            Remove Self from List
                                        </a>

                                </div>
                            </div>

                        </li>
                    @endforeach

                </ul>
            </div>
        </div>
    </div>
@endsection