<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Noki\XmlConverter\Convert;

class FetchFeedContentsService
{
    public function __construct()
    {
    }

    public function fetch()
    {
        $client = new Client();
        $resp = $client->request('GET',
,
//            ,
            [
            'headers' => [
                'Accept' => 'application/xml',
                'User-Agent' => 'Mozilla/5.0'
            ],
            'allow_redirects' => true,
        ]);
        $xmlString = $resp->getBody()->getContents();
        $xml = simplexml_load_string($xmlString, "SimpleXMLElement", LIBXML_NOCDATA);

        // later use rss reader pakage: RssReader or FeedReader

        return $this->parse($xml);
    }

    public function parse($xml)
    {
        $data = [];

        // Detect type
        if (isset($xml->channel)) {
            return $this->parseRss2($xml);
        } elseif (isset($xml->item)) {
            return $this->parseRss1($xml);
        } elseif (isset($xml->entry)) {
            return $this->parseAtom($xml);
        } else {
            return [];
        }
    }

    private function parseRss2($xml)
    {
        $items = [];

        foreach ($xml->channel->item as $item) {
            $items[] = [
                'title' => (string) $item->title,
                'link' => (string) $item->link,
                'description' => (string) $item->description,
            ];
        }

        return $items;
    }

    private function parseRss1($xml)
    {
        $items = [];

        foreach ($xml->item as $item) {
            $items[] = [
                'title' => (string) $item->title,
                'link' => (string) $item->link,
                'description' => (string) $item->description,
            ];
        }

        return $items;
    }

    private function parseAtom($xml)
    {
        $items = [];

        foreach ($xml->entry as $item) {
            $items[] = [
                'title' => (string) $item->title,
                'link' => isset($item->link['href']) ? (string) $item->link['href'] : '',
                'description' => (string) ($item->summary ?: $item->content),
            ];
        }

        return $items;
    }
}
