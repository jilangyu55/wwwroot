<?php
//请引入您的数据库配置文件
include('conn.php');
//引入第三方Excel插件
require_once './PHPExcel/Classes/PHPExcel.php';
require_once './PHPExcel/Classes/PHPExcel/IOFactory.php';
require_once './PHPExcel/Classes/PHPExcel/Reader/Excel5.php';

$objReader = PHPExcel_IOFactory::createREADER('excel2007');//获得对象
$excelpath = 'myexcel.xlsx';
//加载excel
$objPHPExcel = $objReader -> load($excelpath);
	$sheet 	= $objPHPExcel -> getSheet(0);
	$highestRow = $sheet->getHighestRow();//获得总行数
	$highestColumn = $sheet -> getHighestColumn();//获得总列数
//遍历excel中的内容
		for($j = 2;$j<=$highestRow;$j++){
			$str = "";
				//从A列开始遍历
				for($k = 'A';$k<=$highestColumn;$k++){
				$str .=$objPHPExcel -> getActiveSheet()->getCell("$k$j") -> getValue().'|*|';
			}
	$str = mb_convert_encoding($str,'UTF8','auto');//设置字符集
	$strs = explode("|*|",$str);
	//echo $str ."<br />";  //测试代码
		//将当前的内容插入到数据表中
		$sql = "insert into user (name,password) values('{$strs[0]}','{$strs[1]}','{$strs[2]}')";
		// echo $sql; //测试代码
			if(!mysql_query($sql,$conn)){
				echo 'excel err';
			}
}