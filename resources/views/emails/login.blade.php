<h2>Новий вхід на сайт TsukorNorm.</h2>

@if ($isSoc)
<p>Вхід через соціальну мережу.</p>
@endif
<p>IP: {{$ip}}</p>
<p>User Agent: {{$userAgent}} </p>
<p>Час входу: {{$date}} </p>

<small>Відправлено із сайту <a href="{{url('/')}}">TsukorNorm</a></small>
