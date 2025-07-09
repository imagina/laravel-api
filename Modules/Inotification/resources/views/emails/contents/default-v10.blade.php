@extends($data["layout"] ?? setting('notification::templateEmail'))

@section('content')

  @if(isset($data["content"]) && $data["content"])
    @include($data["content"])
  @else

    @if(!is_null($data['notification']) && !is_null($data['notification']->mediaFiles()) && !empty($data['notification']->mediaFiles()->mainimage->mediumThumb) && strpos($data['notification']->mediaFiles()->mainimage->mediumThumb, 'default.jpg') == false)
    <img src="{{$data['notification']->mediaFiles()->mainimage->mediumThumb}}" alt="{{$data['title'] ?? ''}}"
         style="margin-top:15px; margin-bottom: 20px; width: 100%; aspect-ratio: 21 / 9; object-fit: cover; border:none;text-decoration:none;color:#ffffff; text-align: center;">
    @else

      <hr style="margin:20px; border: 1px solid #E8ECED;">
      <img src="http://imgfz.com/i/4KPt72c.png" width="200" alt="imagen"
           style="margin-bottom:20px; width:200px;max-width:80%;height:auto;border:none;text-decoration:none;color:#ffffff; text-align: center;">
    @endif

    <div style="border-radius: 0 0 10px 10px;padding:0 20px 20px;background-color:#ffffff; text-align: center;">
      <h1 class="email-title">
        {!! $data["title"] !!}
      </h1>
      <div class="email-message">
        {!! $data["message"]!!}
      </div>
      @if(!empty($data["link"]))
        <div class="email-link">
        <a href='{{$data["link"]}}'
                 style="text-decoration: none;
                         background-color: {{Setting::get('isite::brandSecondary')}};
                         padding: 5px 10px;
                         margin: 15px 10px 0;
                         display: inline-block;
                         border-radius: 6px;
                         color: white;"
                 target="_blank">{{ $data["notification"]->options->linkLabel ?? $data["options"]['linkLabel'] ?? trans("isite::common.menu.viewMore") }}</a>
        </div>
      @endif
    </div>
  @endif

@stop