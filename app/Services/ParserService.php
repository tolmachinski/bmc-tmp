<?php

namespace App\Services;

use App\DailyRate;
use App\Rate;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Symfony\Component\DomCrawler\Crawler;

class ParserService
{
    public function parseTheFinancialsCom($command)
    {
        $data = array();
//        $crawler = new Crawler();
//        $crawler->addHtmlContent(file_get_contents('http://www.thefinancials.com/Default.aspx?SubSectionID=mortsumm'));
//        $url = $crawler->filter('#textContentBox iframe')->first()->attr('src');
//        if (!$url) {
//            new \Exception("Requested page is not found");
//        }
//
//        var_dump($url);
//        die();
//
//        $url = htmlentities($url);
//        if ( Str::startsWith($url, 'http://www.thefinancials.com')) {
//            $url = 'http://www.thefinancials.com' . $url;
//        }

        $url = 'https://www.thefinancials.com/Widgets/ShowWidget.aspx?id=0273105675&width=530&height=280';

        // Get Pages
        $crawler = new Crawler();
        $crawler->addHtmlContent(file_get_contents($url));

        $moneyRatesPageCrawler = new Crawler();
        $moneyRatesPageCrawler->addHtmlContent(file_get_contents($crawler->filter('#Main_WidgetTabContainer_Tab0 iframe')->attr('src')));

        $treasuresPageCrawler = new Crawler();
        $treasuresPageCrawler->addHtmlContent(file_get_contents($crawler->filter('#Main_WidgetTabContainer_Tab2 iframe')->attr('src')));


        $swapsPageCrawler = new Crawler();
        $swapsPageCrawler->addHtmlContent(file_get_contents($crawler->filter('#Main_WidgetTabContainer_Tab3 iframe')->attr('src')));


        // Money rates
        $oTr = $moneyRatesPageCrawler->filter('#TableRows .TableRow')->eq(1);
        $data['six_month_libor'] = array(
            'last'      => (float) str_replace('%', '', $oTr->filter('.widgetTableCell')->eq(1)->text()),
            'change'    => (float) str_replace('%', '', $oTr->filter('.widgetTableCell')->eq(2)->text()),
        );



        $oTr = $moneyRatesPageCrawler->filter('#TableRows .TableRow')->eq(3);
        $data['prime_rate'] = array(
            'last'      => (float) str_replace('%', '', $oTr->filter('.widgetTableCell')->eq(1)->text()),
            'change'    => (float) str_replace('%', '', $oTr->filter('.widgetTableCell')->eq(2)->text()),
        );


        // Treasure
        $oTr = $treasuresPageCrawler->filter('#TableRows .TableRow')->eq(5);
        $data['five_yr_tr'] = array(
            'last'      => (float) str_replace('%', '', $oTr->filter('.widgetTableCell')->eq(1)->text()),
            'change'    => (float) str_replace('%', '', $oTr->filter('.widgetTableCell')->eq(2)->text()),
        );


        $oTr = $treasuresPageCrawler->filter('#TableRows .TableRow')->eq(7);
        $data['ten_yr_tr'] = array(
            'last'      => (float) str_replace('%', '', $oTr->filter('.widgetTableCell')->eq(1)->text()),
            'change'    => (float) str_replace('%', '', $oTr->filter('.widgetTableCell')->eq(2)->text()),
        );

        // Swap
        $oTr = $swapsPageCrawler->filter('#TableRows .TableRow')->eq(3);
        $data['five_year_swap'] = array(
            'last'      => (float) str_replace('%', '', $oTr->filter('.widgetTableCell')->eq(1)->text()),
            'change'    => (float) str_replace('%', '', $oTr->filter('.widgetTableCell')->eq(2)->text()),
        );

        $oTr = $swapsPageCrawler->filter('#TableRows .TableRow')->eq(5);
        $data['ten_year_swap'] = array(
            'last'      => (float) str_replace('%', '', $oTr->filter('.widgetTableCell')->eq(1)->text()),
            'change'    => (float) str_replace('%', '', $oTr->filter('.widgetTableCell')->eq(2)->text()),
        );

        // In case the financials has changed their format
        $errors = false;
        foreach ($data as $type => $item) {
            if (!is_float($item['last']) || !is_float($item['change'])) {
                $errors = true;

                continue;
            }

            $dailyRate = new DailyRate();
            $dailyRate->rate_id = Rate::where('type', $type)->first()->id;
            $dailyRate->date = new \DateTime();
            $dailyRate->last = $item['last'];
            $dailyRate->change = $item['change'];
            try {
                $dailyRate->save();
            } catch (\Exception $e) {
                if(strpos($e->getMessage(), 'Integrity constraint violation') !== false) {
                    $storedRate = DailyRate::where('rate_id', $dailyRate->rate_id)->where('date', $dailyRate->date->format('Y-m-d'))->first();
                    $storedRate->last = $item['last'];
                    $storedRate->change = $item['change'];
                    $storedRate->save();

                    continue;
                }
                
                Mail::raw("Black Mountain Capital: failed to save parsed data due to error: {$e->getMessage()}", function($message) {
                    $message->from('errors@bmc.com');
                    $message->to('uri@estrintech.com');
                    $message->subject('BMC daily rate save error');
                });
            }
        }

        if ($errors) {
            Mail::raw('Black Mountain Capital: TheFinancials.com parser returned non-float values!', function($message) {
                $message->from('errors@bmc.com');
                $message->to('uri@estrintech.com');
                $message->subject('BMC parse error');
            });
        }

        return true;
    }

    // public function parseTheFinancialsCom($command)
    // {
    //     $url = 'http://www.thefinancials.com/Default.aspx?SubSectionID=mortsumm';
    //     $client = new Client(['timeout' => 60]);
        
    //     try {
    //         $response = $client->get($url);
    //     } catch (ConnectException $exception) {
    //         $this->writeDummyData();

    //         throw new \Exception("Failed to get content of the TheFinancials website due to connection error", 1, $exception);
    //     }

    //     $crawler = new Crawler();
    //     $crawler->addHtmlContent($response->getBody()->getContents());
    //     $url = $crawler->filter('#textContentBox script')->first()->attr('src');
    //     if (!$url) {
    //         $this->writeDummyData();

    //         new \Exception('Requested page URL is not found');
    //     }

    //     $url = htmlentities($url);
    //     if (Str::startsWith($url, 'http://www.thefinancials.com')) {
    //         $url = 'http://www.thefinancials.com' . $url;
    //     }

    //     try {
    //         $response = $client->get($url);
    //     } catch (ConnectException $exception) {
    //         $this->writeDummyData();

    //         throw new \RuntimeException("Failed to get content of the TheFinancials website widget due to connection error", 1, $exception);
    //     }

    //     // Get Pages
    //     $data = [];
    //     $crawler = new Crawler();
    //     $crawler->addHtmlContent($response->getBody()->getContents());
    //     $moneyRatesPage = $crawler->filter('#Main_WidgetTabContainer_Tab0')->first();
    //     $treasuresPage = $crawler->filter('#Main_WidgetTabContainer_Tab2')->first();
    //     $swapsPage = $crawler->filter('#Main_WidgetTabContainer_Tab3')->first();

    //     // Money rates
    //     $oTr = $moneyRatesPage->filter('#WidgetTable_Inner tr')->eq(1);
    //     $data['six_month_libor'] = [
    //         'last'      => (float) str_replace('%', '', $oTr->filter('td')->eq(2)->filter('font')->text()),
    //         'change'    => (float) str_replace('%', '', $oTr->filter('td')->eq(3)->filter('font')->text()),
    //     ];
    //     $oTr = $moneyRatesPage->filter('#WidgetTable_Inner tr')->eq(3);
    //     $data['prime_rate'] = [
    //         'last'      => (float) str_replace('%', '', $oTr->filter('td')->eq(2)->filter('font')->text()),
    //         'change'    => (float) str_replace('%', '', $oTr->filter('td')->eq(3)->filter('font')->text()),
    //     ];

    //     // Treasure
    //     $oTr = $treasuresPage->filter('#WidgetTable_Inner tr')->eq(6);
    //     $data['five_yr_tr'] = [
    //         'last'      => (float) str_replace('%', '', $oTr->filter('td')->eq(2)->filter('font')->text()),
    //         'change'    => (float) str_replace('%', '', $oTr->filter('td')->eq(3)->filter('font')->text()),
    //     ];
    //     $oTr = $treasuresPage->filter('#WidgetTable_Inner tr')->eq(8);
    //     $data['ten_yr_tr'] = [
    //         'last'      => (float) str_replace('%', '', $oTr->filter('td')->eq(2)->filter('font')->text()),
    //         'change'    => (float) str_replace('%', '', $oTr->filter('td')->eq(3)->filter('font')->text()),
    //     ];

    //     // Swap
    //     $oTr = $swapsPage->filter('#WidgetTable_Inner tr')->eq(4);
    //     $data['five_year_swap'] = [
    //         'last'      => (float) str_replace('%', '', $oTr->filter('td')->eq(2)->filter('font')->text()),
    //         'change'    => (float) str_replace('%', '', $oTr->filter('td')->eq(3)->filter('font')->text()),
    //     ];
    //     $oTr = $swapsPage->filter('#WidgetTable_Inner tr')->eq(6);
    //     $data['ten_year_swap'] = [
    //         'last'      => (float) str_replace('%', '', $oTr->filter('td')->eq(2)->filter('font')->text()),
    //         'change'    => (float) str_replace('%', '', $oTr->filter('td')->eq(3)->filter('font')->text()),
    //     ];

    //     // In case the financials has changed their format
    //     $errors = false;
    //     foreach ($data as $type => $item) {
    //         if (!is_float($item['last']) || !is_float($item['change'])) {
    //             $errors = true;

    //             continue;
    //         }

    //         $dailyRate = new DailyRate();
    //         $dailyRate->rate_id = Rate::where('type', $type)->first()->id;
    //         $dailyRate->date = new \DateTime();
    //         $dailyRate->last = $item['last'];
    //         $dailyRate->change = $item['change'];

    //         try {
    //             $dailyRate->save();
    //         } catch (\Exception $e) {
    //             if (false !== strpos($e->getMessage(), 'Integrity constraint violation')) {
    //                 $storedRate = DailyRate::where('rate_id', $dailyRate->rate_id)->where('date', $dailyRate->date->format('Y-m-d'))->first();
    //                 $storedRate->last = $item['last'];
    //                 $storedRate->change = $item['change'];
    //                 $storedRate->save();

    //                 continue;
    //             }

    //             Mail::raw("Black Mountain Capital: failed to save parsed data due to error: {$e->getMessage()}", function ($message) {
    //                 $message->from('errors@bmc.com');
    //                 $message->to('uri@estrintech.com');
    //                 $message->subject('BMC daily rate save error');
    //             });
    //         }
    //     }

    //     if ($errors) {
    //         Mail::raw('Black Mountain Capital: TheFinancials.com parser returned non-float values!', function ($message) {
    //             $message->from('errors@bmc.com');
    //             $message->to('uri@estrintech.com');
    //             $message->subject('BMC parse error');
    //         });
    //     }

    //     return true;
    // }

    private function writeDummyData()
    {
        $data = [
            'six_month_libor' => ['last' => (float) 0, 'change' => (float) 0],
            'prime_rate'      => ['last' => (float) 0, 'change' => (float) 0],
            'five_yr_tr'      => ['last' => (float) 0, 'change' => (float) 0],
            'ten_yr_tr'       => ['last' => (float) 0, 'change' => (float) 0],
            'five_year_swap'  => ['last' => (float) 0, 'change' => (float) 0],
            'ten_year_swap'   => ['last' => (float) 0, 'change' => (float) 0],
        ];
    
        foreach ($data as $type => $item) {
            $dailyRate = new DailyRate();
            $dailyRate->rate_id = Rate::where('type', $type)->first()->id;
            $dailyRate->date = new \DateTime();
            $dailyRate->last = $item['last'];
            $dailyRate->change = $item['change'];

            try {
                $dailyRate->save();
            } catch (\Exception $e) {
                if (false !== strpos($e->getMessage(), 'Integrity constraint violation')) {
                    $storedRate = DailyRate::where('rate_id', $dailyRate->rate_id)->where('date', $dailyRate->date->format('Y-m-d'))->first();
                    $storedRate->last = $item['last'];
                    $storedRate->change = $item['change'];
                    $storedRate->save();

                    continue;
                }
            }
        }
    }
}
