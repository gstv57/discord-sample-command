<?php

namespace App\Services\Seek;

use App\Jobs\SaveNewOpportunity;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\{InteractsWithQueue, SerializesModels};

class CrawlingPage implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use SerializesModels;
    use Queueable;

    public string $url = "https://www.seek.com.au";
    public function __construct(public array $data)
    {
    }
    public function handle()
    {
        $url = $this->url . $this->data['url'];

        $html = file_get_contents($url);

        $dom = new \DOMDocument();

        @$dom->loadHTML($html);

        $xpath = new \DOMXPath($dom);
        # advertiser-name = data-automation="advertiser-name"
        $advertiser = $xpath->query('//span[@data-automation="advertiser-name"]')->item(0)->nodeValue ?? null;
        # job-location = data-automation="job-detail-location"
        $location = $xpath->query('//span[@data-automation="job-detail-location"]')->item(0)->nodeValue ?? null;
        # detail classifies the job description
        $detail = $xpath->query('//span[@data-automation="job-detail-classifications"]')->item(0)->nodeValue ?? null;
        # data-automation="job-detail-work-type"
        $work_type = $xpath->query('//span[@data-automation="job-detail-work-type"]')->item(0)->nodeValue ?? null;
        # salary = data-automation="job-detail-add-expected-salary"
        $salary = $xpath->query('//span[@data-automation="job-detail-add-expected-salary"]')->item(0)->nodeValue ?? $xpath->query('//span[@data-automation="job-detail-salary"]')->item(0)->nodeValue ?? null;
        #posted been //*[@id="app"]/div/div[3]/div/div/div[2]/div[2]/div[2]/div/div[1]/div[3]/span/text()
        $posted_at = $xpath->query('//*[@id="app"]/div/div[3]/div/div/div[2]/div[2]/div[2]/div/div[1]/div[3]/span')->item(0)->nodeValue ?? null;
        # jobs details = data-automation="jobAdDetails"
        $job_details = $xpath->query('//div[@data-automation="jobAdDetails"]')->item(0)->nodeValue ?? null;

        $new_jobs = [
            'job_id'      => $this->data['job_id'],
            'title'       => $this->data['title'],
            'url'         => $url,
            'advertiser'  => $advertiser ?? 'N/A',
            'location'    => $location ?? 'N/A',
            'detail'      => $detail ?? 'N/A',
            'work_type'   => $work_type ?? 'N/A',
            'salary'      => $salary ?? 'N/A',
            'posted_at'   => $posted_at ?? 'N/A',
            'job_details' => $job_details ?? 'N/A',
        ];

        dispatch(new SaveNewOpportunity($new_jobs));
    }
}
