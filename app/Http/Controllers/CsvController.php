<?php

namespace App\Http\Controllers;

use App\Models\ShortenUrl;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CsvController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     * download report  as csv  format
     */
    public function csvDownload()
    {
        $headers = [
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Content-type' => 'text/csv',
            'Conatent-Disposition' => 'attachment; filename=shortenUrlsReport.csv',
            'Expires' => '0',
            'Pragma' => 'public'
        ];

        $list = ShortenUrl::join('users', 'users.id', '=', 'shorten_urls.user_id')->get()->toArray();
        foreach ($list as $ll) { //customize csv table
            $csvList[] = [
                'id' => $ll['id'],
                'web url' => $ll['original_url'],
                'short url' => $ll['short_url'],
                'qr code' => QrCode::size(100)->backgroundColor(255, 90, 0)->generate(url($ll['short_url'])),
                'creation date' => $ll['created_at'],
                'user' => $ll['name'],
                'email' => $ll['email'],
            ];
        }

        array_unshift($csvList, array_keys($csvList[0])); //add header row

        $callback = function () use ($csvList) {
            $FH = fopen('php://output', 'w');
            foreach ($csvList as $row) {
                fputcsv($FH, $row);
            }
            fclose($FH);
        };

        return response()->stream($callback, 200, $headers);
    }
}
