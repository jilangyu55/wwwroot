<?php
//连接数据库
$conn=mysql_connect("localhost","root","root") or die("数据库服务器连接错误".mysql_error());

    mysql_select_db("tests") or die("数据库访问错误".mysql_error());

	//mysql_query("set character set utf8");

    mysql_query("set names utf8");