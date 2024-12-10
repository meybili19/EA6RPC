<?php
header('Content-Type: application/json');

// Function for RPC
function helloWorld($name) {
    return "Hello $name!";
}

// Process the RPC call
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    if (isset($input['method']) && $input['method'] === 'helloWorld' && isset($input['params'][0])) {
        $result = helloWorld($input['params'][0]);
        echo json_encode(['jsonrpc' => '2.0', 'result' => $result, 'id' => 1]);
    } else {
        echo json_encode(['jsonrpc' => '2.0', 'error' => 'Method not found', 'id' => 1]);
    }
}

