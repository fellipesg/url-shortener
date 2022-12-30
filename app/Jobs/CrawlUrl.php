<?php

namespace App\Jobs;

use App\Models\UrlShortener;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CrawlUrl implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $urlShortener;

    /**
     * Create a new job instance.
     *
     * @param UrlShortener $urlShortener
     * @return void
     */
    public function __construct(UrlShortener $urlShortener)
    {
        $this->urlShortener = $urlShortener;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Make a GET request to the original URL using the Guzzle HTTP client
        $client = new Client();
        $response = $client->get($this->urlShortener->long_url);

        // Parse the title from the HTML
        $html = $response->getBody();
        $titleRegex = '/<title>(.*?)<\/title>/';
        preg_match($titleRegex, $html, $matches);
        $title = $matches[1];

        // Update the title column in the url_shortener table
        $this->urlShortener->update([
            'title' => $title
        ]);
    }
}
