<div class="my-1 p-2">
    <a href="{{ route('pdfExport') }}" class="btn-tn">
        <i class="bi bi-arrow-90deg-right"></i> Експортувати в <i class="bi bi-filetype-pdf"></i>
    </a> <!-- /.btn btn-info -->
    <svg width="34" fill="#000000" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 496 496" xml:space="preserve">
        <g>
            <g>
                <g>
                    <path
                        d="M464,88c-5.856,0-11.272,1.696-16,4.448V80c0-17.648-14.352-32-32-32c-6.632,0-12.8,2.032-17.912,5.496
				C393.712,41.024,381.952,32,368,32c-13.952,0-25.72,9.024-30.088,21.496C332.8,50.032,326.632,48,320,48
				c-14.872,0-27.288,10.24-30.864,24H236.84c-3.824-14.776-11.048-28.16-20.84-39.288V32h-0.648C197.768,12.416,172.336,0,144,0H40
				C17.944,0,0,17.944,0,40v112c0,22.056,17.944,40,40,40h104c28.336,0,53.768-12.416,71.352-32H216v-0.712
				c9.792-11.128,17.016-24.512,20.84-39.288H288v148.688l-8-8V220c0-19.848-16.152-36-36-36c-19.848,0-36,16.152-36,36v78.04
				l41.768,76.568c5.504,10.096,13.84,18.144,24.12,23.28L288,404.944V496h16V395.056l-22.96-11.48
				c-7.336-3.672-13.296-9.416-17.224-16.624L224,293.96V220c0-11.032,8.968-20,20-20c11.032,0,20,8.968,20,20v47.312L284.688,288
				H304V120h16V72h-13.776c2.776-4.76,7.88-8,13.776-8c8.816,0,16,7.184,16,16v136h16V80V64c0-8.816,7.176-16,16-16
				c8.816,0,16,7.184,16,16v16v8v128h16V88v-8c0-8.816,7.176-16,16-16c8.816,0,16,7.184,16,16v40v8v88h16v-88v-8
				c0-8.816,7.176-16,16-16c8.816,0,16,7.184,16,16v240c0,15.248-8.472,28.96-22.112,35.776L448,400.72V496h16v-85.392l1.048-0.52
				C484.144,400.544,496,381.352,496,360V120C496,102.352,481.648,88,464,88z M144,176H40c-13.232,0-24-10.768-24-24V40
				c0-13.232,10.768-24,24-24h104c17.928,0,34.44,6,47.792,16H184c-13.232,0-24,10.768-24,24v80c0,13.232,10.768,24,24,24h7.792
				C178.44,170,161.928,176,144,176z M207.848,144H184c-4.416,0-8-3.584-8-8V56c0-4.416,3.584-8,8-8h23.848
				C217.936,61.392,224,77.984,224,96S217.936,130.608,207.848,144z M304,104h-64.408c0.224-2.648,0.408-5.304,0.408-8
				s-0.184-5.352-0.408-8H304V104z" />
                    <path
                        d="M333.656,266.344l-11.312,11.312l19.88,19.88C358.84,314.168,368,336.256,368,359.768V392h16v-32.232
				c0-27.784-10.824-53.896-30.464-73.536L333.656,266.344z" />
                    <path d="M32,160h112V32H32V160z M48,48h80v96H48V48z" />
                    <rect x="64" y="112" width="16" height="16" />
                    <rect x="96" y="112" width="16" height="16" />
                </g>
            </g>
        </g>
    </svg>

</div>
<!-- /.my-1 -->
<h3>Вимірювання цукру по дням</h3>
<div class="my-1">
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
