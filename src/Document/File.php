<?php

namespace Cordoval\Document;

use Doctrine\ODM\PHPCR\Exception\RuntimeException;

class File extends AbstractFile
{
    protected $content;

    public function setFileContentFromFilesystem($filename)
    {
        if (!$filename) {
            throw new RuntimeException('The filename may not be empty');
        }
        if (!is_readable($filename)) {
            throw new RuntimeException(sprintf('File "%s" not found or not readable', $filename));
        }
        $this->getContent();
        $stream = fopen($filename, 'rb');
        if (! $stream) {
            throw new RuntimeException(sprintf('Failed to open file "%s"', $filename));
        }

        $this->content->setData($stream);
        $this->content->setLastModified(new \DateTime('@'.filemtime($filename)));

        $finfo = new \finfo();
        $this->content->setMimeType($finfo->file($filename,FILEINFO_MIME_TYPE));
        $this->content->setEncoding($finfo->file($filename,FILEINFO_MIME_ENCODING));

        return $this;
    }

    public function setContent(Resource $content)
    {
        $this->content = $content;

        return $this;
    }

    public function getContent()
    {
        if ($this->content === null) {
            $this->content = new Resource();
            $this->content->setLastModified(new \DateTime());
        }

        return $this->content;
    }

    public function setFileContent($content)
    {
        $this->getContent();

        if (!is_resource($content)) {
            $stream = fopen('php://memory', 'rwb+');
            fwrite($stream, $content);
            rewind($stream);
        } else {
            $stream = $content;
        }

        $this->content->setData($stream);

        return $this;
    }

    public function getFileContentAsStream()
    {
      return $this->getContent()->getData();
    }

    public function getFileContent()
    {
      $content = stream_get_contents($this->getContent()->getData());

      return $content !== false ? $content : '';
    }
}
