<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<meta name="theme-color" content="#000000">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">

<title>{{$title}}</title>
<meta name="description" content="{{$description}}">
<meta property="og:type" content="website" />
<meta property="og:image" content="/storage/og-image.jpg" />

<link rel="icon" type="image/svg+xml" href="/storage/favicon.svg">
<link rel="icon" type="image/png" href="/storage/favicon.png">



<!-- Meta Pixel Code -->
{{-- <script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '589240076689126');
  fbq('track', 'PageView');
</script> --}}
{{-- <noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=589240076689126&ev=PageView&noscript=1"
/></noscript> --}}
<!-- End Meta Pixel Code -->

@vite(['resources/js/app.js', 'resources/sass/app.scss'])

@if($devEnvironment)
    <script src="https://cdn.tailwindcss.com"></script>
@endif