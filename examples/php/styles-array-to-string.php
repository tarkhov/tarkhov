<?php
function addStyles(string $html, array $styles, string $tag = 'p', int $limit = -1): string {
    $htmlStyles = join(';', array_map(
        fn($key, $value): string => "$key: $value", // clone array with new format
        array_keys($styles), // style names
        str_replace(';', '', array_values($styles)) // style values with removing ; in the end
    ));
    return preg_replace("/<$tag>/", "<$tag style=\"$htmlStyles\">", $html, $limit); // set limit to 1 for replacing only first tag
}

// add styles to every tag
echo addStyles(
    '<p>Example text.</p><p>Second paragraph.</p>',
    [
        'color'       => '#222222',
        'font-size'   => '16px',
        'line-height' => '150%'
    ]
);

// add only 1 tag styles
echo addStyles(
    '<p>Example text.</p><p>Second paragraph.</p>',
    [
        'color'       => '#222222',
        'font-size'   => '16px',
        'line-height' => '150%'
    ], 'p', 1
);