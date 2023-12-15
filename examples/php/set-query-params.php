<?php
function build_url(array $parts): string {
    $url = '';

    $delimiters = [
        'scheme'   => [
            'value' => '://',
            'after' => true
        ],
        'port'     => ['value' => ':'],
        'query'    => ['value' => '?'],
        'fragment' => ['value' => '#']
    ];

    foreach ($parts as $name => $part) {
        if (isset($delimiters[$name])) {
            if (!isset($delimiters[$name]['after'])) {
                $url .= $delimiters[$name]['value'] . $part;
            } else {
                $url .= $part . $delimiters[$name]['value'];
            }
        } else {
            $url .= $part;
        }
    }

    return $url;
}

function set_query_params(array $values, string $url): string {
    $parts = parse_url($url);
    $params = [];
    if (isset($parts['query'])) {
        parse_str($parts['query'], $params);
    }

    $params = array_merge($params, $values);
    $parts['query'] = http_build_query($params);

    return build_url($parts);
}

function remove_query_params(string | array $name, string $url): string {
    $parts = parse_url($url);
    if (!isset($parts['query'])) {
        throw new Exception('Query not found.');
    }
    parse_str($parts['query'], $params);

    if (is_array($name)) {
        if (empty(array_intersect($name, array_keys($params)))) {
            throw new Exception('Any params not found.');
        }

        foreach ($name as $param) {
            if (!isset($params[$param])) {
                continue;
            }

            unset($params[$param]);
        }
    } elseif (!isset($params[$name])) {
        throw new Exception("Param with name - $name not found.");
    } else {
        unset($params[$name]);
    }

    if (!empty($params)) {
        $parts['query'] = http_build_query($params);
    } else {
        unset($parts['query']);
    }

    return build_url($parts);
}

$url= set_query_params(['a' => 'b', 'c' => 'd', 'e' => 'f'], 'https://example.com');
echo "$url\n";
echo remove_query_params(['a', 'c'], $url) . "\n";