<?php

class Router {
    private $routes = [];

    public function add($method, $path, $handler) {
        $this->routes[] = compact('method', 'path', 'handler');
    }

   public function dispatch($method, $uri) {
    $uri = parse_url($uri, PHP_URL_PATH);
    $uri = rtrim($uri, '/');

    // Automatically remove /event-booking-api from the URI
    $base = '/event-booking-api';
    if (strpos($uri, $base) === 0) {
        $uri = substr($uri, strlen($base));
        $uri = $uri === '' ? '/' : $uri;
    }

    foreach ($this->routes as $route) {
        if ($method !== $route['method']) continue;

        $pattern = preg_replace('/\\{([^}]+)\\}/', '(?P<\1>[^/]+)', $route['path']);
        $pattern = '#^' . rtrim($pattern, '/') . '$#';

        if (preg_match($pattern, $uri, $matches)) {
            $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
            [$controllerClass, $methodName] = $route['handler'];
            call_user_func([$controllerClass, $methodName], $params);
            return;
        }
    }

    http_response_code(404);
    echo json_encode(['error' => 'Route not found']);
}

}
