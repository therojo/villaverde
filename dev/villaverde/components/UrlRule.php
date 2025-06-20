<?php
namespace app\components;

use yii;

class UrlRule extends yii\web\UrlRule
{
    public function init()
    {
        if ($this->name === null) {
            $this->name = __CLASS__;
        }
    }

    public function createUrl($manager, $route, $params)
    {
        $args='?';
        $idx = 0;
        foreach($params as $num=>$val){
            if(substr($num,0,2)=='id'){
                $val = urlencode(base64_encode(addslashes(gzdeflate(serialize((string)$val), 9))));
                $num = urlencode(base64_encode(addslashes(gzdeflate(serialize((string)$num), 9))));
            }

            if(!is_array($num) && !is_array($val))
                $args .= $num . '=' . $val;

            $idx++;
            if($idx!=count($params)) $args .= '&';
        }
        $suffix = Yii::$app->urlManager->suffix;
        if ($args=='?') $args = '';
        return $route .$suffix. $args;
        return false;  // this rule does not apply
    }

    public function parseRequest($manager, $request)
    {
        $pathInfo = $request->getPathInfo();
        $url = $request->getUrl();
        $queryString = parse_url($url);
        if(isset($queryString['query'])){
            $queryString = $queryString['query'];
            $args = [];
            parse_str($queryString, $args);
            $params = [];
            foreach($args as $num=>$val){

                $decodeVal = $this->isEncrypted($val);

                $decodeNum = $this->isEncrypted($num);

                if($decodeVal && $decodeNum) {

                    $val = unserialize(gzinflate(stripcslashes($decodeVal)));
                    $num = unserialize(gzinflate(stripcslashes($decodeNum)));

                }

                $params[$num]=$val;

            }
            $suffix = Yii::$app->urlManager->suffix;
            $route = str_replace($suffix,'',$pathInfo);
            return [$route,$params];
        }
        return false;  // this rule does not apply
    }

    private function isEncrypted($string)
    {
        if(!is_array($string)){
            $decode = base64_decode(urldecode($string));
            $slashes = strpos($decode,'\\');

            if($slashes)
            {
                return $decode;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}
