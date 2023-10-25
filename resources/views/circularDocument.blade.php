@include('mainMenuBar', ['name' => 'Circular Documents'])

<div class="container-fulid no-padding contactus">
    <div class="section-padding"></div>
    <div class="container">
        <div class="row">
            <div class="report-container">
                @foreach ($circularDocuments as $circularDocument)
                    <div class="report">
                        <div class="report-image">
                            <a><img alt="" src="/static/img/icons/document.png" /></a>
                            <a><img alt="" class="click-report" src="/static/img/icons/click.png" /></a>
                        </div>
                        <div class="report-title">
                            <a href="{{ route('report.doc', $circularDocument['url']) }}" target="_blank">
                                <p>{{ $circularDocument['title'] }}</p>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</div>

@include('footer')
