@foreach ($faq as $data)
<div class="panel single-accordion">
    <h6>
    <a role="button" class="collapsed" aria-expanded="true" aria-controls="collapseOne" data-toggle="collapse" data-parent="#accordion" href="#{{$data->id}}">{{ $data->pertanyaan}}
        <span class="accor-open"><i class="fa fa-plus" aria-hidden="true"></i></span>
        <span class="accor-close"><i class="fa fa-minus" aria-hidden="true"></i></span>
    </a>
    </h6>
    <div id="{{$data->id}}" class="accordion-content collapse">
        <p>{!! $data->jawaban !!}</p>
    </div>
</div>
@endforeach