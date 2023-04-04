
<div class="my-1">
        <chart-7></chart-7>
</div><!-- /.my-1 -->


<div class="container mb-2">
    <div class="row mb-2">
        <div class="col-md-4 mb-2">
            <h4>Середній цукор</h4>
            <ul class="list-group">
                <li class="list-group-item">
                    (За весь час) &nbsp; {{$sugarAvg}}
                </li><!-- /.list-group-item -->

                <li class="list-group-item">
                    За сьогодні: {{$avgGluToDay}}
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
        <div class="col-md-4">
            <h4>Статистика вимірювань</h4>
            <ul class="list-group">
                <li class="list-group-item">
                    Вимірів, всього: {{ $sugarCount }}.
                </li>
                <!-- /.list-group-item -->
                <li class="list-group-item">
                    Середня кількість вимірів в день за останній тиждень: {{$avgPerDay}}.
                </li>
                <!-- /.list-group-item -->
            </ul>
            <!-- /.list-group -->
        </div>
        <!-- /.col-md-4 -->
        <div class="col-md-4">
            <h5>Контроль діабету</h5>
            @if ($avgPerDay < 2)
                <div class="alert alert-danger">
                    <p style="text-align:center;font-size:64px;color:var(--bg-red);">
                        <i class="bi bi-emoji-frown-fill"></i>
                    </p>
                    <strong>Поганий контроль діабету, частіше контролюйте цукор, або не забувайте записувати виміри! Пам'ятайте що діабет потребує контролю!</strong>
                </div>
                <!-- /.alert alert-warning -->
            @elseif ($avgPerDay >= 2 && $avgPerDay < 5)
            <div class="alert alert-success">
                <p style="text-align:center;font-size:64px;color:var(--bg-green);">
                    <i class="bi bi-emoji-smile-fill"></i>
                </p>
                <strong>Чудовий контроль діабету, так тримати.</strong>
            </div>
            <!-- /.alert alert-warning -->
            @elseif ($avgPerDay >= 5 )
            <div class="alert alert-success">
                <p style="text-align:center;font-size:64px;color:var(--bg-green);">
                    <i class="bi bi-emoji-laughing-fill"></i>
                </p>
                <strong>Чудовий контроль діабету, ви просто молодець!</strong>
            </div>
            <!-- /.alert alert-warning -->
            @endif
        </div>
        <!-- /.col-md-4 -->
    </div><!-- /.row -->
    <profile-app></profile-app>
</div><!-- /.container -->
{{-- <div class="sugar-table">


</div> --}}

