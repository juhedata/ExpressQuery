<?php

$key = '****************';  //您在聚合数据上申请的快递查询接口AppKey
$comUrl = "http://v.juhe.cn/exp/com?key=" . $key;
$com = file_get_contents($comUrl, 'rb');
$comData = json_decode($com, true);
//var_dump($comData);

if (isset($_POST['epressNumber'])) {
    $comNo = $_POST['com'];
    $expressNumber = $_POST['epressNumber'];
    $senderPhone = $_POST['senderPhone'];
    $receiverPhone = $_POST['receiverPhone'];

    $queryUrl = "http://v.juhe.cn/exp/index?com=" . $comNo . "&no=" . $expressNumber . "&senderPhone=" . $senderPhone . "&receiverPhone=" . $receiverPhone . "&key=" . $key;
    $result = file_get_contents($queryUrl, 'rb');
    $result = json_decode($result, true);
    var_dump($result);
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>快递查询</title>
</head>
<body>
<div>
    <h1>快递查询</h1>
    <form action="" method="post">
        <label>请选择快递名称：</label>
        <select name="com">
            <?php
            foreach ($comData['result'] as $k => $value) {
                ?>
                <option value="<?php echo $value['no']; ?>"><?php echo $value['com']; ?></option>
                <?php
            }
            ?>
        </select>
        <label>请输入快递单号：</label>
        <input type="text" name="epressNumber"/><br/>
        <h3>顺丰快递需填写寄件人或者收件人其中一个的手机号后四位</h3>
        <label>请输入寄件人手机号后四位：</label>
        <input type="text" name="senderPhone"/>
        <label>请输入收件人手机号后四位：</label>
        <input type="text" name="receiverPhone"/>
        <input type="submit" name="submit" value="提交"/>
    </form>

</div><?php
if (isset($result)) {
    foreach ($result['result']['list'] as $k => $value) {
        ?>
        <label>快递状态：<?php echo $value['datetime'] ?>&nbsp;&nbsp;&nbsp;<?php echo $value['remark'] ?></label><br/>
        <?php
    }
}
?>
</body>
</html>
