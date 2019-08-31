<?php
// 未定義
define("NOT_FOUND", "(Not found.)");

// データの種別タイトル：
define("DATE_TITLE",                "データ生成時刻");
define("RAIL_WAY_TITLE",            "路線情報");
define("STATION_TITLE",             "駅情報");
define("TRAIN_TITLE",               "列車情報");
define("TRAIN_INFORMATION_TITLE",   "列車運行情報");

// データの種別：
define("DATE",              "dc:date");                 // データ生成時刻
define("TRAIN",             "odpt:Train");              // 列車情報
define("TRAIN_INFORMATION", "odpt:TrainInformation");   // 列車運行情報
define("RAIL_WAY",          "odpt:Railway");            // 路線情報
define("STATION",           "odpt:Station");            // 駅情報
define("STATION_CODE",      "odpt:stationCode");        // 駅ナンバリング
define("OPERATOR",          "odpt:Operator");           // 運行会社情報

// 東京公共交通オープンデータチャレンジ アクセストークン（consumerKey）
define("ACL_CONSUMERKEY",   "YOUR_ACL_CONSUMERKEY");

// Google Map API Key
define("API_KEY",           "YOUR_API_KEY");
