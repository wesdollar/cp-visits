@extends('layouts.marketing')

@section('content')

    <div class="splash-screen">
        <div class="container">

            <div class="row" id="leader">
                <div class="col-md-8 col-md-offset-2">
                    <p class="biggest-font">
                        A visit from a friendly face with a smile has the power to move mountains.
                    </p>
                    <p class="big-font top-gutter">
                        Visit is an app that allows you to create and share lists of people who could use a friendly visit, such as those that are hospitalized or home-bound.
                    </p>

                    @include('partials.appStoreButtons')

                </div>
            </div>

        </div>
    </div>

    <div class="alt-content">
        <div class="container">

            <div class="row icon-row">
                <div class="col-md-4">
                    <i class="fa fa-share-alt biggest-font"></i>
                    <p class="bigger-font">Easily Share Lists</p>
                    <p>
                        After creating a list, anyone that has downloaded the Visit app can search for and request to subscribe to your Visitee list.
                    </p>
                </div>
                <div class="col-md-4">
                    <i class="fa fa-check-square-o biggest-font"></i>
                    <p class="bigger-font">Check-In During Visits</p>
                    <p>
                        Users can check-in while visiting a Visitee and add a note or photo that other subscribers to the list will be able to see.
                    </p>
                </div>
                <div class="col-md-4">
                    <i class="fa fa-list-ul biggest-font"></i>
                    <p class="bigger-font">Live Visit Log</p>
                    <p>
                        Visit tracks check-ins in real time giving everyone subscribed to your list an up-to-date count of how many times someone has been visited.
                    </p>
                </div>
            </div>

        </div>
    </div>

    <a name="about"></a>

    <div class="main-content">

        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-push-6">
                    <p class="center">
                        <img src="{{ asset('img/screen-shots/iphone-visitee-list.png') }}" alt="Visit Visitor Log App by CallingPost">
                    </p>
                </div>
                <div class="col-md-6 col-md-pull-6 big-font">
                    <p>
                        We created Visit to give churches and other groups a way to create, maintain, and share lists of people who could use a friendly visitor from time to time. It's perfect for ensuring that people who are hospitalized or home-bound  aren't forgotten by the members of the church or organization.
                    </p>
                    <p>
                        Visit puts an up-to-date list of people to visit right in the pocket of anyone with a smart phone. Each member subscribed to the Visitee list is permitted to add and edit Visitees, which means no one central point of contact is required to maintain the list and ensure its information is up to date. Users are given the ability to check-in once they arrive at the Visitee's location and are provided the ability to record notes about their visit, add a photo, and share their experience with the other members of your group.
                    </p>

                    @include('partials.appStoreButtons')

                </div>
            </div>
        </div>

    </div>

@endsection