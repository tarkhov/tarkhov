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

function set_query_param(string $name, string | int $value, ?string $url = null): string {
    if ($url === null) {
        $url = $_SERVER['REQUEST_URI'];
        if (!$url) {
            throw new Exception('Url not found.');
        }
    }

    $parts = parse_url($url);
    $params = [];
    if (isset($parts['query'])) {
        parse_str($parts['query'], $params);
    }

    $params[$name] = $value;
    $parts['query'] = http_build_query($params);

    return build_url($parts);
}

function remove_query_param(string | array $name, ?string $url = null): string {
    if ($url === null) {
        $url = $_SERVER['REQUEST_URI'];
        if (!$url) {
            throw new Exception('Url not found.');
        }
    }

    $parts = parse_url($url);
    if (!isset($parts['query'])) {
        throw new Exception('Query not found.');
    }
    parse_str($parts['query'], $params);

    if (is_array($name)) {
        if (empty(array_intersect($name, array_keys($params)))) {
            throw new Exception("Params not found.");
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