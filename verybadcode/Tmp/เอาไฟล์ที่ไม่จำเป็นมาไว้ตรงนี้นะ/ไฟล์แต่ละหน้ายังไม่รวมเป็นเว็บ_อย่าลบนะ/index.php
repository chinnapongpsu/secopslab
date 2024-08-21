<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>เว็บบอร์ด php : PhpScrip.Com</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" content="แจกสคริป Webboard Php ใช้งานง่าย ไม่ยุ่งยาก" />
<meta name="keywords" content="สคริปเว็บบอร์ด php, php webboard, free php board" />
<meta name="googlebot" content="index,follow"/>
<meta http-equiv="Content-Language" CONTENT="TH-TH">
<style type="text/css">
<!--
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
-->
</style></head>
<body>
<p>&nbsp;</p>
<p><a href="NewQuestion.php">ตั้งกระทู้ใหม่ !!</a>
<?
/*
 * Script Name: PHP Webboard
 * Version : 1.0
 * License : Free
 * Date : 24/02/2018
 * Web URI: http://phpscrip.com
 * Begin SourceCode : Thaicreate.com
 * Modify By : newaiman
 * Last Modify : 24/02/2018
 */
$objConnect = mysql_connect("localhost","db_user","db_password") or die("Error Connect to Database");
$objDB = mysql_select_db("db_name");
$strSQL = "SELECT * FROM webboard ";
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
$Num_Rows = mysql_num_rows($objQuery);

$Per_Page = 10;   // Per Page

$Page = $_GET["Page"];
if(!$_GET["Page"])
{
	$Page=1;
}

$Prev_Page = $Page-1;
$Next_Page = $Page+1;

$Page_Start = (($Per_Page*$Page)-$Per_Page);
if($Num_Rows<=$Per_Page)
{
	$Num_Pages =1;
}
else if(($Num_Rows % $Per_Page)==0)
{
	$Num_Pages =($Num_Rows/$Per_Page) ;
}
else
{
	$Num_Pages =($Num_Rows/$Per_Page)+1;
	$Num_Pages = (int)$Num_Pages;
}

$strSQL .=" order  by QuestionID DESC LIMIT $Page_Start , $Per_Page";
$objQuery  = mysql_query($strSQL);
?>
</p>
<table width="994" border="1">
  <tr>
    <th width="79" height="29" bgcolor="#FFE0C1"> <div align="center">กระทู้ที่</div></th>
    <th width="530" bgcolor="#E6FFE6"> <div align="center">หัวข้อ</div></th>
    <th width="122" bgcolor="#EAFFFF"> <div align="center">ชื่อผู้โพสท์</div></th>
    <th width="110" bgcolor="#EAFFFF"> <div align="center">วันที่โพสท์</div></th>
    <th width="44" bgcolor="#FFFFD5"> <div align="center">ดู</div></th>
    <th width="69" bgcolor="#FFFFD5"> <div align="center">ตอบกลับ</div></th>
  </tr>
<?
while($objResult = mysql_fetch_array($objQuery))
{
?>
  <tr>
    <td><div align="center"><?=$objResult["QuestionID"];?></div></td>
    <td><a href="ViewWebboard.php?QuestionID=<?=$objResult["QuestionID"];?>"><?=$objResult["Question"];?></a></td>
    <td><div align="center">
      <?=$objResult["Name"];?>
    </div></td>
    <td><div align="center"><?=$objResult["CreateDate"];?></div></td>
    <td align="right"><div align="center">
      <?=$objResult["View"];?>
    </div></td>
    <td align="right"><div align="center">
      <?=$objResult["Reply"];?>
    </div></td>
  </tr>
<?
}
?>
</table>

<br>
กระทู้ทั้งหมด <?= $Num_Rows;?> เรื่อง หน้าทั้งหมด : <?=$Num_Pages;?> หน้า :
<?
if($Prev_Page)
{
	echo " <a href='$_SERVER[SCRIPT_NAME]?Page=$Prev_Page'><< ก่อนหน้า</a> ";
}

for($i=1; $i<=$Num_Pages; $i++){
	if($i != $Page)
	{
		echo "[ <a href='$_SERVER[SCRIPT_NAME]?Page=$i'>$i</a> ]";
	}
	else
	{
		echo "<b> $i </b>";
	}
}
if($Page!=$Num_Pages)
{
	echo " <a href ='$_SERVER[SCRIPT_NAME]?Page=$Next_Page'>ถัดไป >></a> ";
}
mysql_close($objConnect);
?>
</body>
</html>