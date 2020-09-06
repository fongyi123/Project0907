<?php
require_once("connDB.php");
session_start();
if (isset($_SESSION["meaccount"])) {
  $meaccount = $_SESSION["meaccount"];
} else {
  if (!isset($_SESSION["maccount"])) {
    header("Location: login.php");
    exit();
  }
}
if (isset($_GET["gopro"])) {
  header("Location: meproduct.php");
}
if (isset($_GET["cartok"])) {
  header("Location: orders.php");
}
if (isset($_GET["deletenew"])) {
  $deleten = $_GET["deletenew"];

  $sqldelete = "DELETE  FROM cart WHERE prid = '$deleten' ";
  mysqli_query($link, $sqldelete);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
  <style>
    body {
      background-color: lightblue;
    }

    table {
      border-collapse: collapse;
      width: 100%;
    }

    th,
    td {
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2
    }

    th {
      background-color: #4CAF50;

    }
  </style>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Lag - Member Page</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

</head>

<body style="background:url('./img/bookindex.jpg')round">
  <h1 align="center">線上購書商城</h1>
  <form id="form1" name="form1" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">

    <div align="center" bgcolor="#CCCCCC" style="background-color:SlateBlue;">
      <font color="#FFFFFF"><?= "歡迎 " . $meaccount ."  進入購物車" ?></font>
    </div>
    <div align="center" bgcolor="#CCCCCC"><a href="index.php">回首頁</a></div>
    <div align="center" bgcolor="#CCCCCC">
      <button type="submit" name="cartok" id="gocart" class="btn btn-success">送出訂單</button>
    </div>
    <div style="width:auto;height:600px;">
      <div style="width:auto;height:600px;text-align:center;margin:0 auto;">
        <?php
        $link = @mysqli_connect("localhost", "root", "root", "shopping", 8889) or die(mysqli_connect_error());
        $result = mysqli_query($link, "set names utf8");
        $meaccount = $_SESSION["meaccount"];
        $sqlsecret = "SELECT * from cart";
        $result = mysqli_query($link, $sqlsecret);

        $total_records = mysqli_num_rows($result);  // 取得記錄數

        // echo ($total_records);
        ?>


        <table border="1">
          <tr>
            <td>商品編號</td>
            <td>商品名稱</td>
            <td>商品價格</td>
            <td>購買數量</td>
            <td>商品總額</td>
            <td>商品描述</td>
            <td>商品圖片</td>
            <td>編輯功能</td>

          </tr>
          <?php
          while ($row = mysqli_fetch_assoc($result)) {

          ?>
            <tr>
              <td>
                <?php echo $row['prid'];   ?>
              </td>
              <td>
                <?php echo $row['prname'];   ?>
              </td>
              <td>
                <input type="text" name="prprice" style="background-color: transparent;" id="prprice" class="form-control" placeholder="0" value="<?php echo $row['prprice']; ?>" onfocus="this.blur()" />
              </td>
              <td>
                <span class="input-group">
                  <button type="submit" name="caquantityadd" id="caquantityadd" value="<?php echo $row['prid'] ?>" class="input-group-addon">+</button>
                  <input type="text" name="caquantity" id="caquantity" class="form-control" placeholder="0" value="0" />
                  <button type="submit" name="caquantityr" id="caquantityr" value="<?php echo $row['prid'] ?>">-</button>
                </span>
              </td>

              <td>
                <input type="text" name="catotal" style="background-color: transparent;" id="catotal" class="form-control" placeholder="0" value="0" onfocus="this.blur()" />
              </td>
              <td>
                <?php echo $row['prdescript']; ?>
              </td>
              <td>
                <img id=<?php echo $row['primg']; ?> src="./img/<?php echo $row['primg']; ?>" width="10%" height="10%">
              </td>
              <td>
                <button type="submit" name="gopro" id="gocart" class="btn btn-info">繼續購物</button>
                <button type="submit" name="deletenew" id="deletenew" class="btn btn-danger" value="<?php echo $row['prid'] ?>">刪除商品</button>
                <?php
                ?>
              </td>
            </tr>
          <?php    }   ?>
        </table>
      </div>
    </div>
    
  </form>
  
</body>

</html>