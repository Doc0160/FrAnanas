<?php
/**
 * Profiler Class File
 */

/**
 * Profiler Class
 *
 * For all your profiling needs
 * Add a bar on top with profiling data
 * Not meant to be used in production
 */
class Profiler {

    /**
     * CSS that holds the toolbar together
     */
    public $css = '
<style>
#php-profiler-bar .arrow {
    border: solid white;
    border-width: 0 3px 3px 0;
    display: inline-block;
    padding: 3px;
    transform: rotate(45deg);
    -webkit-transform: rotate(45deg);
    margin-top: -0.5em;
}
#php-profiler-bar {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    padding: 0;
    margin: 0;
    background-color: black;
    color: white;
    font: 1em "Trebuchet MS",Arial,sans-serif ;
    line-height: 2em ;
    overflow-x: scroll;
    overflow-y: visible;
    list-style: none;
    white-space: nowrap;
    //padding: 0.5em;
}
#php-profiler-bar li {
    margin: 0;
    padding: 0 1em;
    display: inline;
    border-right: 1px solid white;
}
#php-profiler-bar li > ul {
    display: none;
    position: fixed;
    left: 0;
    right: 0;
    top: 1.5em;
    background-color: black;
    border-top: 1px solid white;
    overflow: auto;
    padding: 0.5em;;
line-height: 1em ;
}
#php-profiler-bar li:hover > ul {
    display: block;
}
#php-profiler-bar li > ul li {
    display: block;
    border: none;
}
body {
    margin-top: 3em !important;
}
</style>';

    /**
     * Constructor
     */
    public function __construct() {
        $this->start_time = $this->getMicrotime(true);
        $this->log = [];
        register_shutdown_function(array($this, 'display'));
    }

    /**
     * Log 
     *
     * @param string $name
     * @param string $msg
     */
    public function log(string $name, string $msg = null):void {
        if($msg === null) {
            $msg = $name;
            $name = "Default";
        }
        $this->log['items'][] = [
            'name' => $name,
            'value' => $msg,
        ];
    }

    /**
     * Display the HTML
     */
    public function display():void {
        $this->gatherAll();
        $t = [
            'Max Memory Usage' =>
                $this->getReadableFileSize($this->max_memory_usage)
                              . ' / ' .
                                $this->getReadableFileSize($this->return_bytes($this->memory_limit)),
            'Time' =>
                $this->getReadableTime($this->end_time - $this->start_time)
                  . ' / ' .
                    $this->getReadableTime(ini_get('max_execution_time')*1000),
            'Included Files' => $this->included_files,
            'Log' => $this->log,
            'SESSION' => $this->session,
            'GET' => $this->get,
            'POST' => $this->post,
        ];
        echo $this->css;
        echo '<ul id="php-profiler-bar">';
        foreach($t as $k => $v) {
            if(is_array($v) && empty($v)) {
                continue;
            }
            if(is_array($v)){
                if(count($v['items'])) {
                    echo '<li>';
                    echo '<b>' . $k . '</b>';
                    echo ' : ';
                    echo '<i>';
                    echo isset($v['items']) ?
                         count($v['items']) . ' <span class="arrow"></span>' : 0;
                    echo '</i>';
                    echo '<ul>';
                    foreach($v as $vk => $vv) {
                        if(is_array($vv)) {
                            echo strtoupper($vk);
                            echo ' : ';
                            echo isset($vv) ? count($vv) : 0;
                            foreach($vv as $vvv) {
                                echo '<li>';
                                echo $vvv['name'];
                                echo ' : ';
                                echo '<i>';
                                if(isset($vvv['time']))
                                    echo $this->getReadableTime($vvv['time']);
                                if(isset($vvv['size']))
                                    echo $this->getReadableFileSize($vvv['size']);
                                if(isset($vvv['value']))
                                    echo $vvv['value'];
                                echo '</i>';
                                echo '</li>';
                            }

                        } else if(is_string($bb)) {
                            echo '<li>';
                            echo $vk;
                            echo ' : ';
                            echo '<i>' . $vv . '</i>';
                            echo '</li>';
                        } else {
                            var_dump($vv);
                        }
                    }
                    echo '</ul>';
                    echo '</li>';
                }
                
            } else {
                echo '<li>';
                echo '<b>' . $k . '</b>';
                echo ' : ';
                echo '<i>' . $v . '</i>';
                echo '</li>';
            }
        }
        echo '</ul>';
    }

    /**
     * Gather Data
     */
    public function gatherAll():void {
        $this->end_time = $this->getMicrotime();
        $this->max_memory_usage = memory_get_peak_usage();
        $this->memory_limit = ini_get('memory_limit');

        $this->gatherFiles();
        $this->gatherInputGet();
        $this->gatherInputPost();
        $this->gatherInputSession();
    }

    /**
     * Gather GET
     */
    private function gatherInputGet():void {
        $section_data_array = array();
        if (isset($_GET) && is_array($_GET)) {
            foreach ($_GET as $name => $value) {
                $section_data_array[] = [
                    'name' => $name,
                    'value' => $value,
                ];
            }
            unset($name, $value);
            $this->get['items'] = $section_data_array;
        }
    }

    /**
     * Gather POST
     */
    private function gatherInputPost():void {
        $section_data_array = array();
        if (isset($_POST) && is_array($_POST)) {
            foreach ($_POST as $name => $value) {
                $section_data_array[] = [
                    'name' => $name,
                    'value' => $value,
                ];
            }
            unset($name, $value);
            $this->post['items'] = $section_data_array;
        }
    }

    /**
     * Gather SESSION
     */
    private function gatherInputSession():void {
        $section_data_array = array();
        if (isset($_SESSION) && is_array($_SESSION)) {
            foreach ($_SESSION as $name => $value) {
                $section_data_array[] = [
                    'name' => $name,
                    'value' => $value,
                ];
            }
            unset($name, $value);
            $this->session['items'] = $section_data_array;
        }
        $this->session['meta'][] = [
            'name' => 'SESSION Name',
            'value' => session_name(),
        ];
        $this->session['meta'][] = [
            'name' => 'SESSION ID',
            'value' => session_id(),
        ];
    }

    /**
     * Gather Included Files
     */
    private function gatherFiles():void {
        $files = get_included_files();
        $section_data_array = [];
        $largest_size = -1;
        $total_size = 0;

        $this->included_files = [];
        if (is_array($files)) {
            foreach ($files as $file) {
                $size = filesize($file);
                $section_data_array[] = [
                    'name' => $file,
                    'size' => $size,
                ];
                
                if ($size > $largest_size) {
                    $largest_size = $size;
                }
                
                $total_size = bcadd($total_size, $size);
            }
            unset($file, $size);
        }
        $this->included_files['items'] = $section_data_array;
        $this->included_files['meta'][] = [
            'name' => 'Largest Size',
            'size' => $largest_size,
        ];
        $this->included_files['meta'][] = [
            'name' => 'Total Size',
            'size' => $total_size,
        ];
    }
    
    /**
     * Get microtime.
     * 
     * @param boolean $at_start set to true if this microtime is get at the very beginning of the app. this can allow newer php version to use $_SERVER['REQUEST_TIME_FLOAT'];
     * @return float microtime in float.
     */
    public function getMicrotime($at_start = false) {
        if ($at_start === true &&
            is_array($_SERVER) &&
            array_key_exists('REQUEST_TIME_FLOAT', $_SERVER)) {
            return floatval($_SERVER['REQUEST_TIME_FLOAT']);
        }
        return floatval(microtime(true));
    }

    /**
     * Get readable time.
     * 
     * @param integer $time
     * @return string
     */
    public function getReadableTime($time) {
        $ret = $time;
        $formatter = 0;
        $formats = array('ms', 's', 'm');
        if ($time >= 1000 && $time < 60000) {
            $formatter = 1;
            $ret = ($time / 1000);
        }
        if ($time >= 60000) {
            $formatter = 2;
            $ret = ($time / 1000) / 60;
        }
        $ret = number_format($ret, 3, '.', '') . ' ' . $formats[$formatter];
        unset($formats, $formatter);
        return $ret;
    }

    /**
     * Get readable file size.
     * 
     * @param int $size
     * @param string $retstring
     * @return string
     */
    public function getReadableFileSize($size, $retstring = null) {
        $sizes = array('o', 'ko', 'Mo', 'Go', 'To', 'Po', 'Eo', 'Zo', 'Yo');
        if ($retstring === null) {
            $retstring = '%01.2f %s';
        }
        $lastsizestring = end($sizes);
        foreach ($sizes as $sizestring) {
            if ($size < 1024) {
                break;
            }
            if ($sizestring != $lastsizestring) {
                $size /= 1024;
            }
        }
        if ($sizestring == $sizes[0]) {
            $retstring = '%01d %s';
        } // Bytes aren't normally fractional
        return sprintf($retstring, $size, $sizestring);
    }

    /**
     * Return Bytes from format "128Mo"
     *
     * @param $size_str
     * @return Max RAM Size
     */
    private function return_bytes ($size_str):int {
        switch (substr ($size_str, -1))
        {
            case 'M': case 'm': return (int)$size_str * 1048576;
            case 'K': case 'k': return (int)$size_str * 1024;
            case 'G': case 'g': return (int)$size_str * 1073741824;
            default: return (int)$size_str;
        }
    }
}
