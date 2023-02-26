<h4>Останні показники цукру крові</h4>
                    <p>Для видалення просто натисніть на показник цукру та пітвердіть свою дію.</p>
    {{-- <div class="table-responsive">
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th title="Цукор крові" aria-label="Цукор крові">GLU</th>
                                <th title="Опис, примітка" aria-label="Опис, примітка">Опис</th>
                                <th title="Година заміру" aria-label="Година заміру">Час</th>
                                <th title="День заміру" aria-label="День заміру">Дата</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sugars as $sugar)
                                <tr>
                                    <td class="glu-level d-flex justify-content-center align-items-center">
                                        @if($sugar->glucoseLevel() > (float)$sugarTargetRange->max_glu)
                                            <i style="color:var(--red-bg);font-size:1rem;" class="px-1 bi bi-exclamation-triangle-fill"></i>
                                            <i style="color:var(--blue-bg);font-size:1rem;" class="px-1 bi bi-caret-up-fill"></i>
                                        @elseif($sugar->glucoseLevel() >= (float)$sugarTargetRange->min_glu && $sugar->glucoseLevel() <= (float)$sugarTargetRange->max_glu)
                                            <i style="color:var(--green-bg);font-size:1rem;" class="px-1 bi bi-bookmark-check-fill"></i>
                                        @elseif($sugar->glucoseLevel() < (float)$sugarTargetRange->min_glu)
                                             <i style="color:var(--red-bg);font-size:1rem;" class="px-1 bi bi-exclamation-triangle-fill"></i>
                                            <i style="color:var(--yellow-bg);font-size:1rem;" class="px-1 bi bi-caret-down-fill"></i>
                                        @endif

                                        <delete-btn delete-url="{{ route('sugar.delete', ['mySugar' => $sugar]) }}">
                                            {{ $sugar->glucoseLevel() }} &nbsp;
                                        </delete-btn>

                                    </td>
                                    <td>
                                        @if($sugar->before_food)
                                            <span class="desc-glucose">
                                                До їжі.
                                            </span>
                                            <!-- /.desc-glucose -->
                                        @elseif($sugar->after_food)
                                            <span class="desc-glucose">
                                                Після їжі.
                                            </span>
                                            <!-- /.desc-glucose -->

                                        @endif

                                        @if($sugar->before_exercise)
                                            <span class="desc-glucose">
                                                До заняття спортом.
                                            </span>
                                            <!-- /.desc-glucose -->
                                        @elseif($sugar->exercise)
                                            <span class="desc-glucose">
                                                Під час заняття спортом.
                                            </span>
                                            <!-- /.desc-glucose -->
                                        @elseif($sugar->before_exercise)
                                            <span class="desc-glucose">
                                                Після заняття спортом.
                                            </span>
                                            <!-- /.desc-glucose -->
                                        @endif

                                        @if($sugar->stress)
                                            <span class="desc-glucose">
                                                Стрес.
                                            </span>
                                            <!-- /.desc-glucose -->
                                        @endif

                                        @if($sugar->disease)
                                            <span class="desc-glucose">
                                                Хвороба.
                                            </span>
                                            <!-- /.desc-glucose -->
                                        @endif
                                        <spoler>
                                            <p>{{$sugar->note}}</p>
                                        </spoler>
                                    </td>
                                    <td>
                                        {{ $sugar->dateCreate("H:i") }}
                                    </td>
                                    <td>
                                        {{ $sugar->dateCreate("d.m.Y") }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
    </div> --}}

<div class="my-1">
    @foreach($sugars as $sugar)
        <glu-item
            :glu="{{(float)$sugar->glucoseLevel()}}"
            :bf="{{(int)$sugar->before_food}}"
            :af="{{(int)$sugar->after_food}}"
            :be="{{(int)$sugar->before_exercise}}"
            :ae="{{(int)$sugar->after_exercise}}"
            :s="{{(int)$sugar->stress}}"
            :h="{{(int)$sugar->disease}}"
            :max="{{(float)$sugarTargetRange->max_glu}}"
            :min="{{(float)$sugarTargetRange->min_glu}}"
            time="{{$sugar->dateCreate('H:i')}}"
            date="{{$sugar->dateCreate('d.m.Y')}}"
            note="{{$sugar->comment}}"
        >
        </glu-item>
    @endforeach
</div>
<!-- /.my-1 -->

<div class="d-flex my-2 justify-content-center align-items-center p-1">
    {{$sugars->links()}}
</div><!-- /.d-flex my-2 justify-content-center align-items-center p-1 -->
