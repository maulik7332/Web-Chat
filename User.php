<?php 
    session_start();
    if(!isset($_SESSION['unique_id'])){
        header("location: LoginPage.php");
    }else{
        $outgoing_id = $_SESSION['unique_id'];
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div class="wrapper">
        <section class="users">
            <header>

                <?php 
                    include_once "php/config.php";
                     $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
                    if(mysqli_num_rows($sql) > 0){
                        $row = mysqli_fetch_assoc($sql);
                    }
                
                ?>


                <div class="content">
                   <img src="php/images/<?php echo $row['img'] ?>" alt="" srcset="">
                   <div class="details">
                       <span><?php echo $row['fname'] . " " . $row['lname'] ?></span>
                       <p> <?php echo $row['status'] ?> </p>
                   </div> 
                </div>
                <a href="php/logout.php?logout_id=<?php echo $row['unique_id'] ?>" class="logout">Logout</a>
            </header>
            <div class="search">
                <span class="text">Select an user to start chat</span>
                <input type="text" placeholder="Enter name to search...">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="users-list">
                
            
            </div>
        </section>
    </div>
    <div class="wrapper3" id="wrapper3">
        <div class="logo">
        </div>
    </div>
    <div class="wrapper2" id="wrapper2">
        <section class="chat-area">
            <!-- <script>
                function getParameterByName(name, url = window.location.href) {
                 name = name.replace(/[\[\]]/g, '\\$&');
                  var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
                        results = regex.exec(url);
                 if (!results) return null;
                 if (!results[2]) return '';
                return decodeURIComponent(results[2].replace(/\+/g, ' '));
                }
                 const abc = getParameterByName('user_id');
                
            </script> -->
            <header>
            
            <?php 
                    //  include_once "php/config.php";
                    
                        if(isset($_GET['user_id'])){
                            $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
                            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
                            if(mysqli_num_rows($sql) > 0){
                                $row = mysqli_fetch_assoc($sql);
                            }
                        }
                    
                  

                        
                ?>
                <i class="fas fa-arrow-left" ></i>
                <img src="php/images/<?php if(isset($_GET['user_id']))echo $row['img'];else echo "./logo2.jpg"?>" alt="" srcset="">
                   <div class="details">
                   <span><?php if(isset($_GET['user_id']))echo $row['fname'] . " " . $row['lname'];
                                else echo "" ?></span>
                       <p> <?php if(isset($_GET['user_id']))echo $row['status'] ?> </p>
                   </div> 
            </header>
            <div class="chat-box">
 
            </div>
            
            <form action="#" class="typing-area" autocomplete = "off">
            <input type="text" name="outgoing_msg_id" value="<?php echo $_SESSION['unique_id'] ?>" hidden>
                <input type="text" name="incoming_msg_id" value="<?php echo $user_id ?>" hidden>
                <input type="text" name="message" class="input-field" placeholder="Type a message here...">
                <button type = "submit"><i class="fab fa-telegram-plane"></i></button>
            </form>
        </section>
    </div>
  

    <script src="./Javascript/chat.js"></script>
    <script src="./Javascript/users.js"></script>
</body>
</html>