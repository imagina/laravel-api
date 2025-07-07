<footer class="p-3 text-center">
  <div class="footer p-3 text-center" style="background-color:{{Setting::get('site::color-secondary')}};
    color: white;">
    
    <div class="social" style="margin-bottom: 20px;">
      @if(Setting::has('isite::SocialNetworks'))
        @php
          $socials = json_decode(Setting::get('isite::SocialNetworks'));
        @endphp
        
        @if(count($socials))
          @foreach($socials as $index => $item)
            <a href="{{ $item->value }}" style="word-break: break-all;
        text-decoration: none;">
                                <span class="fa-stack fa-sm" aria-hidden="true">
                                  <i class="fa fa-circle-thin fa-stack-2x" style="color: #555;"></i>
                                  <i class="fa fa-{{$item->label->value}} fa-stack-1x" style="color: #555;"></i>
                                </span>
            </a>
          @endforeach
        @endif
      @endif
    </div>
    
    <span class="copyright" style="color: #555;
        font-size: 14px;">
                Copyrights © {{date('Y')}} All Rights Reserved by {{ setting('core::site-name') }}.
            </span>
  </div>
</footer>