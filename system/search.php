<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>搜索结果</title>
</head>
<body>

<!--表头-->
<h2 style="text-align: center">学生搜索结果</h2>
<table width="100%" border="1" >
    <tr>
        <th>ID</th>
        <th>姓名</th>
        <th>年龄</th>
        <th>性别</th>
        <th>班级</th>
        <th>身份</th>
        <th>密码</th>
        <th>操作</th>
    </tr>


<!--    数据库链接-->
    <?php
    //链接数据库
    require_once "fun.php";
    $fun = new fun;
    $fun->connect();



        $name=$_POST['name'];
        $type=$_POST['type'];



    //查询翻页配置

    $sql_s= "select count(*) as amount from student WHERE $type='$name'";
    $stm_s= $pdo->query($sql_s);
    $arr_s = $stm_s->fetch(PDO::FETCH_ASSOC);
    $amonut=$arr_s['amount'];
    $pagesize=10;
    $page=@$_GET['page'];
    if (empty($page)){
        $page=1;
    }
    $go=($page-1)*$pagesize;
    $end=$page*$pagesize;
    if ($amonut%$pagesize==0){
        $pagemount=$amonut/$pagesize;
    }else{
        $pagemount=intval($amonut/$pagesize)+1;
    }
    //查询翻页参数设置
    $page_string = "";
    if( $page == 1 ){
        $page_string .= '第一页|上一页|';
    }
    else{
        $page_string .= '<a href=?myid='.$_GET['myid'].'&page=1>第一页</a>|<a href=?myid='.$_GET['myid'].'&page='.($page-1).'>上一页</a>|';
    }
    if( ($page == $pagemount) || ($pagemount == 0) ){
        $page_string .= '下一页|尾页';
    }
    else{
        $page_string .= '<a href=?myid='.$_GET['myid'].'&page='.($page+1).'>下一页</a>|<a href=?myid='.$_GET['myid'].'&page='.$pagemount.'>尾页</a>';
    }

    echo "   <tr>$page_string</tr>|<a href='index_sup.php?myid=root'>返回</a>";






    //学生查询信息输出
    $sql="SELECT *FROM student WHERE  identity='student'&&$type='$name'  limit $go,$end  ";
    foreach ($pdo->query($sql)  as  $val){

        echo "<tr>
               <td>{$val['id']}</td>
               <td>$val[name]</td> 
               <td>$val[age]</td> 
               <td>$val[sex]</td> 
               <td>$val[class]</td> 
               <td>$val[identity]</td> 
               <td>$val[password]</td>
               <td><a href='javascript:doDel($val[id])'>删除</a>
                   <a href='use.php?id=$val[id]&myid=$_GET[myid]'>查看/修改</a> 
              </td>        
               </tr>";
    }

    ?>
</table>



</body>
</html>