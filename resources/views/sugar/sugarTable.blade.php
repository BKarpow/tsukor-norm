<div class="my-1 p-2">
    <a href="{{ route('pdfExport') }}" class="btn ">
        <i class="bi bi-arrow-90deg-right"></i> Експортувати в <i class="bi bi-filetype-pdf"></i>
    </a> <!-- /.btn btn-info -->


</div>
<!-- /.my-1 -->
<h3>Вимірювання цукру по дням</h3>
<div class="my-1">
    <ul class="list-group list-group-horizontal-md">
        <li class=" list-group-item">
            <i  class="fa-solid fa-cookie fa-2xl "></i> - До їжі
        </li>
        <li class=" list-group-item">
            <i  class="fa-solid fa-cookie-bite fa-2xl  "></i> - Після їжі
        </li>
        <li class=" list-group-item">
            <i  class="fa-solid fa-face-flushed fa-shake fa-2xl  "></i> - Стрес
        </li>
        <li class=" list-group-item">
            <i  class="fa-solid fa-virus-covid fa-beat-fade fa-2xl "></i> - Хвороба
        </li>
        <li class="list-group-item">
            <i class="fa-solid fa-dumbbell fa-rotate-90 fa-2xl"></i> - До фіз. навантаження
        </li>
        <li class="list-group-item">
            <i class="fa-solid fa-dumbbell fa-beat fa-2xl"></i> - Під час фіз. навантаження
        </li>
        <li class="list-group-item">
            <i class="fa-solid fa-dumbbell fa-2xl"></i> - Після фіз. навантаження
        </li>
    </ul>
    <!-- /.group-list -->
</div>
<!-- /.my-1 -->
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
        <new-panel date="{{ $sugar->date }}"></new-panel>
    @endforeach
</div>
<!-- /.my-1 -->

<div class="d-flex my-2 justify-content-center align-items-center p-1">
    {{ $sugars->links() }}
</div><!-- /.d-flex my-2 justify-content-center align-items-center p-1 -->
