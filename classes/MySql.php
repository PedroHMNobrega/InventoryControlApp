<?php 
    class MySql {
        private static $pdo;
        public static function conect() {
            if(self::$pdo == null) {
                try {
                    self::$pdo = new PDO('mysql:host='.DATABASE['HOST'].'; 
                    dbname='.DATABASE['DATABASE'], DATABASE['USER'], 
                    DATABASE['PASSWORD'], [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]);
                    self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch(Exception $e) {
                    Painel::alert('erro', 'Erro ao Conectar Com o Banco de Dados');
                }
            }
            return self::$pdo;
        }
    }
?>