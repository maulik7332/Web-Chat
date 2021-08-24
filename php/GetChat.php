<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";

        $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_msg_id']);
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_msg_id']);
        $output ="";

        $sql = "SELECT * FROM messages 
                LEFT JOIN users ON users.unique_id = messages.outgoing_id
                WHERE (outgoing_id = {$outgoing_id} AND incoming_id = {$incoming_id})
                OR (outgoing_id = {$incoming_id} AND incoming_id = {$outgoing_id}) ORDER BY msg_id";
        $query = mysqli_query($conn, $sql);
        // if(isset($_GET['user_id'])){
            
        // }
        if($query){
                while($row = mysqli_fetch_assoc($query)){
                    if($row['outgoing_id'] === $outgoing_id){
                        $output .= '<div class="chat outgoing">
                                    <div class="details">
                                         <p>'. $row['msg'] .'</p>
                                    </div>
                                    </div>';
                    }else{
                        $output .= '<div class="chat incoming">
                                    <img src="php/images/'. $row['img'] .'" alt="">
                                    <div class="details">
                                        <p>'. $row['msg'] .'</p>
                                    </div>
                                    </div>';
                    }
                }
            
            
            echo $output;
        }else{
            $img_url = 'php/images/logo.png';
            echo "<img src='$img_url' height='500' width='700' opacity = '0.5'>";
            // echo "<img src='php/images/logo.png' >";

        }
        
    }else{
        header("../login.php");
    }

?>