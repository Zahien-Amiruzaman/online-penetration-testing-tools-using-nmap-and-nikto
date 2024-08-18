<?php

function get_nikto_command($targetUrl, $portNumber, $outputFile)
{
    $nikto_path = "../../bin/nikto/program/nikto.pl";
    $format = "xml";

    $command = "$nikto_path -h $targetUrl -p $portNumber -Format $format -o $outputFile";

    return $command;
}

