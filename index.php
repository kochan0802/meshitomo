<?php
session_start();
require('library.php');

if (isset ($_SESSION['id']) && isset($_SESSION['name'])){
    $id = $_SESSION['id'];
    $name = $_SESSION['name'];
    $picture = ''; 
}else{
    header('Location: login.php');
    exit();
}

$db = dbconnect();

//メッセージの投稿
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
    
    $stmt = $db->prepare('insert into posts (message, member_id) values(?,?)');
    if (!$stmt) {
        die($db->error);
    }
   
    $stmt->bind_param('si', $message, $id);
    $success = $stmt->execute();
    if(!$success){
        die($db->error);
    }
    header('Location: index.php');
    exit();

}

$name = $_SESSION['name'];

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ひとこと掲示板</title>

    <link rel="stylesheet" href="style.css"/>
</head>

<body>
<div id="wrap">
    <div id="head">
        <img src="API_homework/img/top-image.png" alt="メイン画像" width="750px" height="450px">
    </div>

<!-- MAP[START] -->
<div id="myMap" style='width:75%;height:70%;float:left;'></div>
    <div id="inputForm" style="display:none;"></div>
        <table>
            <tr>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td>行きたい場所</td>
                <td><input id="titleTbx" type="text" /></td>
            </tr>
            <tr>
                <td>詳細</td>
                <td><input id="descriptionTbx" type="text" /></td>
            </tr>
            <tr>
                <td colspan="2"><input type="button" value="Save" onclick="saveData()" style="float:right;" /></td>
            </tr>
        </table>
    </div>

    <!-- MAP[END] -->


    <div id="content">
        <div style="text-align: right"><a href="logout.php">ログアウト</a></div>
    
        <form action="" method="post">
            <dl>
                <dt><?php echo h($name); ?>さん、メッセージをどうぞ</dt>
                <dd>
                    <textarea name="message" cols="50" rows="5"></textarea>
                </dd>
            </dl>
            <div>
                <p>
                    <input type="submit" value="投稿する"/>
                </p>
            </div>
        </form>

        <?php 
        $stmt = $db->prepare('select p.id, p.member_id, p.message, p.created, m.name, m.picture from posts p, members m where m.id=p.member_id order by id desc');
        if (!$stmt) { 
            die($db->error);
        }
        $success = $stmt->execute();  
        if (!$success) {
            die($db->error);
        }

        $stmt->bind_result($id, $member_id, $message, $created, 
        $name, $picture);
        while($stmt->fetch()):
        
        ?>

        <div class="msg">
        <?php if ($picture): ?>            
            <img src="member_picture/<?php echo h($picture); ?>" width="48" height="48" alt=""/>
        <?php endif; ?>
            <p><?php echo h($message); ?><span class="name">（<?php echo h($name); ?>）</span></p>
            <p class="day"><a href="view.php?id=<?php echo h($id); ?>"><?php echo h ($created); ?></a>
            <?php if ($_SESSION['id'] === $member_id):
            ?>
                [<a href="delete.php?id=<? php echo h($id); ?>" style="color: #F33;">削除</a>]
            <?php endif; ?>
            </p>
        </div>
        <?php endwhile; ?>

<!--  JavaScript出力開始  -->

<script type="text/javascript">
 <script
        src='https://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=AmeAd0c1XNtHyF3KIliva7GcqLcXNLvzMe6qYVcgjA3IjmDerwVi0XjjllLaubrl'
        async defer></script>
    <script src="../js/BmapQuery.js"></script>
    <script>
        let map, infobox, currentPushpin;
        function GetMap() {
            map = new Microsoft.Maps.Map('#myMap', {});
            //Add a click event to the map.
            Microsoft.Maps.Events.addHandler(map, 'click', mapClicked);
            //Create an infobox, but hide it. We can reuse it for each pushpin.
            infobox = new Microsoft.Maps.Infobox(map.getCenter(), { visible: false });
            infobox.setMap(map);
        }
        function mapClicked(e) {
            //Create a pushpin.
            currentPushpin = new Microsoft.Maps.Pushpin(e.location);
            //Add a click event to the pushpin.
            Microsoft.Maps.Events.addHandler(currentPushpin, 'click', pushpinClicked);
            //Add the pushpin to the map.
            map.entities.push(currentPushpin);
            //Open up an input form here the user can enter in details for pushpin.
            document.getElementById('inputForm').style.display = '';
        }
        function saveData() {
            //Get the data from form and add it to the pushpin
            currentPushpin.metadata = {
                title: document.getElementById('titleTbx').value,
                description: document.getElementById('descriptionTbx').value,
            };
            //Optionally save this data somewhere (like a database or local storage).

            //Clear the fields in the form and then hide the form.
            document.getElementById('titleTbx').value = '';
            document.getElementById('descriptionTbx').value = '';
            document.getElementById('inputForm').style.display = 'none';
        }
        function pushpinClicked(e) {
            if (e.target.metadata) {
                infobox.setOptions({
                    location: e.target.getLocation(),
                    title: e.target.metadata.title,
                    description: e.target.metadata.description,
                    visible: true

                });


            }
        }

</script>


<!-- javascript 出力終了-->



    </div>
</div>
</body>

</html>