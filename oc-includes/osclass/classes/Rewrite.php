<?php if ( ! defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.');

    /*
     *      Osclass – software for creating and publishing online classified
     *                           advertising platforms
     *
     *                        Copyright (C) 2012 OSCLASS
     *
     *       This program is free software: you can redistribute it and/or
     *     modify it under the terms of the GNU Affero General Public License
     *     as published by the Free Software Foundation, either version 3 of
     *            the License, or (at your option) any later version.
     *
     *     This program is distributed in the hope that it will be useful, but
     *         WITHOUT ANY WARRANTY; without even the implied warranty of
     *        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     *             GNU Affero General Public License for more details.
     *
     *      You should have received a copy of the GNU Affero General Public
     * License along with this program.  If not, see <http://www.gnu.org/licenses/>.
     */

    class Rewrite
    {
        private static $instance;
        private $rules;
        private $routes;
        private $request_uri;
        private $raw_request_uri;
        private $uri;
        private $location;
        private $section;
        private $http_referer;

        public function __construct()
        {
            $this->request_uri = '';
            $this->raw_request_uri = '';
            $this->uri = '';
            $this->location = '';
            $this->section = '';
            $this->http_referer = '';
            $this->routes = array();
            $this->rules = $this->getRules();
        }

        public static function newInstance()
        {
            if(!self::$instance instanceof self) {
                self::$instance = new self;
            }
            return self::$instance;
        }

        public function getTableName() {}

        public function getRules()
        {
            return osc_unserialize(osc_rewrite_rules());
        }

        public function setRules()
        {
            Preference::newInstance()->update(
                    array('s_value' => osc_serialize($this->rules))
                    ,array('s_name' => 'rewrite_rules')
            );
        }

        public function listRules()
        {
            return $this->rules;
        }

        public function addRules($rules)
        {
            if(is_array($rules)) {
                foreach($rules as $rule) {
                    if(is_array($rule) && count($rule)>1) {
                        $this->addRule($rule[0], $rule[1]);
                    }
                }
            }
        }

        public function addRule($regexp, $uri)
        {
            $regexp = trim($regexp);
            $uri = trim($uri);
            if($regexp!='' && $uri!='') {
                if(!in_array($regexp, $this->rules)) {
                    $this->rules[$regexp] = $uri;
                }
            }
        }

        public function addRoute($id, $regexp, $url, $file, $user_menu = false)
        {
            $regexp = trim($regexp);
            $file = trim($file);
            if($regexp!='' && $file!='') {
                $this->routes[$id] = array('regexp' => $regexp, 'url' => $url, 'file' => $file, 'user_menu' => $user_menu);
            }
        }

        public function getRoutes()
        {
            return $this->routes;
        }

        public function init()
        {
            // $_SERVER is not supported by Params Class... we should fix that
            if(isset($_SERVER['REQUEST_URI'])) {
                if(preg_match('|[\?&]{1}http_referer=(.*)$|', urldecode($_SERVER['REQUEST_URI']), $ref_match)) {
                    $this->http_referer = $ref_match[1];
                    $_SERVER['REQUEST_URI'] = preg_replace('|[\?&]{1}http_referer=(.*)$|', "", urldecode($_SERVER['REQUEST_URI']));
                }
                $request_uri = preg_replace('@^' . REL_WEB_URL . '@', "", urldecode($_SERVER['REQUEST_URI']));
                $this->raw_request_uri = $request_uri;
                $route_used = false;
                foreach($this->routes as $id => $route) {
                    // UNCOMMENT TO DEBUG
                    //echo 'Request URI: '.$request_uri." # Match : ".$match." # URI to go : ".$uri." <br />";
                    if(preg_match('#^'.$route['regexp'].'#', $request_uri, $m)) {
                        if(!preg_match_all('#\{([^\}]+)\}#', $route['url'], $args)) {
                            $args[1] = array();
                        }
                        $l = count($m);
                        for($p=1;$p<$l;$p++) {
                            if(isset($args[1][$p-1])) {
                                Params::setParam($args[1][$p-1], $m[$p]);
                            } else {
                                Params::setParam('route_param_'.$p, $m[$p]);
                            }
                        }
                        Params::setParam('page', 'custom');
                        Params::setParam('route', $id);
                        $route_used = true;
                        break;
                    }
                }
                if(!$route_used) {
                    if(osc_rewrite_enabled()) {
                        $tmp_ar = explode("?", $request_uri);
                        $request_uri = $tmp_ar[0];
                        foreach($this->rules as $match => $uri) {
                            // UNCOMMENT TO DEBUG
                            //echo 'Request URI: '.$request_uri." # Match : ".$match." # URI to go : ".$uri." <br />";
                            if(preg_match('#^'.$match.'#', $request_uri, $m)) {
                                $request_uri = preg_replace('#'.$match.'#', $uri, $request_uri);
                                break;
                            }
                        }
                    }
                    $this->extractParams($request_uri);
                    $this->request_uri = $request_uri;

                    if(Params::getParam('page')!='') { $this->location = Params::getParam('page'); };
                    if(Params::getParam('action')!='') { $this->section = Params::getParam('action'); };
                }
            }
        }

        public function extractURL($uri = '')
        {
            $uri_array = explode('?', str_replace('index.php', '', $uri));
            if(substr($uri_array[0], 0, 1)=="/") {
                return substr($uri_array[0], 1);
            } else {
                return $uri_array[0];
            }
        }

        public function extractParams($uri = '')
        {
            $uri_array = explode('?', $uri);
            $length_i = count($uri_array);
            for($var_i = 1;$var_i<$length_i;$var_i++) {
                if(preg_match_all('|&([^=]+)=([^&]*)|', '&'.$uri_array[$var_i].'&', $matches)) {
                    $length = count($matches[1]);
                    for($var_k = 0;$var_k<$length;$var_k++) {
                        Params::setParam($matches[1][$var_k], $matches[2][$var_k]);
                    }
                }
            }
        }

        public function removeRule($regexp)
        {
            unset($this->rules[$regexp]);
        }

        public function clearRules()
        {
            unset($this->rules);
            $this->rules = array();
        }

        public function get_request_uri()
        {
            return $this->request_uri;
        }

        public function get_raw_request_uri()
        {
            return $this->raw_request_uri;
        }

        public function set_location($location)
        {
            $this->location = $location;
        }

        public function get_location()
        {
            return $this->location;
        }

        public function get_section()
        {
            return $this->section;
        }
        
        public function get_http_referer()
        {
            return $this->http_referer;
        }
        
    }

?>