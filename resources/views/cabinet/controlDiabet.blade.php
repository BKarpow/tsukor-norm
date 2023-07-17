<div class="row my-2 d-flex justify-content-center align-items-center">
    <div class="col-md-11">

        @if (!$hba1c)
           <alert-w title="ДОДАЙТЕ РІВЕНЬ HBA1C (Глікованого гемоглобіну)!!!" >
            <p><a href="{{ route('hba1c.create') }}" class="btn btn-success">Додати</a></p>
           </alert-w>
        @else
            @if ($hba1c->exceedingIntervalDays())
                <alert-w title="ПОТРІБНО ЗРОБИТИ АНАЛІЗ Глікованого гемоглобіну HbA1c!">
                     Після останнього аналізу пройшло вже
                        білеше 3-х місяців!
                </alert-w>
            @endif

            @if ($avgPerDay < 2 && $hba1c->percentage < 7)
                <alert-w title="Поганий контроль діабету!">
                    Частіше контролюйте цукор, або не забувайте
                    записувати виміри! Пам'ятайте що діабет потребує контролю!
                </alert-w>
            @elseif ($avgPerDay >= 2 && $avgPerDay < 5 && $hba1c->percentage < 7)
                <alert-s :close="true" title="Чудовий контроль діабету, так тримати."></alert-s>
            @endif
            @if ($hba1c->percentage >= 7)

                    <alert-w title="Звернітся до ендокренолога.">Ваш середній рівень цукру за 3 місяця вищий за 7 mmol\l!
                        Cкорегуйте дозу ліків.</alert-w>

            @endif
        @endif
    </div>
    <!-- /.col-md-4 -->
</div>
<!-- /.row my-2 -->
