<?php


class City
{
    private $img_id;
    private $img_filename;
    private $img_title;
    private $img_width;
    private $img_height;
    private $lan_id;

    public function getImgId()
    {
        return $this->img_id;
    }

    public function setImgId($img_id): void
    {
        $this->img_id = $img_id;
    }

    public function getImgFilename()
    {
        return $this->img_filename;
    }

    public function setImgFilename($img_filename): void
    {
        $this->img_filename = $img_filename;
    }

    public function getImgTitle()
    {
        return $this->img_title;
    }

    public function setImgTitle($img_title): void
    {
        $this->img_title = $img_title;
    }

    public function getImgWidth()
    {
        return $this->img_width;
    }

    public function setImgWidth($img_width): void
    {
        $this->img_width = $img_width;
    }

    public function getImgHeight()
    {
        return $this->img_height;
    }

    public function setImgHeight($img_height): void
    {
        $this->img_height = $img_height;
    }

    public function getLanId()
    {
        return $this->lan_id;
    }

    public function setLanId($lan_id): void
    {
        $this->lan_id = $lan_id;
    }

    public function toArray(): array
    {
        return [
            "id" => $this->getId(),
            "filename" => $this->getFilename(),
            "title" => $this->getTitle(),
            "width" => $this->getWidth(),
            "height" => $this->getHeight(),
            "published" => $this->getPublished(),
            "lan_id" => $this->getLanId(),
            "date" => $this->getDate()
        ];
    }

    public function toArray2(): array
    {
        $retarr = [];

        foreach( $this as $key => $value )
        {
            $retarr[$key] = $value;
        }
        return $retarr;
    }

}