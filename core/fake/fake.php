<?php

final class fake {
    /**
     * headline, paragraph, username, ...
     */
    public static function text($type = 'headline') {
        $path = dirname(__FILE__) .  "/assets/text/".$type.'.txt';
        $strings = file($path);
        $strings = array_filter($strings, 'dummy_filter_strings');
        if (count($strings) == 0) {
            echo "<em>Couldn't locate anything usable in <b>&#8220;/assets/$inpath@$filename&#8221;</b>. Please double check your Dummy Code.</em>";
            return;
        }
        $idx = array_rand($strings);
        ob_start();
        eval('?' . '>' . $strings[$idx]);
        $content = trim(ob_get_contents());
        ob_end_clean();
        return $content;
    }
    /**
     * landscape, portrait, avatar, ...
     */
    public static function image($type = 'landscape') {
        $path = dirname(__FILE__) .  '/assets/image/'.$type.'/*';
        $files = glob($path);
        $file = $files[rand(0, count($files)-1)];
        $file = file_get_contents($file);
        $file = base64_encode($file);
        return 'data:image/x-icon;base64,'.$file;
    }

    /**
     *
     * @param string $p
     * - 0-5 give a number between 0 and 5 inluded
     * - 23% 25% chance to return true
     * @return bool|int
     */
    public static function luck($p) {
        static $luckstack = array();
        
        if (strpos($p, '%')/* || is_numeric($p)*/) {
            return rand(0,99) < intval($p);
        }
        
        if ($p == '') {
            if (count($luckstack) == 0) { echo "<em>Not inside <b>dumb_luck</b></em>"; return false; }
            $frame = $luckstack[0];
            echo $frame['pos']+1;
            return;
        }
        
        if ($p == 'first') {
            if (count($luckstack) == 0) { echo "<em>Not inside <b>dumb_luck</b></em>"; return false; }
            $frame = $luckstack[0];
            return $frame['pos'] == 0;
        }
        
        if ($p == 'last') {
            if (count($luckstack) == 0) { echo "<em>Not inside <b>dumb_luck</b></em>"; return false; }
            $frame = $luckstack[0];
            return $frame['pos'] == $frame['count']-1;
        }
        
        if ($p == 'inner') {
            if (count($luckstack) == 0) { echo "<em>Not inside <b>dumb_luck</b></em>"; return false; }
            $frame = $luckstack[0];
            return $frame['pos'] != $frame['count']-1 && $frame['pos'] != 0;
        }
        
        if (strpos($p, '-') === false && !is_numeric($p)) {
            echo "<em>Wrong range given to <b>dumb_luck</b></em>";
            return false;
        }
        
        $stack = debug_backtrace();
        $ref = md5($stack[0]['file'] . $stack[0]['line'] . serialize( $stack[0]['args'] ));
        
        if (count($luckstack) > 0) {
            if ($luckstack[0]['ref'] == $ref) {
                
                if (++$luckstack[0]['pos'] < $luckstack[0]['count']) {
                    return true;
                } else {
                    array_shift($luckstack);
                    return false;
                }
            }
        }
        
        if (strpos($p, '-') === false) {
            $count = intval($p);
        } else {
            
            $range = explode('-', $p,2);
            
            $count = rand(min($range[0], $range[1]), max($range[0],$range[1]));
        }
        $frame = array(
            'count' => $count,
            'pos' => 0,
            'ref' => $ref,
        );
        
        if ($count > 0) {
            array_unshift($luckstack, $frame);
            return true;
        } else {
            return false;
        }
    }

}

function dummy_filter_strings($a) {
    $a = trim($a);
    if ($a == '') return false;     // Remove empty lines
    if ($a{0} == '#') return false; // Remove comments
        return true;
    }

