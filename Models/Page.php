<?php

abstract class Page
{
    public const NEXT = "n";
    public const PREV = "p";
    public const QUIT = "q";

    protected $title;
    protected $num;
    protected $data;
    protected $is_loop;
    protected $keys;
    protected $msg;

    public function __construct() 
    {
        $this->num = 1;
        $this->is_loop = true;
    }

    abstract public function getData() : array; 

    public function setMsg(string $msg) : void
    {
        $this->msg = $msg;
    }

    public function setData() : void
    {
        $this->data = $this->getData();
        $this->keys = [];
        foreach(array_keys($this->data) as $key) {
            $this->keys[] = (string)$key;
        };
    }

    public function show()
    {
        for ($i = 0; $i < 10; $i++) {
            $j = ($this->num - 1) * 10 + $i;
            if($j < count($this->keys)) {
                $key = $this->keys[$j];
                echo $key . ": " . $this->data[$key] . "\n";
            } else {
                break;
            }
        }
    }

    public function getRequest() : string
    {

        // データ取得
        $this->setData();

        $input = "";

        // データキーが入力されるまで繰り返す
        while($this->is_loop){

            // 都道府県を10件ずつ表示する
            $this->show();

            // 入力を受け取る
            $input = $this->getInput($this->msg);

            // ページ番号を操作する
            $this->numUpdate($input);
            $this->isLoopUpdate($input);
        }
        
        $this->isloop = true;
        return $input;
    }

    public function getInput(string $msg) : string
    {
        echo "[prev:p][next:n][quit:q]\n";
        echo $msg;
        return trim(fgets(STDIN));
    }

    public function hasKey(string $input) : bool
    {   
        // キー配列に存在すればtrueを返す
        if (in_array($input, $this->keys, true)) {
            return true;
        } else {
            return false;
        }
    }

    public function numUpdate(string $input) : void
    {
        switch ($input) {
            
            case self::NEXT:
                if ($this->num < ceil(count($this->data)/10)) {
                    $this->num++;
                } else {
                    echo "Next page does not exist.\n";
                }
                break;
            
            case self::PREV:
                if ($this->num > 1) {
                    $this->num--;
                } else {
                    echo "Previous page does not exist.\n";
                }
                break;
        }
    }

    public function isLoopUpdate(string $input) : void
    {
        if ($input === self::QUIT) {
            $this->is_loop = false;
        } elseif ($this->hasKey($input)) {
            $this->is_loop = false;
        }
    }

    public function getIsloop(){
        return $this->is_loop;
    }
}