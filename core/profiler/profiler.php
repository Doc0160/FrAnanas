<?php
/**
 * Profiler Class File
 */

/**
 * Profiler Class
 *
 * For all your profiling needs
 *
 * Add a bar on top with profiling data
 *
 * Not meant to be used in production
 */
class Profiler {

    /**
     * CSS that holds the toolbar together
     */
    public $css = '
<style>
 /*
    #php-profiler-bar, #php-profiler-bar * {
    box-sizing: border-box;
    }
    #php-profiler-bar li:hover > ul {
    display: block !important;
    }
    #php-profiler-bar li > ul li {
    display: block !important;
    border: none !important;
    }
    #php-profiler-bar {
    position: fixed !important;
    top: 0;
    left: 0;
    right: 0;
    padding: 0;
    margin: 0;
    background-color: black;
    color: white !important;
    font: 1em "Trebuchet MS",Arial,sans-serif ;
    line-height: 2em;
    overflow-x: scroll;
    overflow-y: visible;
    list-style: none;
    white-space: nowrap;
    word-spacing: normal;
    }
    #php-profiler-bar li {
    margin: 0;
    padding: 0 1em;
    display: inline !important;
    border-right: 1px solid white !important;
    }
    #php-profiler-bar li > ul {
    display: none !important;
    position: fixed !important;
    left: 0 !important;
    right: 0 !important;
    top: 1.5em;
    background-color: black;
    border-top: 1px solid white;
    overflow: auto;
    padding: 0.5em;
    line-height: 1em !important;
    }*/

body {
    margin-top: 3em !important;
}
.php-debug-tabs {
   position: fixed !important;
   top: 0;
   left: 0;
   right: 0;
   padding: 0;
   margin: 0;
}
.tab {
     float: left;
     position: relative;
 }
.tab label {
     background: linear-gradient(#eee, #ccc);
     padding: 10px 30px;
     cursor: pointer;
     text-align: center;
     display: block;
     position: relative;
 }
.tab label i {
     font-style: normal;
     font-size: 10px;
     color: #aaa;
 }
.tab [type=radio] {
     position: absolute;
     top: 0;
     left: 0;
     width: 100%;
     height: 100%;
     opacity: 0;
     margin: 0;
     z-index: 1;
 }
.php-debug-content {
    position: fixed;
    width: 90%;
    max-height: 80%;
    opacity: 0;
    left: 0;
    background: #333;
    color: white;
    padding: 20px;
    overflow: auto;
}
 .php-debug-content ul {
     margin: 0;
     padding: 0;
     list-style: none;
 }
 .php-debug-content a {
     color: white;
     display: block;
     white-space: nowrap;
     text-decoration: none;
     border-bottom: 1px solid #999;
     padding: 5px;
 }  
 [type=radio]:checked ~ label {
     z-index: 2;
 }
 [type=radio]:checked ~ label ~ .php-debug-content {
     z-index: 1;
     opacity: 1;
 }
 .close-tab {
     position: absolute;
     z-index: -1;
     top: 0;
     left: 0;
     width: 100%;
     height: 100%;
 }
 .close-tab label {
     background: #333;
     color: white;
 }
 [type=radio]:checked ~ label ~ .close-tab {
     z-index: 3;
 }
</style>';

    private $assert = [];
    private $included_files = [];
    private $get = [];
    private $post = [];
    private $session = [];
    private $cookie = [];
    private $autoload = [];
    private $start_time = 0;
    private $end_time = 0;

    /**
     * Constructor
     *
     * This constructor use:
     * - assert_options
     * - register_shutdown_function
     * - spl_autoload_register
     *
     */
    public function __construct() {
        $this->start_time = $this->getMicrotime(true);

        //NOTE(doc): set up assertions
        assert_options(ASSERT_ACTIVE, 1);
        assert_options(ASSERT_WARNING, 0);
        assert_options(ASSERT_BAIL, 0);
        assert_options(ASSERT_QUIET_EVAL, 1);
        assert_options(ASSERT_CALLBACK, array($this, 'assert'));

        //NOTE(doc): set up autoload intercept
        spl_autoload_register([$this, 'autoload'], false, true);

        //NOTE(doc): register display after the script
        register_shutdown_function(array($this, 'display'));
    }

    /**
     * Callback for autoload system
     *
     * Never call this function directly
     * 
     * @param $class
     */
    public function autoload(string $class):bool {
        $this->autoload['items'][] = [
            'name' => (isset($this->autoload['items'])) ?
                    count($this->autoload['items']) : 0,
            'value' => $class,
        ];
        return false;
    }

    /**
     * Callback for assert system
     * 
     * Never call this function directly
     * 
     * Just use ```assert(true==false, 'I want to know if right is wrong');```
     *
     * @param string $file
     * @param $line
     * @param $code
     * @param $desc
     *
     * @see http://php.net/manual/en/function.assert.php
     */
    public function assert(string $file, $line, $code, $desc = null):void {
        $this->assert['items'][] = [
            'name' => $file . ', ' . $line,
            'value' => (!empty($code)) ? $code . ' ' : '' .
                                                       (!empty($desc)) ? $desc : '',
        ];
    }

    /**
     * Force assert fail to be fatal
     *
     * @param bool $fatal if true, assert fail becomes fatal
     */
    public function setAssertFatal(bool $fatal = false):void {
        assert_options(ASSERT_BAIL, 1);
        assert_options(ASSERT_WARNING, 1);
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
            'Asserts' => $this->assert,
            'Autoload' => $this->autoload,
            'SESSION' => $this->session,
            'COOKIE' => $this->cookie,
            'GET' => $this->get,
            'POST' => $this->post,
            'REQUEST' => $this->request,
            'SERVER' => $this->server,
            'ENV' => $this->env,
        ];
        echo $this->css;
        /*echo '<ul id="php-profiler-bar">';
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
           echo '<input type="radio" name="php-debug-radio">';
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
           echo '</ul>';*/
        echo '<div class="php-debug-tabs">';
        foreach($t as $key => $value) {
            if(is_array($value) && empty($value)) {
                continue;
            }
            echo '<div class="tab">';
            
            echo '<input type="radio" id="tab-1" name="tab-group-1">';
            echo '<label for="tab-1">'.$key.' <i>▼</i></label>';
            echo '<div class="tab close-tab">';
            echo '<input type="radio" id="tab-close" name="tab-group-1">';
            echo '<label for="tab-close">'.$key.' <i>▲</i></label>';
            echo '</div>';

            echo '<div class="php-debug-content">';
		    echo '<ul>';
            if(is_array($value)) {
                if(isset($value['items']) && count($value['items'])) {
                    foreach($value['items'] as $subkey => $subvalue) {
                        echo '<li><a href="#!">';
                        if(isset($subvalue['name'])) {
                            echo '<b>';
                            echo $subvalue['name'];
                            echo ': ';
                            echo '</b>';
                        }
                        foreach(['value', 'size'] as $a) {
                            if(isset($subvalue[$a])) {
                                echo $subvalue[$a];
                                echo ' ';
                            }
                        }
                        echo '</a></li>';
                    }
                } else {
                    echo '<li>';
                    var_dump($value);
                    echo '</li>';
                }
            } else {
		        echo '<li><a href="#">'.$value.'</a></li>';
            }
        	echo '</ul>';
            echo '</div>';
            
            echo '</div>';
        }
        echo '</div>';
    }

    /**
     * Gather Data
     */
    public function gatherAll():void {
        $this->end_time = $this->getMicrotime();
        $this->max_memory_usage = memory_get_peak_usage();
        $this->memory_limit = ini_get('memory_limit');
        
        $this->gatherFiles();
        $this->gatherEnv();
        $this->gatherRequest();
        $this->gatherServer();
        $this->gatherInputGet();
        $this->gatherInputPost();
        $this->gatherInputSession();
    }

    /**
     * Gather REQUEST
     */
    private function gatherRequest():void {
        $section_data_array = array();
        if (isset($_REQUEST) && is_array($_REQUEST)) {
            foreach ($_REQUEST as $name => $value) {
                $section_data_array[] = [
                    'name' => $name,
                    'value' => $value,
                ];
            }
            unset($name, $value);
            $this->request['items'] = $section_data_array;
        }
    }

    /**
     * Gather ENV
     */
    private function gatherEnv():void {
        $section_data_array = array();
        if (isset($_ENV) && is_array($_ENV)) {
            foreach ($_ENV as $name => $value) {
                $section_data_array[] = [
                    'name' => $name,
                    'value' => $value,
                ];
            }
            unset($name, $value);
            $this->env['items'] = $section_data_array;
        }
    }

    /**
     * Gather SERVER
     */
    private function gatherServer():void {
        $section_data_array = array();
        if (isset($_SERVER) && is_array($_SERVER)) {
            foreach ($_SERVER as $name => $value) {
                $section_data_array[] = [
                    'name' => $name,
                    'value' => $value,
                ];
            }
            unset($name, $value);
            $this->server['items'] = $section_data_array;
        }
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
     * Gather COOKIE
     */
    private function gatherInputCookie():void {
        $section_data_array = array();
        if (isset($_COOKIE) && is_array($_COOKIE)) {
            foreach ($_COOKIE as $name => $value) {
                $section_data_array[] = [
                    'name' => $name,
                    'value' => $value,
                ];
            }
            unset($name, $value);
            $this->session['items'] = $section_data_array;
        }
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
                    'value' => $this->getReadableFileSize($size),
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
            'value' => $largest_size,
        ];
        $this->included_files['meta'][] = [
            'name' => 'Total Size',
            'value' => $this->getReadableFileSize($total_size),
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
