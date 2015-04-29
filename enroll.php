<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>註冊頁面</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/enroll.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  <script type="text/javascript" src="chrome-extension://ccbdoklfbpcifppcfahmmpmbkfdjjccm/js/injected.js"></script></head>

  <body>
	<?php session_start(); ?>
	<!--上方語法為啟用session，此語法要放在網頁最前方-->
    <div class="container">

      <form class="form-signin" method="POST" action="login.php">
        <a href="index.html"><img src="img/logo.png"></a>

        <label for="inputEmail" class="sr-only">Email</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="">

        <button class="btn btn-lg btn-primary btn-block" type="submit">申請帳號</button>
      </form>
		<a class="btn btn-lg btn-primary btn-block btn-local" href="login.html">會員登入</a>
    </div> <!-- /container -->
	<?php
		//連接資料庫
		//只要此頁面上有用到連接MySQL就要include它
		//
		if(isset($_POST['account'])&& isset($_POST['passwd'])){
			$host="localhost";
			$db_user="root";
			$db_pass="krnick";
			$db_name="test";
			$timezone="Asia/Taipei";
			//資料庫設定
			//資料庫位置
			$db_server = "localhost";
			//資料庫名稱
			$db_name = "test";
			//資料庫管理者帳號
			$db_user = "root";
			//資料庫管理者密碼
			$db_passwd = "krnick";
			//對資料庫連線
			$link=mysqli_connect($db_server,$db_user,$db_passwd,$db_name);

			date_default_timezone_set($timezone);
			$account = $_POST['account'];
			$passwd = $_POST['passwd'];
			//搜尋資料庫資料
			$sql = "SELECT distinct * FROM name where account = '$account'";
			#$sql = "SELECT * FROM name ";
			$result = mysqli_query($link,$sql);

			while($row=mysqli_fetch_assoc($result)){
			//判斷帳號與密碼是否為空白
			//以及mysql資料庫裡是否有這個會員
				if($row['password']== $passwd){
			    	    //將帳號寫入session，方便驗證使用者身份
			        	$_SESSION['username'] = $account;
			        	echo '登入成功!';
			        	#echo '<meta http-equiv=REFRESH CONTENT=1;url=member.php>';
				}else{
			       	echo '登入失敗!';
			        #echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
				}
			}
		}
		?>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>

  </body>
</html>




