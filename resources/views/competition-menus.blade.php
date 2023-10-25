{{-- @include('mainMenuBar', ['name' => 'News']) --}}

<div class="container-fluid eventlist blog blogpost upcoming-event latest-blog no-padding">
    <div class="container">
        <div class="row " style="display: flex; justify-content: center">
            <div class="col-md-10 col-sm-10 col-xs-6 blog-box">
                <article class="type-post">
                    <div class="entry-block">
                        <div class="entry-meta">
                            <div style="display: flex; justify-content: center">
                                @if ($day)
                                    <div class="post-date">
                                        <a href="{{ route('fixtures.show', [$categoryID, $day->id]) }}">Results
                                            & Fixtures</a>
                                    </div>
                                    <div class="post-date">
                                        <a href="{{ route('men.first-division-table', $categoryID) }}">Standing</a>
                                    </div>
                                @else
                                    <h1>No Available Fixtures</h1>
                                @endif
                            </div>
                            <div style="display: flex; justify-content: center">
                                @foreach ($days as $day)
                                    <div class="post-date">
                                        <a href="{{ route('fixtures.show', [$categoryID, $day->id]) }}">{{ $day->abbreviation }}
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
            </div>
            </article>
        </div>

    </div>
</div>
</div>

{{-- @include('footer') --}}
