<?php

namespace App\Http\Controllers;

use App\Jobs\CrawlUrl;
use App\Models\UrlShortener;
use Illuminate\Http\Request;

class UrlShortenerController extends Controller
{
    public function shorten(Request $request)
    {
        // Generate a unique string for the shortened URL
        $shortUrl = uniqid();

        /** @var UrlShortener $urlShortener */
        // Create a new UrlShortener model with the original and shortened URLs
        $urlShortener = new UrlShortener([
            'short_url' => $shortUrl,
        ]);
        $urlShortener->long_url = $request->input('url');
        // Save the model to the database
        $urlShortener->save();

        // Dispatch the CrawlUrl job with the model as an argument
        dispatch(new CrawlUrl($urlShortener));

        // Generate the full URL using the url() helper function
        $fullUrl = url("/$shortUrl");

        // Return the shortened URL as part of the response
        return response()->json([
            'short_url' => $fullUrl
        ]);
    }

    public function redirect($shortUrl)
    {
        // Find the UrlShortener model with the matching shortened URL
        $urlShortener = UrlShortener::where('short_url', $shortUrl)->first();

        // Increment the visits column
        $urlShortener->increment('visits');

        // Redirect the user to the original URL
        return redirect($urlShortener->long_url);
    }

    public function top()
    {
        // Query the database and sort the results by the visits column in descending order
        $urlShorteners = UrlShortener::orderBy('visits', 'desc')->take(100)->get();

        // Return the top 100 results as part of the response
        return response()->json([
            'urls' => $urlShorteners
        ]);
    }
}
