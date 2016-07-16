<?php
/**
 * Created by PhpStorm.
 * User: tacsiazuma
 * Date: 2016.07.03.
 * Time: 15:29
 */

namespace Letscodehu\Larablog\Models;


class PostProcessor {

    private static $instance;


    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }


    private $string, $chunks = [];

    public function process($string) {
        $this->string = $string;

        while($this->findStartTag() !== false) {
            $this->findEndTag();
        }

        return implode("", $this->chunks);
    }


    private function findEndTag() {
        $index = strpos($this->string, "/pre>");
        if (!$index) {
            $this->chunks[] = $this->string;
            return;
        }
        $this->chunks[] = substr($this->string, 0, $index);
        $this->string = substr($this->string, $index, strlen($this->string));
    }


    private function findStartTag() {
        $index = strpos( $this->string, "<pre");
        if ($index === false) {
            $this->chunks[] = nl2br($this->string);
            return false;
        }
        $this->chunks[] = nl2br(substr($this->string, 0, $index));
        $this->string = substr($this->string, $index, strlen($this->string));
        return true;
    }

}