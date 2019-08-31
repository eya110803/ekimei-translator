<?php
require_once 'conf/define.php';
require_once 'common.php';

$msg = "";
$stationCode = "";
$stationTitleEn = "";
$stationTitleJa = "";
$railWayEn = "";
$railWayJa = "";
$operatorTitleEn = "";
$operatorTitleJa = "";

if(isset($_POST['stationCode'])){
    $stationCode = $_POST['stationCode'];

    // ①駅名
    // API呼び出しパラメータ：
    $parameters = array(
        'acl:consumerKey'   => ACL_CONSUMERKEY
        , STATION_CODE      => $stationCode
    );

    // データの種別：
    $api = STATION;

    // API呼び出しにより情報を取得する。
    $data = getOdptData($api, $parameters);

    if (0 < count($data)) {
        $stationTitleEn = $data[0]['odpt:stationTitle']['en'];
        $stationTitleJa = $data[0]['odpt:stationTitle']['ja'];

        // ②路線名
        // API呼び出しパラメータ：
        $parameters = array(
            'acl:consumerKey'   => ACL_CONSUMERKEY
            , 'owl:sameAs'      => $data[0]['odpt:railway']
        );

        // データの種別：
        $api = RAIL_WAY;

        // API呼び出しにより情報を取得する。
        $data = getOdptData($api, $parameters);

        if (0 < count($data)) {
            $railWayEn = $data[0]['odpt:railwayTitle']['en'];
            $railWayJa = $data[0]['odpt:railwayTitle']['ja'];


            // ③事業者名称
            // API呼び出しパラメータ：
            $parameters = array(
                'acl:consumerKey'   => ACL_CONSUMERKEY
                , 'owl:sameAs'      => $data[0]['odpt:operator']
            );

            // データの種別：
            $api = OPERATOR;

            // API呼び出しにより情報を取得する。
            $data = getOdptData($api, $parameters);

            if (0 < count($data)) {
                $operatorTitleEn = $data[0]['odpt:operatorTitle']['en'];
                $operatorTitleJa = $data[0]['odpt:operatorTitle']['ja'];
            }

        }
    }
    else if (!empty($stationCode)){
        $msg = "\"{$stationCode}\" is not found.";
    }
}
?>


<!DOCTYPE html>
<html>

<title>EKI-MEI Translator</title>

<body>
	<form action="index.php" method="post">
This is 'EKI-MEI Translator'.<br>
<br>
Please enter station code.<br>
		<label for="stationCode">Station code:</label>
		<input id="stationCode" name="stationCode" type="text" value="<?= $stationCode ?>">
（ex: G01）<img src="img/G01.png" alt="G01" title="東京メトロ 銀座線 渋谷">
<br>
	<input type="submit" value="submit">
	<br>
	<br>

Result:<br>
<?= $msg ?>

		<table>
		<tr>
		<th></th>
		<th>English</th>
		<th></th>
		<th>日本語</th>
		</tr>
		<tbody>
    		<tr>
    		<td>
    			<label for="stationCodeJa">station name:</label>
			</td>
    		<td>
    			<input name="stationTitleEn" type="text" readonly="readonly" disabled="disabled" value="<?= $stationTitleEn ?>">
    		</td>
    		<td>
    			<label for="stationCodeJa">駅名（EKI-MEI）:</label>
			</td>
    		<td>
    			<input name="stationTitleJa" type="text" readonly="readonly" disabled="disabled" value="<?= $stationTitleJa ?>">
    		</td>
    		</tr>
    		<tr>
    		<td>
    			<label for="stationCodeJa">railway name:</label>
			</td>
    		<td>
    			<input name="railWayEn" type="text" readonly="readonly" disabled="disabled" value="<?= $railWayEn ?>">
    		</td>
    		<td>
    			<label for="stationCodeJa">路線名（ROSEN-MEI）:</label>
			</td>
    		<td>
    			<input name="railWayJa" type="text" readonly="readonly" disabled="disabled" value="<?= $railWayJa ?>">
    		</td>
    		</tr>
    		<tr>
    		<td>
    			<label for="stationCodeJa">railway operator name:</label>
			</td>
    		<td>
    			<input name="operatorTitleEn" type="text" readonly="readonly" disabled="disabled" value="<?= $operatorTitleEn ?>">
    		</td>
    		<td>
    			<label for="stationCodeJa">
    			鉄道事業者名<br>
    			（TETSUDO-JIGYOSYA-MEI）:</label>
			</td>
    		<td>
    			<input name="operatorTitleJa" type="text" readonly="readonly" disabled="disabled" value="<?= $operatorTitleJa ?>">
    		</td>
    		</tr>
		</tbody>
		</table>
	</form>

<br>
<br>
お知らせ：<br>
本アプリケーション等が利用する公共交通データは、<a href="https://tokyochallenge.odpt.org/" target="_blank">東京公共交通オープンデータチャレンジ</a>において提供されるものです。
公共交通事業者により提供されたデータを元にしていますが、必ずしも正確・完全なものとは限りません。本アプリケーションの表示内容について、公共交通事業者への直接の問合せは行わないでください。
本アプリケーションに関するお問い合わせは、以下のメールアドレスにお願いします。<br>
	<a href="mailto:eya110803@gmail.com?subject=EKI-MEI Translatorについての問い合わせ&amp;body=ご記入ください">メールはこちらへ</a>
</body>
</html>

