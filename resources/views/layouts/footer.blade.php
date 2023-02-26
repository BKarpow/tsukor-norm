<footer class="navbar-fixed-bottom main-footer">
    <div class="container">
        <div class="row">

            <div class="col-md-6">
                <p>Сайт розроблено для допомоги людям, які хворіють на цукровий діабет. На сайті немає і ніколи не буде реклами, пітримати проект можна на PayPal: bogdan.karpow@ukr.net  </p>
                <p class="align-self-end">{{ date("Y") }}рік. &copy; розробник Богдан Карпов</p>
            </div>
            <!-- /.col-md-4 -->

            <div class="col-md-2">
                <ul class="footer-list">
                    <li>
                        <a class="footer-link" href="/">
                            Головна
                        </a>
                    </li>
                    <li>
                        <a class="footer-link" href="https://blog.tsukor-norm.pp.ua">
                            Статті
                        </a>
                    </li>
                    <li>
                        <a href="{{route('med.create')}}" class="footer-link">
                            Додати препарат
                        </a> <!-- /.footer-link -->
                    </li>

                </ul>
            </div>
            <!-- /.col-md-4 -->

            <div class="col-md-4">
                <h4>Контакти</h4>
                email: bogdan.karpow@ukr.net
                <h4>Задати питання</h4>
                <form action="{{route('feedback.store')}}" method="POST">
                    @csrf
                    <div class="gotm-group py-1">
                        <input name="email" type="email" required placeholder="Ваша email" class="form-control">
                    </div>
                    <!-- /.gotm-group -->
                    <div class="form-group py-1">
                        <textarea name="answer" placeholder="Яке у Вас питання?" name="" id="" cols="30" rows="3" class="form-control"></textarea>
                        <!-- /#.form-control -->
                        </div>
                    <!-- /.form-group -->

                    <div class="col-md-6">
                        {!! RecaptchaV3::field('register') !!}
                        @if ($errors->has('g-recaptcha-response'))
                            <span class="help-block">
                                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group py-1">
                        <button class="btn btn-success">Надіслати</button>
                        <!-- /.btn btn-success -->
                    </div>
                    <!-- /.form-group -->
                </form>
            </div>
            <!-- /.col-md-4 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->

</footer>
