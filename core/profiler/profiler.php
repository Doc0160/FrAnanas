<?php
/**
 * Profiler Class
 *
 * For all your profiling needs
 */
class Profiler {
    private $start_time;
    private $end_time;

    public function __construct() {
        $this->start_time = $this->getMicrotime(true);
        register_shutdown_function(array($this, 'gatherAll'));
    }

    public function gatherAll() {
        $this->end_time = $this->getMicrotime();
        $t = [
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'time' => $this->end_time - $this->start_time,
        ];
        echo '<ul>';
        foreach($t as $k => $v) {
            echo '<li>' . $k . ' : ' . $v . '</li>';
        }
        echo '</ul>';
    }

    public function getMicrotime($at_start = false)
    {
        if ($at_start === true &&
            is_array($_SERVER) &&
            array_key_exists('REQUEST_TIME_FLOAT', $_SERVER)) {
            return floatval($_SERVER['REQUEST_TIME_FLOAT']);
        }
        return floatval(microtime(true));
    }
}
