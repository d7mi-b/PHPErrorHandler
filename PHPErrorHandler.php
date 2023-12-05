<?php 
    // # REQUER THIS TO YOUR FILE FOR SHOW ERROR NICELY WAY -----------------------

    function handelFatalError() {
        $last_error = error_get_last();

        // fatal error
        if ($last_error && $last_error['type'] === E_ERROR) {
            $errorStr = substr($last_error['message'], 0, strpos($last_error['message'], " in ") ? strpos($last_error['message'], " in ") : null);
            renderError(E_ERROR, $errorStr, $last_error['file'], $last_error['line']);
        }
    } 

    function renderError($errno, $errstr, $errfile, $errline) {
        echo "
            <br>
            <table style='border: .1rem solid #181818;' cellpadding='5' border='1' >
                <thead style='background-color:". ($errno === 1 ? "red" : "gold") . "; color: " . ($errno === 1 ? "#eee" : "#181818") . ";'>
                    <tr>
                        <th colspan='4'>
                            $errstr
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>number</th>
                        <th>string</th>
                        <th>file</th>
                        <th>line</th>
                    </tr>
                    <tr>
                        <td>$errno</td>
                        <td>$errstr</td>
                        <td>$errfile</td>
                        <td>$errline</td>
                    </tr>
                </tbody>
            </table> <br>
        ";
    }

    ini_set('display_errors', 0);
    register_shutdown_function("handelFatalError");
    set_error_handler('renderError');
?>