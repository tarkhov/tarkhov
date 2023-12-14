<?php
function filter_query_params(array $names, ?string $query = null): string {
    if ($query === null) {
        $query = $_SERVER['QUERY_STRING'];
        if (!$query) {
            throw new Exception('Query not found.');
        }
    }

    parse_str($query, $params);
    $params = array_filter($params, fn($k): bool => in_array($k, $names), ARRAY_FILTER_USE_KEY);
    if (empty($params)) {
        throw new Exception('Params not found in query string.');
    }
    return '?' . http_build_query($params);
}

echo filter_query_params(['a', 'b'], '?a=1&b=2&c=3');