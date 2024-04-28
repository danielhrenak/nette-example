<?php

namespace App\Infrastructure\Repository;

class XmlRepository
{
    public string $xmlFile;
    public function __construct(string $xmlFile = NULL)
    {
        $this->xmlFile = $xmlFile;
    }

    private function loadXmlFile(string $xmlFile): \SimpleXMLElement
    {
        if (!file_exists($xmlFile)) {
            $this->createNewFile();

            $xml = new \SimpleXMLElement('<root/>');
            $xml->asXML($xmlFile);

            return $xml;
        }

        $xml = simplexml_load_file($xmlFile);
        if($xml === FALSE) {
            throw new \InvalidArgumentException('Invalid XML');
        }

        return $xml;
    }

    public static function createRepository(string $xmlFile = NULL): self
    {
        if($xmlFile == NULL) {
            $xmlFile = dirname(dirname(dirname(__DIR__))) . '/data/data.xml';
        }

        return new self($xmlFile);
    }

    private function createNewFile():void
    {
        $dir = dirname(dirname(dirname(__DIR__))) . '/data/';
        $file = $dir . '/data.xml';

        // Check if the directory exists
        if (!is_dir($dir)) {
            // Directory does not exist, so lets create it.
            mkdir($dir, 0755, true);
        }

        // Create or overwrite the file
        file_put_contents($file, 'Content of your file');
    }

    public function getXml()
    {
        return $this->loadXmlFile($this->xmlFile);
    }

    public function getXmlFile()
    {
        return $this->xmlFile;
    }
}