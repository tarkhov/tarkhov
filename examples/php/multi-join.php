<?php
function multi_join(string $separator = '', array $array, string $format = '%s %s'): string {
    return join($separator, array_map(
        fn($key, $value): string => sprintf($format, $key, $value),
        array_keys($array),
        array_values($array)
    ));
}

function addStyles(string $html, array $styles, string $tag = 'p', int $limit = -1): string {
    $htmlStyles = multi_join(';', $styles, '%s: %s;');
    return preg_replace("/<$tag>/", "<$tag style=\"$htmlStyles\">", $html, $limit); // set limit to 1 for replacing only first tag
}

// add styles to every tag
echo addStyles(
    '<p>Example text.</p><p>Second paragraph.</p>',
    [
        'color'       => '#000000',
        'font-size'   => '16px',
        'line-height' => '120%'
    ]
) . "\n";

// add only 1 tag styles
echo addStyles(
    '<p>Example text.</p><p>Second paragraph.</p>',
    [
        'color'       => '#000000',
        'font-size'   => '16px',
        'line-height' => '120%'
    ], 'p', 1
) . "\n";