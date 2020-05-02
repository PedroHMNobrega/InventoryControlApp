<?php 
    class DataBase {
        public static function adicionar($post, $tbName) {
            $query = "INSERT INTO `$tbName` VALUES (null";
            foreach($post as $name => $value) {
                if($name == 'acao') continue;
                $query .= ', ?';
                $itens[] = $value;
            }
            $query .= ')';
            $sql = MySql::conect()->prepare($query);
            if($sql->execute($itens)) return true;
            return false;
        }

        public static function remover($id, $tbName) {
            $sql = MySql::conect()->prepare("DELETE FROM `$tbName` WHERE id = ?");
            if($sql->execute([$id])) return true;
            return false;
        }

        public static function editar($post, $id, $tbName) {
            $query = "UPDATE `$tbName` SET ";
            foreach($post as $name => $value) {
                if($name == 'acao') continue;
                $query .= $name.' = ?,';
                $itens[] = $value;
            }
            $query = rtrim($query, ',');
            $query .= " WHERE id = ?";
            $itens[] = $id;
            $sql = MySql::conect()->prepare($query);
            if($sql->execute($itens)) return true;
            return false;
        }

        public static function select($id, $tbName, $crit = "id") {
            $sql = MySql::conect()->prepare("SELECT * FROM `$tbName` WHERE $crit = ?");
            $sql->execute([$id]);
            return $sql->fetch();
        }

        public static function listIten($tbName, $order = 'id', $start = null, $num = null) {
            if($start == null && $num == null) 
                $sql = MySql::conect()->prepare("SELECT * FROM `$tbName` ORDER BY $order");
            else
                $sql = MySql::conect()->prepare("SELECT * FROM `$tbName` ORDER BY $order LIMIT $start, $num");
            $sql->execute();
            return $sql->fetchAll();
        }
    }
?>