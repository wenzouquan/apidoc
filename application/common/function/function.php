<?php
/**
 * 公共函数库
 */

if (!function_exists('get_ip_address')) {
    function get_ip_address($ip = '', $type = null)
    {
        if(!$ip){

            $ip = \gophp\request::getClientIp();
        }

        $url = "http://ip.taobao.com/service/getIpInfo.php?ip=".$ip;
        //调用淘宝接口获取信息
        $json = file_get_contents($url);

        $data = json_decode($json, true);

        if ($data['code']) {

            return $data['data'];

        } else {

            $country = $data['data']['country'];
            $province = $data['data']['region'];
            $city = $data['data']['city'];
            $area = $data['data']['area'];

            if($type == 'country'){

                return $country;

            }elseif($type == 'province'){

                return $province;

            }elseif($type == 'area'){

                return $area;

            }elseif($type == 'city'){

                return $city;

            }else{

                return $country.' '.' '.$province.' '.$city;

            }

        }

    }
}

if(!function_exists('get_visit_source')) {
    function get_visit_source(){
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
            if(stripos($user_agent, 'MicroMessenger') !== false) {
                return 'weixin';
            }
        $mobile_agents = array("240x320","acer","acoon","acs-","abacho","ahong","airness","alcatel","amoi","android","anywhereyougo.com","applewebkit/525","applewebkit/532","asus","audio","au-mic","avantogo","becker","benq","bilbo","bird","blackberry","blazer","bleu","cdm-","compal","coolpad","danger","dbtel","dopod","elaine","eric","etouch","fly ","fly_","fly-","go.web","goodaccess","gradiente","grundig","haier","hedy","hitachi","htc","huawei","hutchison","inno","ipad","ipaq","ipod","jbrowser","kddi","kgt","kwc","lenovo","lg ","lg2","lg3","lg4","lg5","lg7","lg8","lg9","lg-","lge-","lge9","longcos","maemo","mercator","meridian","micromax","midp","mini","mitsu","mmm","mmp","mobi","mot-","moto","nec-","netfront","newgen","nexian","nf-browser","nintendo","nitro","nokia","nook","novarra","obigo","palm","panasonic","pantech","philips","phone","pg-","playstation","pocket","pt-","qc-","qtek","rover","sagem","sama","samu","sanyo","samsung","sch-","scooter","sec-","sendo","sgh-","sharp","siemens","sie-","softbank","sony","spice","sprint","spv","symbian","tablet","talkabout","tcl-","teleca","telit","tianyu","tim-","toshiba","tsm","up.browser","utec","utstar","verykool","virgin","vk-","voda","voxtel","vx","wap","wellco","wig browser","wii","windows ce","wireless","xda","xde","zte");
        $is_mobile = false;
        foreach ($mobile_agents as $device) {
            if (stristr($user_agent, $device)) {
                $is_mobile = true;
                break;
            }
        }
        if($is_mobile){
            return 'mobile';
        }

        return 'pc';
    }
}

if(!function_exists('get_dir_chmod')) {
    function get_dir_chmod($dirName){

        if (is_readable ($dirName)) {

            $chmod = '可读,';

        }

        if (is_writable ($dirName)) {

            $chmod .= '可写,';

        }

        if (is_executable ($dirName)) {

            $chmod .= '可执行,';

        }

        return trim($chmod, ',');

    }
}

function pass_time($time)
{
    $now        = time();
    $time_past  = $now - strtotime($time);

    // 如果小于1分钟（60s），则显示"刚刚"
    if ($time_past < 60) {
        return '刚刚';
    }

    $time_mapping = array(
        '分钟' => '60',
        '小时' => '24',
        '天'   => '7',
        '周'   => '4',
        '月'   => '12',
        '年'   => '100'
    );

    $time_past = floor($time_past / 60);

    foreach($time_mapping as $k=>$v) {
        if ($time_past < $v) {
            return floor($time_past).$k.'前';
        }
        $time_past = $time_past / $v;
    }

    // 如果小于1小时（60*60s），则显示N分钟前
    // 如果小于24个小时（60*60*24s），则显示N小时前
    // 如果大于24个小时（60*60*24s），则显示N天前
}

/**
 * 获取后台配置信息
 * @param $field
 * @return mixed
 */
function get_config($field)
{
    return \app\config::get_config_value($field);
}

/**
 * 判断当前登录永丰虎密码是否是默认密码
 * @return bool
 */
function is_default_password()
{

    $user = \app\user::get_user_info();

    if(!$user){

        return false;

    }

    $default_password = md5(encrypt(\app\config::get_config_value('default_password')));

    if($default_password == $user['password']){

        return true;

    }else{

        return false;

    }

}

/** 获取表备注
 * @param $table_name 表名，包含前缀
 * @return mixed
 */
function get_table_comment($table_name)
{

    return \gophp\schema::instance()->getTableComment($table_name);

}

/**
 * id加密
 * @param $id
 * @return string
 */
function id_encode($id)
{

    return \gophp\helper\id::encode($id);

}

/**
 * id解密
 * @param $string
 * @return string
 */
function id_decode($string)
{

    return  \gophp\helper\id::decode($string);

}
