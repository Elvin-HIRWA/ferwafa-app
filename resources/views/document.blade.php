@include('mainMenuBar', ['name' => 'Documents'])

<div class="container-fulid no-padding contactus">
    <div class="section-padding"></div>
    <div class="container">
        <div class="row">
            <div class="report-container">
                @foreach ($documents as $document)
                    <div class="report">
                        <div class="report-image">
                            <a><img alt="" src="/static/img/icons/document.png" /></a>
                            <a><img alt="" class="click-report" src="/static/img/icons/click.png" /></a>
                        </div>
                        <div class="report-title">
                            <a href="{{ route('report.doc', $document['url']) }}" target="_blank">
                                <p>{{ $document['title'] }}</p>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</div>

@include('footer')
