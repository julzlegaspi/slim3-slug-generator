<?php
namespace App\Controllers;
use App\Controllers\Controller;
use App\Models\Slug;

class SlugController extends Controller
{
    public function index ($request, $response) {
        //$this->flash->addMessage('info', 'This is a simple flash message');
        $data = Slug::all();
        return $this->view->render($response, 'home.twig', [
            'title' => 'Home',
            'data' => $data,
        ]);
    }

    public function generateSlug ($request, $response) {
        $data = $request->getParsedBody();

        $url = "http://slugify.net/get-slug";
        $postdata = array(
        "separator" => "-",
        "string" => $data['title']
        );

        $req = curl_init($url);
        curl_setopt($req, CURLOPT_POST, true);
        curl_setopt($req, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
        $slugData = curl_exec($req);

        $slug = Slug::create([
            'title'     => $data['title'],
            'slug'      => $slugData,
            'comment'   => $data['comment'],
        ]);

        if ($slug) {
            $this->flash->addMessage('info', "New post has been created.");
            return $response->withRedirect($this->router->pathFor('home'));
        }
    }

    public function viewPost ($request, $response, $args) {
        $data = Slug::where('slug', $args['slug'])
                ->get();
        return $this->view->render($response, 'viewpost.twig', [
            'title' => 'Post',
            'data' => $data,
        ]);
    }
}