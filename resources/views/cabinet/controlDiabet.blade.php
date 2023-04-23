<div class="row my-2 d-flex justify-content-center align-items-center">
    <div class="col-md-8">
        <h5>Контроль діабету</h5>
        @if (!$hba1c)
            <div class="alert alert-warning">
                <p style="text-align:center;font-size:64px;color:var(--bg-red);">
                    <i class="bi bi-emoji-frown-fill"></i>
                </p>
                <strong>
                    ДОДАЙТЕ РІВЕНЬ HBA1C (Глікованого гемоглобіну)!!!
                </strong>
                <p><a href="{{route('hba1c.create')}}" class="btn btn-success">Додати</a></p>
            </div>
            <!-- /.alert alert-warning -->
        @else
        @if ($hba1c->exceedingIntervalDays())
        <div class="alert alert-warning mt-1">
            <strong>ПОТРІБНО ЗРОБИТИ АНАЛІЗ Глікованого гемоглобіну HbA1c! Після останнього аналізу пройшло вже білеше 3-х місяців!</strong>
        </div>
        <!-- /.alert alert-warning mt-1 -->
        @endif

        @if ($avgPerDay < 2 && $hba1c->percentage < 7)
            <div class="alert alert-danger">
                <p style="text-align:center;font-size:64px;color:var(--bg-red);">
                    <i class="bi bi-emoji-frown-fill"></i>
                </p>
                <strong>Поганий контроль діабету, частіше контролюйте цукор, або не забувайте
                    записувати виміри! Пам'ятайте що діабет потребує контролю!</strong>
                    <ul>
                        <li>
                            Вимірів в день за 7 днів:: {{$avgPerDay}}.
                        </li>
                        <li>Останній HbA1c: {{$hba1c->percentage}}%</li>
                    </ul>
            </div>
            <!-- /.alert alert-warning -->
        @elseif ($avgPerDay >= 2 && $avgPerDay < 5 && $hba1c->percentage < 7)
            <div class="alert alert-success">
                <p style="text-align:center;font-size:64px;color:var(--bg-green);">
                    <i class="bi bi-emoji-smile-fill"></i>
                </p>
                <strong>Чудовий контроль діабету, так тримати.</strong>
                <ul>
                    <li>
                        Вимірів в день за 7 днів: {{$avgPerDay}}.
                    </li>
                    <li>Останній HbA1c: {{$hba1c->percentage}}%</li>
                </ul>
            </div>
            <!-- /.alert alert-warning -->
        @elseif ($avgPerDay >= 5)
            <div class="alert alert-success">
                <p style="text-align:center;font-size:64px;color:var(--bg-green);">
                    <i class="bi bi-emoji-laughing-fill"></i>
                </p>
                <strong>Чудовий контроль діабету, ви просто молодець!</strong>
                <ul>
                    <li>
                        Середня кількість вимірів в день за останній тиждень: {{$avgPerDay}}.
                    </li>
                    <li>Останній HbA1c: {{$hba1c->percentage}}%</li>
                </ul>
            </div>
            <!-- /.alert alert-warning -->
        @elseif ($hba1c->percentage >= 7)
        <div class="alert alert-danger">
            <p style="text-align:center;font-size:64px;color:var(--bg-red);">
                <i class="bi bi-emoji-frown-fill"></i>
            </p>
            <strong>Поганий контроль діабету, ваш середній рівень цукру за 3 місяця вищий за 7 mmol\l! Дотримуйтесь дієти, лікування, або скорегуйте дозу ліків.</strong>
                <ul>
                    <li>
                        Вимірів в день за 7 днів:: {{$avgPerDay}}.
                    </li>
                    <li>Останній HbA1c: {{$hba1c->percentage}}%</li>
                </ul>
        </div>
        <!-- /.alert alert-warning -->
        @endif
        @endif
    </div>
    <!-- /.col-md-4 -->
</div>
<!-- /.row my-2 -->
