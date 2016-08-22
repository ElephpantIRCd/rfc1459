<?php
namespace ElephpantIRCd\RFC1459\Message;

class AbstractMessage
{
    private $prefix = null;
    private $command = null;
    private $params = [];
    private $crlf = "\r\n";

    /**
     * @param string $string Message to parse
     *
     * @return AbstractMessage
     */
    public static function parse($string)
    {
        $message = new AbstractMessage();
        $place = 0;
        if (substr($string, 0, 1) == ':') {
            $place = strpos($string, ' ');
            $prefix = substr($string, 1, $place);
            $message->setPrefix($prefix);
            ++$place;
        }
        $remainder = substr($string, $place);
        $pieces = explode(' ', $remainder);

        $command = array_shift($pieces);
        $params = $pieces;

        $message->setCommand($command)
            ->setParams($params);

        return $message;
    }

    public function getPrefix()
    {
        return $this->prefix;
    }

    public function getCommand()
    {
        return $this->command;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
        return $this;
    }

    public function setCommand($command)
    {
        $this->command = $command;
        return $this;
    }

    public function setParams(array $params)
    {
        $this->params = $params;
        return $this;
    }

    public function __toString()
    {
        $message = '';
        $prefix = $this->getPrefix();
        if (!is_null($prefix)) {
            $message .= ":{$prefix} ";
        }
        $message .= $this->getCommand();
        $params = $this->getParams();
        if (!empty($params)) {
            $message .= ' '.implode(' ', $params);
        }
        $message .= $this->crlf;

        return $message;
    }
}
