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

        public static function adicionarOrder($post, $tbName) {
            $query = "INSERT INTO `$tbName` VALUES (null";
            foreach($post as $name => $value) {
                if($name == 'acao') continue;
                $query .= ', ?';
                $itens[] = $value;
            }
            $query .= ', ?';
            $order_id = MySql::conect()->prepare("SELECT MAX(order_id) FROM `$tbName`");
            $order_id->execute();
            $order_id = $order_id->fetchColumn();
            $itens[] = $order_id+1;
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

        public static function query($query, $values = null, $type = 'all') {
            $sql = MySql::conect()->prepare($query);
            if($values != null) $sql->execute($values);
            else $sql->execute();
            if($type == 'all') return $sql->fetchAll();
            else return $sql->fetch();
        }
    }
?>