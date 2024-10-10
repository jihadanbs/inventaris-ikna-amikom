<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class FrameOptionsFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Tidak ada logika yang diperlukan di sini
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tambahkan header X-Frame-Options
        $response->setHeader('X-Frame-Options', 'SAMEORIGIN');
    }
}
