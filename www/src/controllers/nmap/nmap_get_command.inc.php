<?php

function get_nmap_command($targetIPUrl, $scanType, $targetSubnets)
{
    $commandBase = "../../bin/nmap/bin/nmap -oX - $targetIPUrl";

    switch ($scanType) {
        case 'Port':
            return $commandBase . ' -Pn';

        case 'Service':
            return $commandBase . ' -sV';

        case 'Hosts':
            return $commandBase . '/' . $targetSubnets . ' -sn';
    }
}

