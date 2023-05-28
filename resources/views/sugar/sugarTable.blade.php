<div class="my-1 p-2">
    <a href="{{ route('pdfExport') }}" class="btn ">
        <i class="bi bi-arrow-90deg-right"></i> Експортувати в <i class="bi bi-filetype-pdf"></i>
    </a> <!-- /.btn btn-info -->


</div>
<!-- /.my-1 -->
<h3>Вимірювання цукру по дням</h3>
    <info>
        <div class="">
            <ul class="list-group">
                <li class="list-group-item">
                    <i class="fa-solid fa-cookie fa-2xl"></i> - До їжі
                </li>
                <li class="list-group-item">
                    <i class="fa-solid fa-cookie-bite fa-2xl"></i> - Після їжі
                </li>
                <li class="list-group-item">
                    <i class="fa-solid fa-face-flushed fa-shake fa-2xl"></i> -
                    Стрес
                </li>
                <li class="list-group-item">
                    <i class="fa-solid fa-virus-covid fa-beat-fade fa-2xl"></i>
                    - Хвороба
                </li>
                <li class="list-group-item">
                    <i class="fa-solid fa-dumbbell fa-rotate-90 fa-2xl"></i> -
                    До фіз. навантаження
                </li>
                <li class="list-group-item">
                    <i class="fa-solid fa-dumbbell fa-beat fa-2xl"></i> - Під
                    час фіз. навантаження
                </li>
                <li class="list-group-item">
                    <i class="fa-solid fa-dumbbell fa-2xl"></i> - Після фіз.
                    навантаження
                </li>
                <li class="list-group-item">
                    <i class="fa-solid fa-cubes-stacked fa-2xl"></i> - Без мітки
                </li>
                <li class="list-group-item">
                    <img
                    width="36"
                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAAC8klEQVR4nO2aS2sUQRSFPwRDxAd5iZClCUYl4iIuA6I7QX+BJj5A3YqrRFeuZbL2BwhOIj728RGJCw1xaZIxIihE0YXG6GacYEnBGSia6Uw/qrtHmAOXpnuqzq0z9bq3q6GNNgpDN3AReAysAL9lFeARcEllWhadwATwAzBNbB24AeygxdAPvHYaOgtcBoaAnbIhPZt1yi2obkugH/iohr0DjkeoY8u8V51PrSCm0+mJeaAnRt1e4KXqvhJXYZhUQz4AfQnqW+Gr4rDzqxB0ORP7RAqek+L4Ls7ccV4NeOqB65m4LGfueCDnVzxwXRXXfQrAipwf9MB1SFyWM3f8kvNdHrh2i2uDAmBkrcoXGW0hIWj3yP8ytHq1v8wAi8AaUNV1EZgGxlXOq+Ok2ASuO/eDauRmhLTAADWgrHqFCjmlawcwBfyJKMAEzNYriacQIWh4PE8owATMRtb7ihCy18lRfNlqlKjcp5DtHnvCBGy+2TDzKWTKU6O/AiPAaOB5KYqQpHZHPIMpJrYJiBgW57HAb3a5HshCyF8nap72LGJY98Ey5SyEvHFWqVpKrm/AEfHZP+dLSLnNsImfxvmtQJaZZU8Yx8Z8CznjYVjFFWHkz6uQ/eJYzFGEAZZ9C9kjjs8ZzgnTwH76FmI3QLQs5tETxpnwXoXUY6C1nHrCZNUjR2POER8iDLDkW8jpGKtW2uFkmm2KGykI67HPeE49YWTnGgmppCBccl5i13ISUQs7Kau/Mk1qh8VTzng4Gdk9QnAhJfHdLaLfEc8iqltFv106CkhKbtf0A+IqBX4bVSjuQ4QBbtMEEykdPAG2KYN74anRJmBzzgYcik4dm6VxdNPJ2eunV7nm7HX060AzqbOKk1P3eeyZuSTHgcHj6ai20OCVTYfmTNw4zMiqmhNNh9NWw2wy4gcDtsy1Js4GtGRGzSBrKh+6OsVFtz7TeOh8wmGjgLc6WjvrhPFR0KPMrqx8Yl0Nt9dlPR+LeTTeRhtkhH9wKgdqZkIycgAAAABJRU5ErkJggg=="
                /> - Прийом ліків
                </li>
                <li class="list-group-item">
                    <i class="bi bi-heart-pulse-fill fa-2xl"></i> - Артеріальний тиск та пульс
                </li>
                <li class="list-group-item">
                    <i  class="fa-solid fa-heart-pulse fa-bounce fa-2xl"></i> - Тахікардія
                </li>
            </ul>
            <!-- /.group-list -->
        </div>
        <!-- /.my-1 -->
    </info>

<div class="my-1">
    @if ($sugars->count() == 0)
        <div class="alert alert-info">
            <strong>
                У Вас немає записів про ваш рівень цукру крові.
            </strong>
        </div>
        <!-- /.alert alert-info -->
    @endif
    @foreach ($sugars as $sugar)
        {{-- <glu-item
            :glu="{{(float)$sugar->glucoseLevel()}}"
            :bf="{{(int)$sugar->before_food}}"
            :af="{{(int)$sugar->after_food}}"
            :be="{{(int)$sugar->before_exercise}}"
            :ae="{{(int)$sugar->after_exercise}}"
            :s="{{(int)$sugar->stress}}"
            :h="{{(int)$sugar->disease}}"
            :max="{{(float)$sugarTargetRange->max_glu}}"
            :maxnt="{{(float)$sugarTargetRange->max_nt_glu}}"
            :min="{{(float)$sugarTargetRange->min_glu}}"
            time="{{$sugar->dateCreate('H:i')}}"
            date="{{$sugar->dateCreate('d.m.Y')}}"
            note="{{$sugar->comment}}"
            delete-url="{{route('sugar.delete',['mySugar'=>$sugar])}}"
            edit-url="{{route('sugar.edit',['mySugar'=>$sugar])}}"
        >
        </glu-item> --}}
        <new-panel date="{{ date('Y-m-d', strtotime($sugar->created_at)) }}"></new-panel>
    @endforeach
</div>
<!-- /.my-1 -->

<div class="d-flex my-2 justify-content-center align-items-center p-1">
    {{ $sugars->links() }}
</div><!-- /.d-flex my-2 justify-content-center align-items-center p-1 -->
