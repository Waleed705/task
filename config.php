<?php
function getBaseUrl() {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] === 443 ? "https://" : "http://";
    $host = $_SERVER['HTTP_HOST'];
    $documentRoot = str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT']));
    $scriptDir = str_replace('\\', '/', dirname(__FILE__));
    $projectRoot = str_replace($documentRoot, '', $scriptDir);
    return rtrim($protocol . $host . $projectRoot, '/');
}

define('HOME_URL', getBaseUrl());
?>