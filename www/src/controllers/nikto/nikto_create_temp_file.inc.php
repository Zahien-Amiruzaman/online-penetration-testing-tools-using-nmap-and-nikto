<?php

function create_nikto_temp_file($targetUrl, $portNumber)
{
    check_nikto_path_exists();

    $output_file = tempnam(sys_get_temp_dir(), 'nikto_output');
    if ($output_file === false) {
        errorAlertWarning("Could not create temporary file!");
        return null;
    }

    $command = get_nikto_command($targetUrl, $portNumber, $output_file);
    $result = shell_exec($command);

    if ($result === null) {
        errorAlertWarning("Error executing Nikto scan!");
        unlink($output_file);
        return null;
    }

    $output = file_get_contents($output_file);
    if ($output === false) {
        errorAlertWarning("Error reading output file!");
        unlink($output_file);
        return null;
    }

    unlink($output_file); // Remove the temporary file
    return $output;
}