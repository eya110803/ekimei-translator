<?php

/**
 * 指定の配列から、指定の$target_keyが指定の$target_valueの要素の$keyを検索する。
 * @param array $array
 * @param string $target_key
 * @param string|boolean $target_value
 * @return キー（成功時）またはfalse（失敗時）|boolean
 */
function find_key_value($array, $target_key, $target_value) {
    foreach ($array as $key => $value) {
        if ($value[$target_key] === $target_value) {
            return $key;
        }
    }

    return false;
}


/**
 * API呼び出しにより情報を取得する。
 *
 * @return boolean|mixed
 */
function getData($url_base, $parameters)
{
    $url = $url_base;
    if (0 < count($parameters)) {
        $url = $url . '?';
        $count = 0;
        foreach ($parameters as $key => $value) {
            if (0 < $count) {
                $url = $url .'&';
            }
            $url = $url . $key . '=' . $value;
            $count++;
        }
    }

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,  'GET');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
//     curl_setopt($ch, CURLOPT_HEADER, 0);

    $response = curl_exec($ch);
    //echo ($response);

    if (false === $response) {
        $data = false;

        //echo ('curl_errno:'.curl_errno($ch));
        //echo ('\n');
        //echo ('curl_error:'.curl_error($ch));
    } else {
        $data = json_decode($response, true);
    }

    curl_close($ch);
    return $data;
}

/**
 * API呼び出しにより情報を取得する。
 *
 * @return boolean|mixed
 */
function getOdptData($api, $parameters)
{
    return getData("https://api-tokyochallenge.odpt.org/api/v4/$api", $parameters);
}

