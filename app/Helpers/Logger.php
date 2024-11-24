<?php

namespace App\Helpers;

class Logger {
    const __ARQUIVO_LOG__   = __DIR__."/../../messages.log";
    private static $pid     = null;

    /**
    * Registra log no arquivo messages.log
    * 
    * @param int Level do log {
    *  LOG_ERR,
    *  LOG_EMERG, 
    *  LOG_ALERT, 
    *  LOG_CRIT, 
    *  LOG_ERR, 
    *  LOG_WARNING, 
    *  LOG_NOTICE, 
    *  LOG_INFO, 
    *  LOG_DEBUG 
    * }
    * @param string Mensagem a ser regsitrada no log
    * 
    * @return void
    */
    public static function register(int $logLevel, string $message) {
        $pid                = self::generatePID();
        $logLevelString     = self::getLevelString($logLevel);
        $data               = "[$logLevelString][".date("d/m/Y - H:i:s")."][$pid]";
        $messageToRegister  = "$data - $message\n";
        file_put_contents(self::__ARQUIVO_LOG__, $messageToRegister, FILE_APPEND | LOCK_EX);
    }

    private static function getLevelString(int $logLevel): string 
    {
        $levels = [
            4 => "ERROR",
            6 => "NOTICE"
        ];

        return $levels[$logLevel] ?? "ERROR";
    }

    private static function generatePID(): string 
    {
        $remoteAddr = sha1($_SERVER['REMOTE_ADDR']);
        $first      = substr($remoteAddr, 0, 5); 
        $last       = substr($remoteAddr, -5);
    
        return md5($first.".".$last.".".self::getPID());
    }

    private static function getPID(): string 
    {
        if (is_null(self::$pid)) {
            self::$pid = uniqid();
        }

        return self::$pid;
    }
}