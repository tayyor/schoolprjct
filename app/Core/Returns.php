<?php

namespace App\Core;

/**
 * class used by other core classes to respond to returns
 */
class Returns{
    
    public static $validate_error = 400;
    public static $notfound_error = 404;
    public static $system_error = 501;
    public static $unauthorized_error = 401;
    public static $forbidden_error = 403;
    public static $ok_response = 200;
    public static $created_response = 201;

    public static function validationError($error){
        $format_error = $error;
        if(is_array($format_error)){
            $collect_v = collect($format_error)->first();
            
            if(is_array($collect_v)){
                $format_error = collect([collect($collect_v)->first()]);
            }
            else{
                $format_error = collect([$collect_v]);
            }
        }
        if(!is_array($format_error) && !is_string($error)){
            $format_error = $format_error->first()?$format_error->first():'Undetermined Error, Please try again.';
        }
        return [
            'code'=> static::$validate_error,
            'message'=>'Validation failed',
            'error'=> $format_error,
            'data'=>null
        ];
    }
    
    public static function notfoundError($error=[]){
        return [
            'code'=> static::$notfound_error,
            'message'=>'Resource you looking for not found',
            'error'=>$error,
            'data'=>null
        ];
    }
    
    public static function systemError($error='Reason for failure not specified, Please try again later.'){
        return [
            'code'=> static::$system_error,
            'message'=>'System failure',
            'error'=>$error,
            'data'=>null
        ];
    }
    
    public static function unAuthorized($error='Unauthorized'){
        return [
            'code'=> static::$unauthorized_error,
            'message'=>'You do not have enough priviledge to perform this',
            'error'=>$error,
            'data'=>null
        ];
    }
    
    public static function forbidden($error='Forbidden'){
        return [
            'code'=> static::$forbidden_error,
            'message'=>'You didnt provide enough credential(s) or data to successfully execute this',
            'error'=>$error,
            'data'=>null
        ];
    }

    public static function custom($code, $error='', $data=null){
        return [
            'code'=> $code,
            'message'=>'Custom Handled Response',
            'error'=>$error,
            'data'=>$data
        ];
    }

    public static function ajax($message, $error=null, $data=null){
        return response()->json([
            'message'=>$message,
            'error'=>$error,
            'data'=>$data
        ]);
    }
    
    public static function ok($data=[]){
        return [
            'code'=> static::$ok_response,
            'message'=>'Successful',
            'error'=>null,
            'data'=>$data
        ];
    }
    
    public static function created($data=[]){
        return [
            'code'=> static::$created_response,
            'message'=>'Successful',
            'error'=>null,
            'data'=>$data
        ];
    }
}

