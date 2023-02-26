<div class="my-1">
        <chart-7></chart-7>
</div><!-- /.my-1 -->
<p>Записів про рівень цукру: {{ $sugarCount }}.</p>
<div class="my-2">
    &nbsp;
    <a href="{{ route('sugar.add') }}" class="btn btn-primary">
        + Глюкоза крові
    </a><!-- /.btn btn-primary -->
</div><!-- /.my-2 -->
<div class="container">
    <div class="row mb-2">
        <div class="col-md-4 mb-2">
            <h5>Середній цукор</h5>
            <ul class="list-group">
                <li class="list-group-item">
                    (За весь час) &nbsp; {{$sugarAvg}}
                </li><!-- /.list-group-item -->
                <li class="list-group-item">
                    (За попередні 7 днів) &nbsp; {{$last7Day}}
                </li><!-- /.list-group-item -->
                <li class="list-group-item">
                    (За попередні 14 днів) &nbsp; {{$last14Day}}
                </li><!-- /.list-group-item -->
                <li class="list-group-item">
                    (За попередні 30 днів) &nbsp; {{$last30Day}}
                </li><!-- /.list-group-item -->
                <li class="list-group-item">
                    (За попередні 90 днів) &nbsp; {{$last90Day}}
                </li><!-- /.list-group-item -->
            </ul><!-- /.list-group -->
        </div><!-- /.col-md-4-->
        <chart-dug></chart-dug>
    </div><!-- /.row.d-flex -->
</div><!-- /.container -->
<div class="sugar-table">
    @include('sugar.sugarTable')
</div>

