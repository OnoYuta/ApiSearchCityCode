<?php

class Cont
{
    private $pref;
    private $muni;

    public function __construct()
    {
    }

    public function setMuni() : void
    {
        $muni = new Muni();
        $muni->setMsg("If you reselect a prefecture, enter 'q'.\n");
        $this->muni = $muni;
    }

    public function setPref() : void
    {
        $pref = new Pref();
        $pref->setMsg("Please enter a prefecture code.\n");
        $this->pref = $pref;
    }

    public function start() : void
    {
        $request = "";
        while ($request !== Page::QUIT) {

            $this->setPref();
            $this->setMuni();

            // 都道府県コードを入力させる
            $request = $this->pref->getRequest();
            var_dump($request);
            
            if ($request !== Page::QUIT) {
                // 市町村一覧を取得する
                $this->muni->setArea($request);
                $this->muni->getRequest();
                $request = "";
            } else {
                exit;
            }
        }
    
    }

}