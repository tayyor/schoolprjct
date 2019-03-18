<?php
namespace App\Core;

use Monolog\Logger;
use Zwijn\Monolog\Handler\LogdnaHandler;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Office;

class Helpers{
    
    /**
     * Generate and return a random characters string
     *
     * Useful for generating passwords or hashes.
     * 
     * The default string returned is 8 alphanumeric characters string.
     *
     * The type of string returned can be changed with the "type" parameter.
     * Seven types are - by default - available: basic, alpha, alphanum, num, nozero, unique and md5. 
     *
     * @param   string  $type    Type of random string.  basic, alpha, alphanum, num, nozero, unique and md5.
     * @param   integer $length  Length of the string to be generated, Default: 8 characters long.
     * @return  string
     */
    public static function random_str($type = 'alphanum', $length = 8)
    {
        switch($type)
        {
            case 'basic'    : return mt_rand();
            case 'alpha'    :
            case 'alphanum' :
            case 'num'      :
            case 'nozero'   :
                    $seedings             = array();
                    $seedings['alpha']    = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $seedings['alphanum'] = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $seedings['num']      = '0123456789';
                    $seedings['nozero']   = '123456789';

                    $pool = $seedings[$type];

                    $str = '';
                    for ($i=0; $i < $length; $i++)
                    {
                        $str .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
                    }
                    return $str;
            case 'unique'   :
            case 'md5'      :
                        return md5(uniqid(mt_rand()));
        }
    }
    
    public static function logDNA($data = [], $extra = ['debug'=>true]){
        $logger = new Logger('api');
        $logdnaHandler = new LogdnaHandler(env('LOG_DNA_KEY'), env('LOG_DNA_SOURCE'), Logger::API);
        $logger->pushHandler($logdnaHandler);
        $logger->info(request()->getUri(), $data, $extra);
    }
    
    public static function format_view_date($date){
        $ret = '';
        $repl = str_replace('-', '/', $date);
        $tmp_rep = explode('/', $repl);
        $ret = $tmp_rep[2].'/'.$tmp_rep[1].'/'.$tmp_rep[0];
        return $ret;
    }
    
    public static function getTimeInZone($date){
        $format_date = Carbon::createFromFormat('Y-m-d H:i:s', $date, 'UTC')
                ->setTimezone('Africa/Lagos')->format('Y-m-d H:i:s');
        return $format_date;
    }

    public static function dbFriendlyDate($date){
        $ret = '';
        $tmp_rep = explode('-', $date);
        if(sizeof($tmp_rep)>2){
            $ret = $tmp_rep[2].'-'.$tmp_rep[1].'-'.$tmp_rep[0];
        }
        return $ret;
    }

    public static function dbFriendlyToRoadZoftFriendlyDate($date){
        $ret = '';
        $tmp_rep = explode('-', $date);
        if(sizeof($tmp_rep)>2){
            $ret = $tmp_rep[2].'-'.$tmp_rep[1].'-'.$tmp_rep[0];
        }
        return $ret;
    }

    public static function dbFriendlyToPickerDate($date){
        $expl = explode(' ', static::dbFriendlyToRoadZoftFriendlyDate($date));
        if($expl[0] == '00-00-0000'){
            $expl[0] = date('d-m-Y');
        }
        return str_replace('-', '/', $expl[0]);
    }

    public static function get_lga($country = 'nigeria', $state = ''){
        $response = [];
        $file = static::_load_country_file($country);
        collect($file)->each(function($one) use (&$response, $state){
            if($one->state->name === $state){
                collect($one->state->locals)->each(function($lga) use (&$response){
                    $response[$lga->name] = $lga->name;
                });
                return;
            }
        });
        return $response;
    }
    
    private static function _load_country_file($country){
        $param_country = $country?$country:'nigeria';
        return json_decode(file_get_contents(asset('assets/'.$param_country.'.js')));
    }
    
    public static function remove_nulls($array){
        $ret = [];
        foreach($array as $key=>$value){
            if(!is_null($value)){
                $ret[$key] = $value;
            }
        }
        return $ret;
    }

    public static function getOfficesKeyValue(){
        $ret = [];
        $query = Office::select('id', 'name')->get();
        if($query){
            $query->each(function($value) use(&$ret){
                $ret[$value->id] = $value->name;
            });
        }
        return $ret;
    }

    public static function isApiCall(Request $request){
        if($request->getContentType() == 'application/json' || $request->expectsJson()
            || $request->header('Content-Type') == 'application/json'){
            return true;
        }
        return false;
    }

    public static function parseGeolocationPoint($point){
        $tmp = explode(',', $point);
        if(sizeof($tmp) == 2) {
            return [
                'longitude' => $tmp[1],
                'latitude' => $tmp[0]
            ];
        }
        return [
            'longitude' => null,
            'latitude' => null
        ];
    }

    /*
        Convert Decimal Latitude & Longitude to Degrees, Minutes and Second
        http://www.beliefmedia.com/convert-decimal-latitude-longitude
    */
    private static function beliefmedia_dec_dms($dec) {

        $vars = explode(".", $dec);
        $deg = $vars[0];
        $tempma = '0.' . $vars[1];
        $tempma = $tempma * 3600;
        $min = floor($tempma / 60);
        $sec = $tempma - ($min * 60);

        return array('deg' => $deg, 'min' => $min, 'sec' => $sec);
    }

    /*
     *
        Convert Decimal Latitude & Longitude to Degrees, Minutes and Second
        http://www.beliefmedia.com/convert-decimal-latitude-longitude
        Requires: beliefmedia_dec_dms();
    */
    private static function convertDecToDegree($lat, $lng){
        if($lat && $lng) {
            $latpos = (strpos($lat, '-') !== false) ? 'S' : 'N';
            $lat = static::beliefmedia_dec_dms($lat);
            $lngpos = (strpos($lng, '-') !== false) ? 'W' : 'E';
            $lng = static::beliefmedia_dec_dms($lng);
            return $latpos . abs($lat['deg']) . '&deg;' . $lat['min'] . '&apos;' .
                $lat['sec'] . '&quot ' . $lngpos . abs($lng['deg']) . '&deg;' . $lng['min'] .
                '&apos;' . $lng['sec'] . '&quot';
        }
        return '-';
    }

    /*
        Converting Degrees, Minutes and Seconds to Decimal
        http://www.beliefmedia.com/convert-decimal-latitude-longitude
    */
    private static function beliefmedia_dms_dec($deg, $min, $sec, $round = 0) {
        $dec = $deg + ((($min * 60) + ($sec)) / 3600);
        if ($round != 0) $dec = round($dec, $round);
        return $dec;
        /* Usage */
        //echo beliefmedia_dms_dec('151', '12', '26.35');
    }

    public static function convertPointsToDegree($point){
        if($point) {
            $location = static::parseGeolocationPoint($point);
            return static::convertDecToDegree($location['latitude'], $location['longitude']);
        }
        return '-';
    }

    public static function projectImageAttributeTitle($title, $location){
        return $title.' ( location: '.static::convertPointsToDegree($location).' )';
    }
}

