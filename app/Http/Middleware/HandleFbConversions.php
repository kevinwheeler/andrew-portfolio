<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class HandleFbConversions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $fbclid = $request->query('fbclid');
        if ($fbclid) {
            $version = 'fb';
            $subdomainIndex = '1'; // Use 1 when generating on the server
            $creationTime = floor(microtime(true) * 1000); // UNIX timestamp in milliseconds
            $fbc = "$version.$subdomainIndex.$creationTime.$fbclid";

            // ####### POST TO FACEBOOK CONVERSION API ######
            // Get the access token from config
            $fbAcccessToken = config('custom.facebook_access_token');
            $pixelId = config('custom.facebook_pixel_id');

            $data = array(
                "data" => array(
                    array(
                        "event_name" => "ViewContent",
                        "event_time" => Carbon::now()->timestamp,
                        "action_source" => "website",
                        "event_source_url"  => $request->fullUrl(),
                        "user_data" => array(
                          "fbc" =>$fbc,
                          "client_ip_address" => $request->ip(),
                          "client_user_agent" => $request->header('User-Agent'),
                          ),
                        ),
                    ),
                   "access_token" => $fbAcccessToken
            );

            $postURL = 'https://graph.facebook.com/v17.0/' . $pixelId . '/events';

            #Honestly it's been months since I was working on this code before deciding it wasn't worth it. I'm not sure which of the two lines below we should use, and
            # I'm not going to take the time to investigate. As far as I can tell, I was sending the correct information to Facebook's severs, and yet it wasn't working.
            # Facebook never showed me any conversion events in the log, despite sending me back an HTTP 200 - OK status. I'm assuming Facebook's api is just broken
            # My experience with Facebook is that a lot of their stuff is often broken. I would probably have to use their SDK to get it working or know what 
            # undocumented thing I'm supposed to be doing differently.
            #Log::channel('kevinslog')->info('Sending Conversions event to Facebook. POST BODY = ' . json_encode($data) . '****postUrl = ' . $postURL);
            #Log::channel('kevinslog')->info('Sending Conversions event to Facebook. POST BODY = ' . json_encode($data, JSON_UNESCAPED_SLASHES) . '****postUrl = ' . $postURL);

             
            // http request code from https://stackoverflow.com/a/29601842/3470632
            $httpClient = new Client();
            try {
                $response = $httpClient->post($postURL, [
                    RequestOptions::JSON => $data
                ]);
                Log::channel('kevinslog')->info('Result of sending Facebook conversion event: ' . $response->getStatusCode() . ' ' . '****REASON PHRASE =' . $response->getReasonPhrase() . ' ' . '****BODY = ' . (string) $response->getBody() . ' ' . '****HEADERS = ' . json_encode($response->getHeaders()));
            }
            // from https://stackoverflow.com/a/56823146/3470632
            catch (\GuzzleHttp\Exception\RequestException $e) {
                if ($e->hasResponse()) {
                    $response = $e->getResponse();
                    // Log everything to error log including headers
                    Log::error('Error sending Facebook conversion event: ' . $response->getStatusCode() . ' ' . $response->getReasonPhrase() . ' ' . (string) $response->getBody() . ' ' . json_encode($response->getHeaders()));
                }
            }
        }
        return $next($request);
    }
}
