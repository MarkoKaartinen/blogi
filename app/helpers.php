<?php

if(!function_exists('mrkCdata')){
    function mrkCdata(string $data): string
    {
        // See https://www.w3.org/TR/REC-xml/#dt-cdsection
        $replace = [
            '<!CDATA[' => '', // CDATA cannot be nested.
            ']]>' => ']]&gt;', // CDEnd needs to be escaped.
        ];

        return '<![CDATA[' . str_replace(array_keys($replace), array_values($replace), $data) . ']]>';
    }
}
