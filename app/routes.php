<?php
//add trailing slash at the end of url
/*$app->add(function ($request, $response, $next) {
    $uri = $request->getUri();
    $path = $uri->getPath();
    if ($path != '/' && substr($path, -1) != '/') {
        $uri = $uri.'/';
        return $response->withRedirect((string)$uri, 301);
    }
    return $next($request, $response);
});*/

$app->get('/', 'SlugController:index')->setName('home');

$app->post('/generate-slug', 'SlugController:generateSlug')->setName('generate.slug');

$app->get('/{slug}', 'SlugController:viewPost')->setName('view.post');