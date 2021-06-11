<?php
$berita = Session::get('berita');
$pengumuman = Session::get('pengumuman');
$lomba = Session::get('lomba');
?>
<div class="modal-body bg-white" id="display-search">
@foreach($berita as $brt)
<a href="{{url('berita')}}/{{$brt->id}}"><h4>{{ $brt->judul }}</h4></a>
<hr>
@endforeach
@foreach($pengumuman as $brt)
<a href="{{url('pengumuman')}}/{{$brt->id}}"><h4>{{ $brt->judul }}</h4></a>
<hr>
@endforeach
@foreach($lomba as $brt)
<h4>{{ $brt->nama_lomba }}</h4>
<hr>
@endforeach

</div>
