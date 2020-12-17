<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(isset($_FILES["xmlfile"]) && $_FILES["xmlfile"]["error"] == 0)
    {
        $xmlfile = $_FILES["xmlfile"]["tmp_name"];
        $filename = $_FILES["xmlfile"]["name"];

        $xml = new DOMDocument();
        $xml->load($xmlfile);

        if(!$xml->schemaValidate("SCHEMA_FILES/emp.xsd"))
        {
            print '<b>Errors Found!</b><br>';
            libxml_use_internal_errors(true);
            libxml_display_errors();
        }
        else
        {
            echo "The XML file <b>".$filename."</b> is Validated.";
        }
    }
    else
    {
        echo "Please Select a Proper XML file to check.";
    }
}

function libxml_display_error($error)
{
    $return = "<br/>\n";
    switch ($error->level) {
        case LIBXML_ERR_WARNING:
            $return .= "<b>Warning $error->code</b>: ";
            break;
        case LIBXML_ERR_ERROR:
            $return .= "<b>Error $error->code</b>: ";
            break;
        case LIBXML_ERR_FATAL:
            $return .= "<b>Fatal Error $error->code</b>: ";
            break;
    }
    $return .= trim($error->message);
    if ($error->file) {
        $return .= " in <b>$error->file</b>";
    }
    $return .= " on line <b>$error->line</b>\n";

    return $return;
}

function libxml_display_errors()
{
    $errors = libxml_get_errors();
    foreach ($errors as $error) {
        print libxml_display_error($error);
    }
    libxml_clear_errors();
}

?>