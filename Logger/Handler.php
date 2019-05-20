<?php

namespace LavoWeb\RotatingFileHandler\Logger;

use Exception;
use Magento\Framework\Filesystem\DirectoryList;
use Magento\Framework\Filesystem\Glob;
use Monolog\Handler\RotatingFileHandler;

/**
 * Class Handler
 *
 * @package LavoWeb\RotatingFileHandler\Logger
 */
class Handler extends RotatingFileHandler
{
    /** @var DirectoryList */
    private $directoryList;

    /**
     * Handler constructor.
     *
     * @param DirectoryList $directoryList
     * @param string $filename
     * @param int $maxFiles
     * @param int $level
     * @param bool $bubble
     * @param null $filePermission
     * @param bool $useLocking
     * @param string $filenameFormat
     * @param string $dateFormat
     */
    public function __construct(
        DirectoryList $directoryList,
        $filename,
        $maxFiles = 0,
        $level = \Monolog\Logger::DEBUG,
        $bubble = true,
        $filePermission = null,
        $useLocking = false,
        $filenameFormat = '{filename}-{date}',
        $dateFormat = 'Y-m-d'
    )
    {
        $this->directoryList = $directoryList;
        parent::__construct($filename, $maxFiles, $level, $bubble, $filePermission, $useLocking);
        $this->setFilenameFormat($filenameFormat, $dateFormat);
    }

    /**
     * Get Log Files
     *
     * @return array
     */
    public function getLogFiles()
    {
        return Glob::glob($this->getGlobPattern());
    }

    /**
     * Get Timed Filename
     *
     * @return string
     */
    protected function getTimedFilename()
    {
        if ('/' != substr($this->filename, 0, 1)) {
            $this->filename = sprintf("%s/%s", $this->getLogPath(), $this->filename);
        }
        return parent::getTimedFilename();
    }

    /**
     * Get Log Path
     *
     * @return string
     */
    protected function getLogPath()
    {
        try {
            $logPath = $this->directoryList->getPath('log');
        } catch (Exception $e) {
            $logPath = '/';
        }
        return $logPath;
    }
}
