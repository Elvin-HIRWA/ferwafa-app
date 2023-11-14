   {{-- <div class="container"> --}}
       <div class="row " style="display: flex; justify-content: center">
           <div style="margin-left:0" class="col-md-10 col-sm-10 col-xs-10">
               <div class="entry-meta">
                   <div style="display: flex; justify-content: center; gap:12px">
                       @if ($day)
                           <div>
                               <a href="{{ route('fixtures.show', [request()->route('divisionID'), $categoryID, $day->id]) }}"> Results
                                   & Fixtures</a>
                           </div>
                           <div>
                               <a href="{{ route('men.first-division-table', [request()->route('divisionID'), $categoryID]) }}">Standing</a>
                           </div>
                       @else
                           <h1>No Available Fixtures</h1>
                       @endif
                   </div>
                   <div style="display: flex; justify-content: center">
                       @foreach ($days as $day)
                           <div class="post-date">
                               <a href="{{ route('fixtures.show', [request()->route('divisionID'), $categoryID, $day->id]) }}">{{ $day->abbreviation }}
                               </a>
                           </div>
                       @endforeach
                   </div>
               </div>
           </div>
       </div>
