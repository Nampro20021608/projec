<?php
   define("DB_SERVER","localhost");
   define("DB_USER","root");
   define("DB_PASSWORD","");
   define("DB_NAME","pascal_imitation_jewelry");

   function db_connect(){
       $connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME);
       return $connection;
   }

    $db = db_connect();

    function db_disconnect(){
        if(isset($connection)){
            mysqli_close($connection);
        } 
    }


    function confirm_query_result($result){
        global $db;
        if(!$result){
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }else{
            return $result;
        }
    }

    function check_login($username,$password){
        global $db;

        $sql = "SELECT ten_tai_khoan,mat_khau  FROM `quan_tri_vien` ";
        $sql .= "WHERE ten_tai_khoan ='" . $username . "'";
        
        $result = mysqli_query($db, $sql);
        if(mysqli_num_rows($result)){
            $log = mysqli_fetch_assoc($result);
            if($log['ten_tai_khoan'] = $username && $log['mat_khau'] = $password){
                return true;
            }else
                return false;
        }else
            return false;
            
    }


    // san pham
    function find_all_product(){
        global $db;
      
        $sql = "SELECT s.ma_san_pham , s.ten_sp , d.ten_danh_muc , t.ten_thuong_hieu , s.gia , s.soluong , s.hinh_anh , s.xuat_su , s.thuoc_tinh FROM san_pham AS s ";
        $sql .= "JOIN danh_muc AS d ON s.ma_danh_muc = d.ma_danh_muc ";
        $sql .= "JOIN thuong_hieu AS t ON s.ma_thuong_hieu = t.ma_thuong_hieu ";
        $result = mysqli_query($db, $sql); 
        return $result; 
    }
    function find_product_by_id($ma_san_pham){
        global $db;

        $sql = "SELECT s.ma_san_pham , s.ten_sp , d.ten_danh_muc , t.ten_thuong_hieu , s.gia , s.soluong , s.hinh_anh , s.xuat_su , s.thuoc_tinh FROM san_pham AS s ";
        $sql .= "JOIN danh_muc AS d ON s.ma_danh_muc = d.ma_danh_muc ";
        $sql .= "JOIN thuong_hieu AS t ON s.ma_thuong_hieu = t.ma_thuong_hieu ";
        $sql .= "WHERE ma_san_pham ='". $ma_san_pham  ."'";
        $result = mysqli_query($db, $sql);
        $san_pham = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $san_pham;
    }
    

    function insert_product($product){
        global $db;

        $sql = "INSERT INTO `san_pham` ";
        $sql .= "(ma_san_pham,ten_sp,ma_danh_muc,ma_thuong_hieu,gia,soluong,hinh_anh,thuoc_tinh,xuat_su) ";
        $sql .= "VALUES (";
        $sql .= "'" . $product['ma_san_pham'] . "',"; 
        $sql .= "'" . $product['ten_san_pham'] . "',";
        $sql .= "'" . $product['ma_danh_muc'] . "',";
        $sql .= "'" . $product['ma_thuong_hieu'] . "',"; 
        $sql .= "'" . $product['gia'] . "',";
        $sql .= "'" . $product['soluong'] . "',";
        $sql .= "'" . $product['hinh_anh'] . "',"; 
        $sql .= "'" . $product['thuoc_tinh'] . "',";
        $sql .= "'" . $product['xuat_su'] . "'";
        $sql .= ")";
        $result = mysqli_query($db, $sql);

        return confirm_query_result($result);
    }

    
    function update_product($product) {
        global $db;
    
        $sql = "UPDATE `san_pham` SET ";
        $sql .= "ten_sp='" . $product['ten_sp'] . "', ";
        $sql .= "ma_danh_muc='" . $product['ma_danh_muc'] . "', ";
        $sql .= "ma_thuong_hieu='" . $product['ma_thuong_hieu'] . "', ";
        $sql .= "gia='" . $product['gia'] . "', ";
        $sql .= "soluong='" . $product['soluong'] . "', ";
        $sql .= "hinh_anh='" . $product['hinh_anh'] . "', ";
        $sql .= "thuoc_tinh='" . $product['thuoc_tinh'] . "', ";
        $sql .= "xuat_su='" . $product['xuat_su'] . "' ";
        $sql .= "WHERE ma_san_pham='" . $product['ma_san_pham'] . "' ";
        $sql .= "LIMIT 1";
    
        $result = mysqli_query($db, $sql);
        
        return confirm_query_result($result);
    }

    function delete_product($ma_san_pham){
        global $db;

        $sql = "DELETE FROM `san_pham` ";
        $sql .= "WHERE ma_san_pham='" . $ma_san_pham . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);

        return confirm_query_result($result);
    }

    // danh muc
    
    function insert_danhmuc($danhmuc) {
        global $db;
    
        $sql = "INSERT INTO danh_muc ";
        $sql .= "(ten_danh_muc) ";
        $sql .= "VALUES (";
        $sql .= "'" . $danhmuc['name'] . "'";//be careful of single quotes
    
        $sql .= ")";
        $result = mysqli_query($db, $sql);
        
        return confirm_query_result($result);
    }

    function find_all_danh_muc(){
        global $db;

        $sql = "SELECT * FROM danh_muc ";
        $sql .= "ORDER BY ten_danh_muc";
        //echo $sql;
        $result = mysqli_query($db, $sql); 
        return $result;
        return confirm_query_result($result);
    }


    function find_danhmuc_by_id($id){
        global $db;
        $sql = "SELECT * FROM danh_muc ";
        $sql .= "WHERE ma_danh_muc='" . $id . "'";

        $result = mysqli_query($db,$sql);
        confirm_query_result($result);

        $danhmuc = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $danhmuc;
    }

    function update_danhmuc($danhmuc) {
        global $db;

        $sql = "UPDATE danh_muc SET ";
        
        $sql .= "ten_danh_muc='" . $danhmuc['ten_danh_muc'] . "'";
        $sql .= "WHERE ma_danh_muc='" . $danhmuc['ma_danh_muc'] . "' ";
        $sql .= "LIMIT 1"; // chi sua toi da 1 dong

        $result = mysqli_query($db, $sql);
        return confirm_query_result($result);
    }

    function delete_danhmuc($id) {
        global $db;
        $sql = "DELETE FROM danh_muc ";
        $sql .= "WHERE ma_danh_muc='" . $id . "' ";
        $sql .= "LIMIT 1";

        $result = mysqli_query($db,$sql);
        return confirm_query_result($result);
    }

    //thuong hieu
    function insert_thuonghieu($thuonghieu) {
        global $db;
    
        $sql = "INSERT INTO thuong_hieu ";
        $sql .= "(ten_thuong_hieu,dia_chi,logo) ";
        $sql .= "VALUES (";
        $sql .= "'" . $thuonghieu['name'] . "',";//be careful of single quotes
        $sql .= "'" . $thuonghieu['adress'] . "',";
        $sql .= "'" . $thuonghieu['logo'] . "'";//be careful of single quotes
        $sql .= ")";
        $result = mysqli_query($db, $sql);
        
        return confirm_query_result($result);
    }


    function find_all_thuong_hieu(){
        global $db;
    
        $sql = "SELECT * FROM thuong_hieu ";
        $sql .= "ORDER BY ten_thuong_hieu";
        //echo $sql;
        $result = mysqli_query($db, $sql); 
        return $result;
        return confirm_query_result($result);
    }

    
    function find_thuonghieu_by_id($id){
        global $db;
        $sql = "SELECT * FROM thuong_hieu ";
        $sql .= "WHERE ma_thuong_hieu='" . $id . "'";
    
        $result = mysqli_query($db,$sql);
        confirm_query_result($result);
    
        $thuonghieu = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $thuonghieu;
    }

    function update_thuonghieu($thuonghieu) {
        global $db;
    
        $sql = "UPDATE thuong_hieu SET ";
        $sql .= "ten_thuong_hieu='" . $thuonghieu['ten_thuong_hieu'] . "', ";
        $sql .= "dia_chi='" . $thuonghieu['dia_chi'] . "', ";
        $sql .= "logo='" . $thuonghieu['logo'] . "' ";
        $sql .= "WHERE ma_thuong_hieu='" . $thuonghieu['ma_thuong_hieu'] . "' ";
        $sql .= "LIMIT 1"; // chi sua toi da 1 dong
    
        $result = mysqli_query($db, $sql);
        return confirm_query_result($result);
    }
    
    function delete_thuonghieu($id) {
        global $db;
        $sql = "DELETE FROM thuong_hieu ";
        $sql .= "WHERE ma_thuong_hieu='" . $id . "' ";
        $sql .= "LIMIT 1";
    
        $result = mysqli_query($db,$sql);
        return confirm_query_result($result);
    }

    //feedback


    function insert_feedback($feedback) {
        global $db;
    
        $sql = "INSERT INTO feedback ";
        $sql .= "(ten_khach_hang,noi_dung,ma_san_pham) ";
        $sql .= "VALUES (";
        $sql .= "'" . $feedback['name'] . "',";//be careful of single quotes
        $sql .= "'" . $feedback['nd'] . "',";
        $sql .= "'" . $feedback['san_pham'] . "'";//be careful of single quotes
        $sql .= ")";
        $result = mysqli_query($db, $sql);
        
        return confirm_query_result($result);
    }


    function find_all_feedback(){
        global $db;
    
        $sql = "SELECT * FROM feedback ";
        $sql .= "ORDER BY ten_khach_hang";
        //echo $sql;
        $result = mysqli_query($db, $sql); 
        return $result;
        return confirm_query_result($result);
    }

    
    function find_feedback_by_id($id){
        global $db;
        $sql = "SELECT * FROM feedback ";
        $sql .= "WHERE ma_feedback='" . $id . "'";
    
        $result = mysqli_query($db,$sql);
        confirm_query_result($result);
    
        $feedback = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $feedback;
    }

    function update_feedback($feedback) {
        global $db;
    
        $sql = "UPDATE feedback SET ";
        $sql .= "ten_khach_hang='" . $feedback['ten_khach_hang'] . "', ";
        $sql .= "noi_dung='" . $feedback['noi_dung'] . "', ";
        $sql .= "ma_san_pham='" . $feedback['ma_san_pham'] . "' ";
        $sql .= "WHERE ma_feedback='" . $feedback['ma_feedback'] . "' ";
        $sql .= "LIMIT 1"; // chi sua toi da 1 dong
    
        $result = mysqli_query($db, $sql);
        return confirm_query_result($result);
    }
    
    function delete_feedback($id) {
        global $db;
        $sql = "DELETE FROM feedback ";
        $sql .= "WHERE ma_feedback='" . $id . "' ";
        $sql .= "LIMIT 1";
    
        $result = mysqli_query($db,$sql);
        return confirm_query_result($result);
    }


?>