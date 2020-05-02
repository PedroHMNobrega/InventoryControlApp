<?php 
    class Painel {
        public static function redirect($url) {
            echo "<script>location.href='$url'</script>";
            die();
        }

        public static function loadPage() {
            if(isset($_GET['url'])) {
                $url = explode('/', $_GET['url']);
                if(file_exists('pages/'.$url[0].'.php')) 
                    include('pages/'.$url[0].'.php');
                else 
                    self::redirect(INCLUDE_PATH);
            } else {
                include('pages/home.php');
            }
        }

        public static function alert($tipo, $msg) {
            if($tipo == 'sucesso') 
                echo '<div class="alert a-sucesso"><i class="fas fa-check"></i>'.$msg.'</div>';
            else if($tipo == 'erro')
                echo '<div class="alert a-erro"><i class="fas fa-times"></i>'.$msg.'</div>';
            else if($tipo == 'atencao')
                echo '<div class="alert a-atencao"><i class="fas fa-exclamation-triangle"></i>'.$msg.'</div>';
            echo "<script>setTimeout(function() { $('.alert').fadeOut(); }, 3000);</script>";
        }

        public static function validImg($img) {
            $type = $img['type'];
            if($type == 'image/jpeg' || $type == 'image/jpg' || $type == 'image/png') 
                return true;
            return false;
        }

        public static function uploadFile($file) {
            $formato = explode('.', $file['name']);
            $file['name'] = uniqid().'.'.$formato[count($formato)-1];
            if(move_uploaded_file($file['tmp_name'], BASE_DIR.'/uploads/'.$file['name'])) 
                return $file['name'];
            return false;
        }

        public static function removeFile($file) {
            @unlink(BASE_DIR.'/uploads/'.$file);
        }
    }
?>