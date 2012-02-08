<?php

class Logmail_Message_Template {
    public function __construct() {
    }

    public function out($message) {
        $message = new Zend_Mail_Message(array('raw' => $message));
        $content = $message->getContent();
        $headers = $message->getHeaders();
        $charset = 'UTF-8';

        foreach ($headers as $key => $value) {
            echo ucfirst($key), ": ", htmlentities($value), "<br />";
        }

        echo $header, "<br />";

        if (strpos($headers['content-transfer-encoding'], 'quoted-printable') !== false) {
            $content = quoted_printable_decode($content);
        }

        if (preg_match('/charset=([^ ]+)/', $headers['content-type'], $matches)) {
            $charset = strtoupper($matches[1]);
        }

        echo htmlentities($content, ENT_COMPAT, $charset);
    }
}