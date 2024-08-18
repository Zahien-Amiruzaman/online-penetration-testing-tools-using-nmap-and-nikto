<?php

/**
 * * check if the user input is a valid ip address and domain name
 * * if not, return false
 */
function is_valid_target($targetIPUrl)
{
    $validIP = preg_match('/^(?:[0-9]{1,3}\.){3}[0-9]{1,3}$/', $targetIPUrl);
    $validDomain = preg_match('/^(([a-zA-Z0-9\-])+\.)+[a-zA-Z]{2,}$/', $targetIPUrl);
    $validCIDR = preg_match('/^(?:[0-9]{1,3}\.){3}[0-9]{1,3}\/[0-9]{1,2}$/', $targetIPUrl);

    // return $validIP || $validDomain && strpos($targetIPUrl, ' ') === false;
    return ($validIP || $validDomain || $validCIDR) && strpos($targetIPUrl, ' ') === false;
}

/**
 * * check if the user choose the scan type or not
 */
function is_valid_scan_type($scanType)
{
    return in_array($scanType, ['Port', 'Service', 'Hosts']);
}

/**
 * * check if the user enter the valid subnet
 * * must be in int
 * * range from 0 to 32 only
 */
function is_valid_subnet_mask($targetSubnets)
{
    if (!is_int($targetSubnets) || $targetSubnets < 0 || $targetSubnets > 32) {
        return false;
    }

    return true;
}