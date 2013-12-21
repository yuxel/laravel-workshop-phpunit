<?php 

class FileLogger 
{
    public function log($msg) {
        sleep(3);
        file_put_contents("/tmp/dblog", $msg . " -" . time() . "\n", FILE_APPEND);
    }
}
