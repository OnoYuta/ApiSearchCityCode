<?php

class Muni extends Page
{
    private const URL = "https://www.land.mlit.go.jp/webland/api/CitySearch?area=";
    private $area;

    public function setArea(string $area) : void
    {
        $this->area = $area;
    }

    public function getData() : array
    {
        $url = self::URL . $this->area;
        $contents = file_get_contents($url);
        $json = mb_convert_encoding($contents, 'UTF-8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
        $json = json_decode($json, true);

        $data = [];
        foreach ($json["data"] as $i) {
            $data[$i["id"]] = $i["name"];
        }
        return $data;
    }
}