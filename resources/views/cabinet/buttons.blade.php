<div class="my-2 d-flex justify-content-around flex-wrap">
    @auth
        @if (Route::currentRouteName() != 'home')
            <a href="{{ route('home') }}" title="Додому" class="btn-tn m-1 animate__animated animate__fadeInUp scrollto">
                <i class="fa-solid fa-house"></i>
            </a><!-- /.btn btn-primary -->
        @endif
        <a href="{{ route('sugar.add') }}"
        class="btn-tn m-1 animate__animated animate__fadeInUp scrollto"
        >
            <i class="bi bi-node-plus-fill"></i> Глюкоза крові
        </a><!-- /.btn btn-primary -->
        <a href="{{ route('bloodPressure.create') }}"
        class="btn-tn m-1 animate__animated animate__fadeInUp scrollto">
            <i class="fa-solid fa-square-plus"></i> АТ та пульс
        </a><!-- /.btn btn-primary -->
        <a href="{{ route('hba1c.create') }}"
        class="btn-tn m-1 animate__animated animate__fadeInUp scrollt">
            <i class="fa-solid fa-square-plus"></i> HbA1c
        </a><!-- /.btn btn-primary -->
    @endauth
</div><!-- /.my-2 -->
