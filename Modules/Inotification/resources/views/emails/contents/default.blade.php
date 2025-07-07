@extends($data["layout"] ?? setting('inotification::templateEmail'))

@section('content')

  @if(isset($data["content"]) && $data["content"])
    @include($data["content"])
  @else
    <div style="padding:32px 24px;background:#fff;border-radius:8px;box-shadow:0 2px 8px #eee;margin:24px auto;max-width:600px;">
      <h1 style="font-size:24px;color:#222;margin-bottom:16px;font-family:Arial,sans-serif;">
        {!! $data["title"] !!}
      </h1>
      <div style="font-size:16px;color:#444;line-height:1.6;font-family:Arial,sans-serif;">
        {!! $data["message"]!!}
      </div>
    </div>
  @endif

@stop
