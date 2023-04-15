
<?php

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\HttpClient;

class UpdaloadFileTest extends TestCase
{
    public function testFileUpload()
    {
        $client = HttpClient::create();
        $url = 'http://127.0.0.1//core/upload'; // replace with your actual URL

        // $binary = "file content"; // replace with your actual binary file content
        $appname = "myPhpUnitTest"; // replace with your actual app name
        $uploadpath = "/phpunit_tests"; // replace with your actual upload path
        $filename = "myTest.txt"; // replace with your actual file name
        $complete = true; // replace with your actual value
        $zerofile = false; // replace with your actual value
        $date = null; // replace with your actual date value, or null if not used
        $overwrite = false; // replace with your actual value
        $offset = 0; // replace with your actual value

        $response = $client->request('POST', $url, [
            'body' => [
                // 'binary' => $binary,
                'app' => $appname,
                'uploadpath' => $uploadpath,
                'filename' => $filename,
                'complete' => $complete,
                'zerofile' => $zerofile,
                'date' => $date,
                'overwrite' => $overwrite,
                'offset' => $offset,
            ],
        ]);

        $statusCode = $response->getStatusCode();
        $this->assertEquals(200, $statusCode);

        $content = $response->getContent();
        // add your assertions on the response content here
    }

    public function testStressTest1000times(): void
    {
        // Call the test method multiple times with different input parameters to simulate a load on the web service
        for ($i = 0; $i < 1000; $i++) {
            $this->testFileUpload();
        }
    }
}