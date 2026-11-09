@extends('layouts.public')

@section('title', 'Discover How RoomDekho Works')

@section('content')
    @include('documentation.partials.styles')

    <div class="doc-progress" aria-hidden="true"><span id="docProgress"></span></div>

    <div class="doc-page" id="docTop">
        @include('documentation.partials.hero')
        @include('documentation.partials.subnav')
        @include('documentation.partials.overview')
        @include('documentation.partials.workflow')
        @include('documentation.partials.guides.index')
        @include('documentation.partials.trust')
        @include('documentation.partials.faq')
        @include('documentation.partials.cta')
    </div>

    @include('documentation.partials.scripts')
@endsection
