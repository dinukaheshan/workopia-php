<?php

namespace App\Controllers;

class ErrorController {

    /**
     * 404 not found error
     * @return void
     */
    public function notFound($message = 'Resource Not Found') {
        http_response_code(404);
        loadView('error', [
            'status' => '404',
            'message' => $message
        ]);
    }

    /**
     * 403 not found error
     * @return void
     */
    public function unauthorized($message = 'You are not authorized to view this resource') {
        http_response_code(403);
        loadView('error', [
            'status' => '403',
            'message' => $message
        ]);
    }
}
