<?php

class Pref extends Page
{
    private const PATH = "Data/pref.csv";
    private $file;

    public function getData() : array
    {
        $this->file = new SplFileObject(self::PATH, 'r');
        $this->file->setFlags(SplFileObject::READ_CSV);

        $data = [];

        foreach ($this->file as $line) {

            if ($this->file->key() === 0) {
                continue;
            }

            list($code, $name, $eng) = $line;
            $data[$code] = $name;
        }

        return $data;
    }

}