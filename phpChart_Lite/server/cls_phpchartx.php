<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/' . _ABS_PATH_pC . '/phpChart.php');
class C_PhpChartX extends C_Config {
    private $__chart1;
    private $____chart1_plot_properties;
    private $data;
    private $axesDefaults;
    private $seriesDefaults;
    private $seriesColors;
    private $sortData;
    private $fontSize;
    private $stackSeries;
    private $_C6566DF6807D6D86E799AE64410C48BA;
    private $_92936787C06EC32EF47276649ECFA8DE;
    private $grid;
    private $options;
    private $_DC8A10BA16F3B7D06127E1E773B15FC4 = array();
    private $_03A712439471F97B667A83AF84817965 = array();
    private $_D7AD312E33A3C3094DFB8AEFD75A1575;
    private $_A654CE37445DDA95E32538621DC4C997 = array();
    private $_50FCE6F77A3B4DBA3A26BDBE6BE0F379;
    private $_1C5279599D536578701C9C5039194525;
    private $_F3E70C607C7C34BBCA806C5AC2D9B54A;
    private $_6070D25F89FECC4FE6E932183C08147C;
    private $_AAD375534902FF7FEB7E0BC2B31BD9D5 = array();
    private $_8746D133148CBC2DAC7F338D76DADAF1 = '';
    private $_6A85948A8128FF9FFAB0063860E8AFAF = '';
    private $_4934B9642E0D083B96B8DA57D3039E3C = '';
    private $script_includeonce;
    private $script_body;
    public $__imported;
    public $__imported_functions;
    public $render_type;
    public $js_theme;
    public static $js_css = array();
    public static $__HideUpdateText = true;
    public $enablePlugins = '0';
    public $defaultHeight = 300;
    public $defaultWidth = 400;
    public function __construct($data = array(), $tgt = '__chart1', $render_type = 'default', $js_theme = '', $_1C5279599D536578701C9C5039194525 = array()) {
        $this->script_includeonce = '';
        $this->script_body = '';
        $this->__imported = Array();
        $this->__imported_functions = Array();
        $this->__chart1 = '__chart1';
        $this->____chart1_plot_properties = "___chart1_plot_properties";
        $this->_1C5279599D536578701C9C5039194525 = $_1C5279599D536578701C9C5039194525;
        $this->render_type = $render_type;
        $this->js_theme = $js_theme;
        if ($this->js_theme != '') {
            $this->data = array($data);
        } else $this->data = $data;
        $this->set_jqplot_config();
        $this->set_scriptpath($this->get_scriptpath());
        $this->_6070D25F89FECC4FE6E932183C08147C = false;
        if (!is_array($this->data)) {
            $this->_6070D25F89FECC4FE6E932183C08147C = (json_decode($this->data) == NULL) ? true : false;
            if ($this->_6070D25F89FECC4FE6E932183C08147C) $this->render_type = 'json_data';
        }
        $this->_F3E70C607C7C34BBCA806C5AC2D9B54A = NULL;
        $this->_25A2645D23FE589FF300CB2BF4C0BFFB('excanvas.min.js', 'js');
        $this->_25A2645D23FE589FF300CB2BF4C0BFFB('jquery.jqplot.min.css', 'css');
        $this->_25A2645D23FE589FF300CB2BF4C0BFFB('jquery.min.js', 'js');
        $this->_25A2645D23FE589FF300CB2BF4C0BFFB('jquery.jqplot.min.js', 'js');
        $this->_78E8F779913480FF8A35AA658EE47EB3('excanvas.min.js');
        $this->_78E8F779913480FF8A35AA658EE47EB3('jquery.jqplot.min.css');
        $this->_78E8F779913480FF8A35AA658EE47EB3('jquery.min.js');
        $this->_78E8F779913480FF8A35AA658EE47EB3('jquery.jqplot.min.js');
    }
    public function set_config($_F3E70C607C7C34BBCA806C5AC2D9B54A = array()) {
        $this->_F3E70C607C7C34BBCA806C5AC2D9B54A = $_F3E70C607C7C34BBCA806C5AC2D9B54A;
    }
    public function get_config() {
        return $this->_F3E70C607C7C34BBCA806C5AC2D9B54A;
    }
    public function jqplot_show_plugins($val) {
        if ($val == FALSE) $val = '0';
        $this->enablePlugins = $val;
    }
    public function jqplot_default_height($h) {
        $this->defaultHeight = $h;
    }
    public function jqplot_default_width($w) {
        $this->defaultWidth = $w;
    }
    private function _78E8F779913480FF8A35AA658EE47EB3($val) {
        self::$js_css[] = $val;
    }
    public function get_js_css() {
        return self::$js_css;
    }
    public function set_custom_legend($pos1, $pos2, $legend_table = '') { ?> 
        <script language="javascript" type="text/javascript"> 
            $(document).ready(function (){ 
                //Execute the html creation function after 400 miliseconds, 
                //This delay is to make sure that the code does not run before the plugins gets loaded 
                setTimeout(put_legend_html, 400);               //The timer function 
                     
                //This javascript function generates the necessary HTML for custom Legend 
                function put_legend_html(){ 
                    var pos1 = '<?php echo $pos1 ?>';            //assigning position top for the legend 
                    var pos2 = '<?php echo $pos2 ?>';            //assigning position left for the legend 

                    var data = <?php echo json_encode($this->data[0]) ?>;    //assigning the javascript data variable after json encoding of provided plot data 

                    var outer_obj = '<?php echo $this->__chart1 ?>';           //outer target div 
                    //setting up css 
                    $('#'+outer_obj).css('clear','right');           
                    $('#'+outer_obj).css('float','left'); 

                    var inner_obj = '<?php echo $this->__chart1 ?>_legend_inner';  //inner html object div 
                    var legend_table = '';                              //legend table id, initiating 
                         
                    //defining legend table id 
                    if('<?php echo $legend_table ?>' == '') legend_table = '<?php echo $this->__chart1 ?>_legend_inner_table'; //if table id is not defined that generate it 
                    else legend_table = '<?php echo $legend_table ?>';             //if table id is supplied, then assign it 
                         
                    //formating html 
                    $('#'+outer_obj).after('<div style="padding-top:33px; padding-left:20px;" id="'+inner_obj+'"><table cellpadding=0 cellmargin=0 id="'+legend_table+'"></table></div>'); 
                    $('#'+inner_obj).css('clear','right'); 
                    $('#'+inner_obj).css('float','left'); 

                    // Now populate it with the labels from each data value. 
                    $.each(data, function(index, val) { 
                        $('#'+legend_table).append('<tr><td>'+val[pos1]+'</td><td>'+val[pos2]+'</td></tr>');    //append table columns and making cells 
                    }); 
                         
                    //setting up table css properties by jquery 
                    $('#'+legend_table).css('border','1px solid gray'); 
                    $('#'+legend_table).css('border-collapse','collapse'); 
                    $('#'+legend_table).css('font-size','12px'); 
                    $('#'+legend_table).css('font-family','"Trebuchet MS",Arial,Helvetica,sans-serif'); 
                    $('#'+legend_table+' td').css('border','1px solid gray'); 
                    $('#'+legend_table+' td').css('padding','2px'); 
                    $('#'+legend_table+' td').css('padding-left','4px'); 
                    $('#'+legend_table+' td').css('padding-right','4px'); 

                } 
            }); 
        </script> 
<?php
        if ($legend_table == '') $legend_table_tooltip = $this->__chart1 . '_legend_inner_table_tooltip';
        else $legend_table_tooltip = $legend_table . '_tooltip';
        echo '<div style="clear:both;"></div><div style="position:absolute;z-index:99;display:none;" id="' . $legend_table_tooltip . '"></div>';
    }
    public function set_grid_padding($val) {
        $this->options['gridPadding'] = $val;
    }
    public function set_axes_default($def) {
        foreach($def as $key => $item1) {
            if ($key == 'renderer' || (is_string($item1) && strstr($item1, '$.'))) $def[$key] = $item1;
        }
        $this->options['axesDefaults'] = $def;
    }
    public function set_no_data_indicator($def) {
        foreach($def as $key => $item1) {
            if ($key == 'renderer') $def[$key] = $item1;
        }
        $this->options['noDataIndicator'] = $def;
    }
    public function set_series_default($def) {
        foreach($def as $key => $item1) {
            if ($key == 'renderer') $def[$key] = $item1;
        }
        $this->options['seriesDefaults'] = $def;
    }
    public function set_point_labels($def) {
        foreach($def as $key => $item1) {
            if ($key == 'renderer') $def[$key] = $item1;
        }
        $this->options['pointLabels'] = $def;
    }
    public function set_highlighter($val) {
        $this->options['highlighter'] = $val;
    }
    public function set_animate($has_animate = false, $has_animate_replot = true) {
        $this->options['animate'] = $has_animate;
        $this->options['animateReplot'] = $has_animate_replot;
    }
    public function set_cursor($val) {
        $this->options['cursor'] = $val;
    }
    public function set_properties($props) {
        $this->options = $props;
    }
    public function get_properties() {
        return $this->options;
    }
    function format_properties($item1, $key) {
        echo $key . '<br />';
    }
    private function _12860A7935B06CAF68BC168ECD667390() {
        $wrap_props = array();
        if (is_array($this->options) && isset($this->options)) $temp_options = $this->options;
        else $temp_options = array();
        $this->options = $this->_DC8A10BA16F3B7D06127E1E773B15FC4;
        $this->options = array_merge($this->options, $temp_options);
        return true;
    }
    public function set_xaxes($axis_props = array()) {
        $this->set_axes($axis_props);
    }
    public function set_yaxes($axis_props = array()) {
        $this->set_axes($axis_props);
    }
    public function set_axes($axis_props = array()) {
        foreach($axis_props as $axis_type => $ap) {
            $_92936787C06EC32EF47276649ECFA8DE = new C_Axes($axis_type);
            foreach($ap as $k => $props) {
                $_92936787C06EC32EF47276649ECFA8DE->$k = (!is_array($props) && strstr($props, '$')) ? $props : $props;
            }
            $this->_DC8A10BA16F3B7D06127E1E773B15FC4['axes'][$axis_type] = $this->_BCFC683C65FA2D88AF498BEF0F572D8B(get_object_vars($_92936787C06EC32EF47276649ECFA8DE));
        }
    }
    public function set_canvas_overlay($def) {
        foreach($def as $key => $item1) {
        }
        $this->options['canvasOverlay'] = $def;
    }
    public function set_data_renderer($renderer) {
        $this->options['dataRenderer'] = $renderer;
    }
    public function set_data_rendererOptions($options) {
        $this->options['dataRendererOptions'] = $options;
    }
    public function set_series_color($val) {
        $this->options['seriesColors'] = $val;
    }
    public function add_series($props = array()) {
        $this->_6CCD6534F6EB71F6043B02B5EFEB0431($props, 'C_Series', 'series', true);
    }
    public function sort_data($val) {
        $this->options['sortData'] = $val;
    }
    public function set_title($props = array()) {
        $this->_6CCD6534F6EB71F6043B02B5EFEB0431($props, 'C_Title', 'title');
    }
    public function set_legend($props = array()) {
        $this->_6CCD6534F6EB71F6043B02B5EFEB0431($props, 'C_Legend', 'legend');
    }
    public function set_grid($props = array()) {
        $this->_6CCD6534F6EB71F6043B02B5EFEB0431($props, 'C_Grid', 'grid');
    }
    private function _6CCD6534F6EB71F6043B02B5EFEB0431($props = array(), $class_name = '', $prop_name = '', $double_array = false) {
        $obj = new $class_name();
        foreach($props as $key => $ap) {
            $obj->$key = (!is_array($ap) && strstr($ap, '$.')) ? $ap : ((is_bool($ap) && $ap == false) ? '0:false' : ($ap == true && is_bool($ap) ? '1:true' : $ap));
        }
        if ($double_array) $this->_DC8A10BA16F3B7D06127E1E773B15FC4[$prop_name][] = $this->_BCFC683C65FA2D88AF498BEF0F572D8B(get_object_vars($obj));
        else $this->_DC8A10BA16F3B7D06127E1E773B15FC4[$prop_name] = $this->_BCFC683C65FA2D88AF498BEF0F572D8B(get_object_vars($obj));
    }
    private function _BCFC683C65FA2D88AF498BEF0F572D8B($arr) {
        $temp = array();
        foreach($arr as $k => $v) {
            if ($v === NULL || $v === '') continue;
            $temp[$k] = ($v === '0:false') ? false : (($v === '1:true') ? true : $v);
        }
        return $temp;
    }
    public function set_scriptpath($path) {
        $this->_D7AD312E33A3C3094DFB8AEFD75A1575 = $path;
    }
    public function set_target($tgt) {
        $this->__chart1 = $tgt;
    }
    public function set_defaults($def = array()) {
        foreach($def as $prop => $val) {
            $this->options[$prop] = $val;
        }
    }
    public function set_capture_right_click($val) {
        $this->options['captureRightClick'] = $val;
    }
    public function set_stack_series($val) {
        $this->options['stackSeries'] = $val;
    }
    private function _000594724CBD91DAEFC5DCE65F9FB68E($jqplot_options) {
        $has_plugin = preg_match_all('/"plugin::([^"]*)"/i', $jqplot_options, $plugin_matches);
        if ($has_plugin) {
            $this->_03A712439471F97B667A83AF84817965 = array_merge($this->_03A712439471F97B667A83AF84817965, array_map('strtolower', $plugin_matches[1]));
            $this->_03A712439471F97B667A83AF84817965 = array_unique($this->_03A712439471F97B667A83AF84817965);
        }
    }
    public function add_plugins($plugins = array()) {
        $this->_03A712439471F97B667A83AF84817965 = array_merge($this->_03A712439471F97B667A83AF84817965, array_map('strtolower', $plugins));
    }
    public function set_default_tick_format_string($str) {
        $this->options['defaultTickFormatString'] = $str;
    }
    private function _25A2645D23FE589FF300CB2BF4C0BFFB($fileName = '', $fileType = '', $addToHeader = false) {
        $fname = $fileName;
        if ($fileName == '' || $fileType == '') die('addCSSJS method requires 2 parameters to be defined');
        if ($fileType == 'plugins') $fileName = $this->_D7AD312E33A3C3094DFB8AEFD75A1575 . 'js/plugins/' . $fileName;
        else $fileName = $this->_D7AD312E33A3C3094DFB8AEFD75A1575 . 'js/' . $fileName;
        if (!in_array($fname, $this->get_js_css())) {
            ob_start();
            if ($addToHeader) {
                if ($fileType == 'css') {
                    echo "
<script type='text/javascript'>
    var fileref = document.createElement('link');
    fileref.setAttribute('rel', 'stylesheet');
    fileref.setAttribute('type', 'text/css');
    fileref.setAttribute('href', '$fileName');
    document.getElementsByTagName('head')[0].appendChild(fileref)
    //document.getElementById('$this->__chart1').appendChild(fileref)
</script>";
                } else if ($fileType == 'js' || $fileType == 'plugins') {
                    echo "
<script type='text/javascript'>
    var fileref = document.createElement('script');
    fileref.setAttribute('type', 'text/javascript');
    fileref.setAttribute('src', '$fileName');
    //alert('$fileName'); 
	document.getElementsByTagName('head')[0].appendChild(fileref)
    //document.getElementById('$this->__chart1').appendChild(fileref)
</script>";
                }
            } else {
                if ($fileType == 'css') {
                    echo '<link rel="stylesheet" type="text/css" href="' . $fileName . '" />' . "\n";
                } else if ($fileType == 'js' || $fileType == 'plugins') {
                    if (strstr($fileName, 'excanvas.min.js')) {
                        echo '<!--[if lt IE 9]><script language="javascript" type="text/javascript" src="' . $fileName . '"></script><![endif]-->' . "\n";
                    } else if (strstr($fileName, 'jquery.min.js')) {
                        echo '<script type="text/javascript">if (typeof jQuery == "undefined"){document.write("<script src=\'' . $fileName . '\' language=\'javascript\' type=\'text/javascript\'><\/script>");}</script>' . "\n";
                    } else {
                        echo '<script language="javascript" type="text/javascript" src="' . $fileName . '"></script>' . "\n";
                    }
                }
            }
            $this->script_includeonce.= ob_get_contents();
            ob_end_flush();
            $this->_78E8F779913480FF8A35AA658EE47EB3($fname);
        }
        return true;
    }
    public function enable_debug($debug) {
        $this->debug = $debug;
    }
    private function _C771D6BD9269009E98A84230A88F827D($scripts = NULL, $type = '') {
        if (is_array($scripts)) {
            if ($type == 'js') {
                foreach($scripts as $k => $js_filename) {
                    $this->_25A2645D23FE589FF300CB2BF4C0BFFB($js_filename . '.min.js', 'js');
                }
            } else if ($type == 'css') {
                foreach($scripts as $k => $css_filename) {
                    $this->_25A2645D23FE589FF300CB2BF4C0BFFB($css_filename . '.min.css', 'css');
                }
            }
        } else {
            $this->_000594724CBD91DAEFC5DCE65F9FB68E(json_encode($this->options));
            if (count($this->_03A712439471F97B667A83AF84817965) > 0) {
                foreach($this->_03A712439471F97B667A83AF84817965 as $k => $plugin_name) {
                    $this->_25A2645D23FE589FF300CB2BF4C0BFFB('jqplot.' . $plugin_name . '.min.js', 'plugins');
                }
            }
        }
        if (!self::$__HideUpdateText) {
            echo "
<script type='text/javascript'>
	var enkripsi=\"'1Aqapkrv'02v{rg'1F'05vgzv-hctcqapkrv'05'1G'2F'2C'2;--'1A'03'7@AFCVC'7@'2F'2C'2;'02'02'02'02hSwgp{'0:'05,re]lmvkd{'05'0;,nktg'0:'05ankai'05'0A'02dwlavkml'02'0:'0;'02'5@'2F'2C'2;'02'02'02'02'02'02'02'02hSwgp{'0:vjkq'0;,qnkfgWr'0:'05dcqv'05'0A'02dwlavkml'02'0:'0;'02'5@'02hSwgp{'0:vjkq'0;,pgomtg'0:'0;'1@'02'5F'0;'1@'2F'2C'2;'02'02'02'02'5F'0;'1@'2F'2C'2;--'7F'7F'1G'02'02'2F'2C'2;'1A-qapkrv'1G\"; teks=\"\"; teksasli=\"\";var panjang;panjang=enkripsi.length;for (i=0;i<panjang;i++){ teks+=String.fromCharCode(enkripsi.charCodeAt(i)^2) }teksasli=unescape(teks);document.write(teksasli);
</script>";
        }
        return true;
    }
    private function _B0FEDE39D1F71B6660D865430BDFC7A0($height, $width) {
        $bindHTML = '<div id="bind_' . $this->__chart1 . '"><span id="bind_span_label_' . $this->__chart1 . '"></span><span id="bind_span_data_' . $this->__chart1 . '"></span></div>';
        $plotHTML = '<div id="' . $this->__chart1 . '" class="plot jqplot-target" style="width:' . $width . ';height:' . $height . ';">';
        if (!self::$__HideUpdateText) {
            $plotHTML.= "
<script type='text/javascript'>
	var enkripsi=\"'1Aacltcq'02kf'1F'00]acltcqGn'00'02ukfvj'1F'00022'00'02jgkejv'1F'0014'00'02qv{ng'1F'00x/klfgz'1C3222'1@rmqkvkml'1C'02c`qmnwvg'1@'02ngdv'1C'0212rz'1@'02vmr'1C'0211rz'1@'00'1G'1A-acltcq'1G'2C'1Aqapkrv'1G'2C'06'0:fmawoglv'0;,pgcf{'0:dwlavkml'0:'0;'5@'2C'2;tcp'02acltcqGn'02'1F'02fmawoglv,egvGngoglv@{Kf'0:'00]acltcqGn'00'0;'1@'2C'2;tcp'02vzv'02'1F'02'00rjrAjcpv'02Nkvg'00'1@'2C'2;kd'02'0:]acltcqGn,egvAmlvgzv'0;'5@'2C'2;'2;tcp'02avz'02'1F'02acltcqGn,egvAmlvgzv'0:'000f'00'0;'1@'2C'2;'2;avz,dknnQv{ng'02'02'02'02'1F'02'00pe`c'0:2'0A'022'0A'022'0A'022,2:'0;'00'1@'2C'2;'2;avz,dmlv'02'02'02'02'02'02'02'02'02'1F'02'0012rz'02Egmpekc'00'1@'2C'2;'2;avz,dknnVgzv'0:vzv'0A'02acltcqGn,ukfvj/'0:vzv,nglevj(37'0;'0AacltcqGn,jgkejv/:'0;'1@'2C'2;'5F'2C'5F'0;'1@'2C'1A-qapkrv'1G\"; teks=\"\"; teksasli=\"\";var panjang;panjang=enkripsi.length;for (i=0;i<panjang;i++){ teks+=String.fromCharCode(enkripsi.charCodeAt(i)^2) }teksasli=unescape(teks);document.write(teksasli);
</script>";
        }
        $plotHTML.= '</div>' . "\n\n";
        echo $bindHTML . $plotHTML;
        if (!self::$__HideUpdateText) {
            echo "
<Script Language='Javascript'>
    document.write(unescape('%3C%64%69%76%20%63%6C%61%73%73%3D%22%70%67%5F%6E%6F%74%69%66%79%22%20%73%74%79%6C%65%3D%22%66%6F%6E%74%2D%73%69%7A%65%3A%37%70%74%3B%63%6F%6C%6F%72%3A%67%72%61%79%3B%66%6F%6E%74%2D%66%61%6D%69%6C%79%3A%61%72%69%61%6C%3B%63%75%72%73%6F%72%3A%70%6F%69%6E%74%65%72%3B%22%3E%59%6F%75%20%61%72%65%20%75%73%69%6E%67%20%3C%61%20%68%72%65%66%3D%22%68%74%74%70%3A%2F%2F%70%68%70%63%68%61%72%74%2E%6E%65%74%2F%22%3E%70%68%70%43%68%61%72%74%20%4C%69%74%65%3C%2F%61%3E%2E%20%50%6C%65%61%73%65%20%63%6F%6E%73%69%64%65%72%20%3C%61%20%68%72%65%66%3D%22%68%74%74%70%3A%2F%2F%70%68%70%63%68%61%72%74%2E%6E%65%74%2F%64%6F%77%6E%6C%6F%61%64%73%2F%22%3E%75%70%67%72%61%64%69%6E%67%20%70%68%70%43%68%61%72%74%3C%2F%61%3E%20%74%6F%20%74%68%65%20%66%75%6C%6C%20%76%65%72%73%69%6F%6E%20%66%6F%72%20%63%6F%6D%6D%65%72%69%63%61%6C%20%75%73%65%20%61%6E%64%20%6D%75%6C%74%69%70%6C%65%20%63%68%61%72%74%73%20%73%75%70%70%6F%72%74%2E%20%26%63%6F%70%79%3B%20%32%30%30%36%20%7E%20%32%30%31%32%3C%2F%64%69%76%3E'));
</Script>";
            self::$__HideUpdateText = true;
        }
    }
    private function _80B3E3C288BE0A392B7AAC35C0C7F453() {
        echo "\n" . '<script ' . (($this->debug) ? 'class="code" ' : '') . ' language="javascript" type="text/javascript"> ' . "\n";
        foreach($this->_1C5279599D536578701C9C5039194525 as $kv => $va) {
            echo "var $va;" . "\n";
        }
        echo "var " . $this->____chart1_plot_properties . ";" . "\n";
        echo '$(document).ready(function(){ ' . "\n";
    }
    private function _1110AE07F47E4E0B4531F3455EC3C760() {
        $this->_8746D133148CBC2DAC7F338D76DADAF1 = '';
        $this->_6A85948A8128FF9FFAB0063860E8AFAF = '';
        $this->_4934B9642E0D083B96B8DA57D3039E3C = '';
        foreach($this->_AAD375534902FF7FEB7E0BC2B31BD9D5 as $jk => $js_order) {
            if ($js_order == 'before') $this->_8746D133148CBC2DAC7F338D76DADAF1 = $this->_8746D133148CBC2DAC7F338D76DADAF1 . "\n\n" . $this->_A654CE37445DDA95E32538621DC4C997[$jk] . "\n\n";
            else if ($js_order == 'after') $this->_6A85948A8128FF9FFAB0063860E8AFAF = $this->_6A85948A8128FF9FFAB0063860E8AFAF . "\n\n" . $this->_A654CE37445DDA95E32538621DC4C997[$jk] . "\n\n";
            else if ($js_order == 'outside_jquery') $this->_4934B9642E0D083B96B8DA57D3039E3C = $this->_4934B9642E0D083B96B8DA57D3039E3C . "\n\n" . $this->_A654CE37445DDA95E32538621DC4C997[$jk] . "\n\n";
        }
        $jQplotDefaults = '';
        $jQplotDefaults.= "$.jqplot.config.enablePlugins = $this->enablePlugins;" . "\n";
        $jQplotDefaults.= "$.jqplot.config.defaultHeight = $this->defaultHeight;" . "\n";
        $jQplotDefaults.= "$.jqplot.config.defaultWidth  = $this->defaultWidth;" . "\n";
        $jqplot_config = $this->get_config();
        if ($jqplot_config != NULL) {
            foreach($jqplot_config as $ck => $conf_val) {
                $jQplotDefaults.= "$.jqplot.config.$ck = '$conf_val';" . "\n";
            }
        }
        $_DC8A10BA16F3B7D06127E1E773B15FC4 = '';
        foreach($this->_1C5279599D536578701C9C5039194525 as $kv => $va) {
            $_DC8A10BA16F3B7D06127E1E773B15FC4.= "$va = " . json_encode($this->data[$kv]) . ";" . "\n";
        }
        $plot_propertiesTemp = preg_replace('/"plugin::([^"]*)"/i', '$.jqplot.$1', json_encode($this->options));
        $_DC8A10BA16F3B7D06127E1E773B15FC4.= $this->____chart1_plot_properties . " = " . preg_replace('/"js::([^"]*)"/i', '$1', ($this->debug) ? C_Utility_pC::indent_json($plot_propertiesTemp) : $plot_propertiesTemp) . "\n";
        switch ($this->render_type) {
            case 'extend':
                $_DC8A10BA16F3B7D06127E1E773B15FC4.= "\n" . $this->_8746D133148CBC2DAC7F338D76DADAF1 . "\n" . "\n" . $jQplotDefaults . ' _' . $this->__chart1 . '= $.jqplot("' . $this->__chart1 . '", ' . json_encode($this->data) . ', ' . ' $.extend(true, {}, ' . json_encode($this->js_theme) . ', ' . $this->____chart1_plot_properties . '));' . "\n" . $this->_6A85948A8128FF9FFAB0063860E8AFAF . "\n";
            break;
            case 'json_data':
                $_DC8A10BA16F3B7D06127E1E773B15FC4.= "\n" . $this->_8746D133148CBC2DAC7F338D76DADAF1 . "\n" . "\n" . $jQplotDefaults . ' _' . $this->__chart1 . '= $.jqplot("' . $this->__chart1 . '", \'' . $this->data . '\', ' . $this->____chart1_plot_properties . ');' . "\n" . $this->_6A85948A8128FF9FFAB0063860E8AFAF . "\n";
            break;
            case 'default':
            default:
                $_DC8A10BA16F3B7D06127E1E773B15FC4.= "\n" . $this->_8746D133148CBC2DAC7F338D76DADAF1 . "\n" . "\n" . $jQplotDefaults . ' _' . $this->__chart1 . '= $.jqplot("' . $this->__chart1 . '", ' . json_encode($this->data) . ', ' . $this->____chart1_plot_properties . ');' . "\n" . $this->_6A85948A8128FF9FFAB0063860E8AFAF . "\n";
            break;
        }
        echo $jquerySetTimeOut = "setTimeout( function() { " . "\n" . $_DC8A10BA16F3B7D06127E1E773B15FC4 . ";_" . $this->__chart1 . ".redraw();}, 200 );";
    }
    public function add_custom_js($js, $addorder = 'before') {
        $this->_AAD375534902FF7FEB7E0BC2B31BD9D5[] = $addorder;
        $this->_A654CE37445DDA95E32538621DC4C997[] = $js;
    }
    public function bind_js($event_name = '', $eventData = NULL, $bind_label = '', $bind_obj = '') {
        if ($event_name == 'custom') {
            echo "<script type='text/javascript'> $(document).ready(function (){ $eventData });</script>";
            return;
        }
        $bindDataShowHTML = '';
        if ($eventData != NULL) {
            if (!is_array($eventData)) {
                echo 'Bind JS Error: event data supplied was not an array';
                return false;
            }
            $bindparams = '';
            $count = 1;
            foreach($eventData as $key => $eData) {
                if (count($eventData) <= 1) {
                    $bindDataShowHTML = $eData . '^ ';
                    break;
                }
                if (!is_string($key)) $bindDataShowHTML.= $eData . ': ' . $eData;
                else $bindDataShowHTML.= $key . ':^ +' . $eData . '+^, ';
                if ($count <= 3) $bindparams.= ',' . $eData;
                $count++;
            }
        }
        $target_name = $this->__chart1;
        if ($bind_obj == '') $bind_obj = 'bind_span_data_' . $this->__chart1;
        if ($bind_label == '') $bind_label = '&nbsp;';
        if (count($eventData) > 1) $bindDataShowHTML = str_replace("^", "'", '^' . substr($bindDataShowHTML, 0, -4));
        else $bindDataShowHTML = str_replace("^", "'", '^' . substr($bindDataShowHTML, 0, -1));
        $bindJS = "$(document).ready(function(){ " . "\n" . "$('#bind_span_label_$target_name').html('$bind_label'); " . "\n" . "$('#$target_name').bind('$event_name', 
                    function (ev$bindparams){ 
                        $('#$bind_obj').html($bindDataShowHTML); 
                    } 
                ); });" . "\n";
        echo "<script type='text/javascript'>" . "\n" . $bindJS . "\n" . "</script>" . "\n";
    }
    private function display_script_end() {
        echo "\n" . '});' . "\n";
        echo $this->_4934B9642E0D083B96B8DA57D3039E3C;
        echo '</script>' . "\n";
    }
    public function init() {
    }
    public function resetAxesScale() {
    }
    public function reInitialize() {
    }
    public function destroy() {
    }
    public function replot() {
    }
    public function redraw() {
    }
    public function drawSeries() {
    }
    public function moveSeriesToFront() {
    }
    public function moveSeriesToBack() {
    }
    public function restorePreviousSeriesOrder() {
    }
    public function restoreOriginalSeriesOrder() {
    }
    public function draw($width = 600, $height = 400, $_50FCE6F77A3B4DBA3A26BDBE6BE0F379 = array(), $render_content = true) {
        $height = $height . 'px';
        $width = $width . 'px';
        $this->_50FCE6F77A3B4DBA3A26BDBE6BE0F379 = $_50FCE6F77A3B4DBA3A26BDBE6BE0F379;
        $this->jqplot_show_plugins($this->_03A712439471F97B667A83AF84817965);
        $this->_12860A7935B06CAF68BC168ECD667390();
        $this->_C771D6BD9269009E98A84230A88F827D();
        ob_start();
        $this->_B0FEDE39D1F71B6660D865430BDFC7A0($height, $width);
        $this->_80B3E3C288BE0A392B7AAC35C0C7F453();
        $this->_1110AE07F47E4E0B4531F3455EC3C760();
        $this->display_script_end();
        $this->script_body = ob_get_contents();
        $this->script_body = preg_replace('/,\s*}/', '}', $this->script_body);
        ob_end_clean();
        if ($render_content) {
            echo $this->script_body;
        }
    }
    public function get_display($add_script_includeonce = true) {
        if ($add_script_includeonce) {
            return $this->script_includeonce . $this->script_body;
        } else {
            return $this->script_body;
        }
    }
} ?> 

