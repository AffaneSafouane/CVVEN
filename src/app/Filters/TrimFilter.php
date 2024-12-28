<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class TrimFilter implements FilterInterface
{
    /**
     * @inheritDoc
     */
    public function before(RequestInterface $request, $arguments = null): void
    {
        if (! $request instanceof IncomingRequest) {
            return;
        }
        // Get the POST data and apply "trim" to each element
        $postData = $request->getPost();
        if(is_array($postData)){
            $trimmedPost = array_map('trim', $postData);
        }
        // Update the POST data globally
        request()->setGlobal('post', $trimmedPost);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // TODO: Implement after() method.
    }
}