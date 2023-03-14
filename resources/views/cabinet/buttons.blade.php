<div class="my-2 d-flex justify-content-around flex-wrap">
    @auth
        @if (Route::currentRouteName() != 'home')
            <a href="{{ route('home') }}" title="Додому" class="btn btn-primary m-1">
                <i class="fa-solid fa-house"></i>
            </a><!-- /.btn btn-primary -->
        @endif
        <a href="{{ route('sugar.add') }}" class="btn btn-primary m-1">
            <i class="fa-solid fa-square-plus"></i> Глюкоза крові
        </a><!-- /.btn btn-primary -->
        <a href="{{ route('bloodPressure.create') }}" class="btn btn-primary m-1">
            <i class="fa-solid fa-square-plus"></i> АТ та пульс
        </a><!-- /.btn btn-primary -->
        <a href="{{ route('hba1c.create') }}" class="btn btn-primary m-1">
            <i class="fa-solid fa-square-plus"></i> HbA1c
        </a><!-- /.btn btn-primary -->
    @endauth
</div><!-- /.my-2 -->
