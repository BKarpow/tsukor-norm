<div class="my-2 d-flex justify-content-around flex-wrap">
    @auth
        @if (Route::currentRouteName() != 'home')
            <a href="{{ route('home') }}" title="Додому" class="btn-tn m-1  scrollto">
                <i class="fa-solid fa-house"></i>
            </a><!-- /.btn btn-primary -->
        @endif
        <!-- medicamentTake.create -->
        <a href="{{ route('sugar.add') }}"
        class="btn-tn m-1  scrollto"
        >
            <i class="bi bi-node-plus-fill"></i> Глюкоза крові
        </a><!-- /.btn btn-primary -->
        @if(auth()->user()->use_tablet)
            <a href="{{ route('medicamentTake.create') }}"
            class="btn-tn m-1  scrollto"
            >
            <i class="fa-solid fa-pills"></i> Прийом ліків
            </a><!-- /.btn btn-primary -->
        @endif
        @if(auth()->user()->use_insulin)
            <a href="{{ route('insulinLog.create') }}"
            class="btn-tn m-1  scrollto"
            >
                <i class="fa-solid fa-syringe"></i> Прийом інсуліну
            </a><!-- /.btn btn-primary -->
        @endif
        <a href="{{ route('bloodPressure.create') }}"
        class="btn-tn m-1  scrollto">
            <i class="fa-solid fa-square-plus"></i> АТ та пульс
        </a><!-- /.btn btn-primary -->
        <a href="{{ route('note.create') }}"
        class="btn-tn m-1  scrollto">
            <i class="fa-solid fa-square-plus"></i> Нотатка
        </a><!-- /.btn btn-primary -->

        <btn-hb url="{{route('hba1c.create')}}"></btn-hb>

    @endauth

</div><!-- /.my-2 -->
