<?php

namespace App\Helpers;

class Logger {
    const __ARQUIVO_LOG__   = __DIR__."/../../messages.log";
    private static $id      = null;
    private static $pid     = [];
    private static $openLog = null;
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
        date_default_timezone_set('America/Sao_Paulo');
        $pid                = self::generatePID();
        $logLevelString     = self::getLevelString($logLevel);
        $openLog            = self::getOpenLog();
        $data               = "[$logLevelString][".date("d/m/Y - H:i:s")."][$pid]";
        if ($openLog) {
            $data .= "[$openLog]";
        }
        $messageToRegister  = "$data - $message\n";
        file_put_contents(self::__ARQUIVO_LOG__, $messageToRegister, FILE_APPEND | LOCK_EX);
    }

    private static function getLevelString(int $logLevel): string 
    {
        $levels = [
            1 => "EMERG",
            4 => "ERROR",
            6 => "NOTICE"
        ];

        return $levels[$logLevel] ?? $logLevel;
    }

    private static function generatePID(): string 
    {
        $remoteAddr = sha1($_SERVER['REMOTE_ADDR'] ?? "DEV");
        $first      = substr($remoteAddr, 0, 5); 

        if (array_key_exists($first, self::$pid)) {
            return self::$pid[$first];
        }

        $last = substr($remoteAddr, -5);
        $hash = md5($first.".".$last.".".self::getID());
        self::$pid[$first] = $hash;
        return $hash;
    }

    private static function getID(): string 
    {
        if (is_null(self::$id)) {
            self::$id = uniqid();
        }

        return self::$id;
    }

    public static function getPID(): string 
    {
        $remoteAddr = sha1($_SERVER['REMOTE_ADDR']);
        $first      = substr($remoteAddr, 0, 5); 

        return self::$pid[$first] ?? self::generatePID();
    }

    public static function openLog(string $nome): void 
    {
        self::$openLog = $nome;
    }

    private static function getOpenLog(): ?string  
    {       
        return self::$openLog;
    }
}