<h4>Останні показники цукру крові</h4>

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
            :maxnt="{{(float)$sugarTargetRange->max_nt_glu}}"
            :min="{{(float)$sugarTargetRange->min_glu}}"
            time="{{$sugar->dateCreate('H:i')}}"
            date="{{$sugar->dateCreate('d.m.Y')}}"
            note="{{$sugar->comment}}"
            delete-url="{{route('sugar.delete',['mySugar'=>$sugar])}}"
            edit-url="{{route('sugar.edit',['mySugar'=>$sugar])}}"
        >
        </glu-item>
    @endforeach
</div>
<!-- /.my-1 -->

<div class="d-flex my-2 justify-content-center align-items-center p-1">
    {{$sugars->links()}}
</div><!-- /.d-flex my-2 justify-content-center align-items-center p-1 -->
