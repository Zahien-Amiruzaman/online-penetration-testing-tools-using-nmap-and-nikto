<?php

function check_nikto_path_exists()
{
    $nikto_path = "../../bin/nikto/program/nikto.pl";

    if (!file_exists($nikto_path)) {
        errorAlertWarning("Could not find or execute Nikto binary!");
        return false;
    }

    return true;
}

function is_valid_target($targetUrl)
{
    $validIP = preg_match('/^(?:[0-9]{1,3}\.){3}[0-9]{1,3}$/', $targetUrl);
    $validDomain = preg_match('/^(([a-zA-Z0-9\-])+\.)+[a-zA-Z]{2,}$/', $targetUrl);

    return $validIP || $validDomain && strpos($targetUrl, ' ') === false;
}

function is_port_empty($port)
{
    if (empty($port)) {
        return true;
    }
}