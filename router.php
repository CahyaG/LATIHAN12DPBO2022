<?php
// class untuk mengatur router
class Router{
    private $handlers = []; // handler berisi kumpulan fungsi yang dijalankan saat membuka suatu router

    // membuat router dengan method get
    public function get($path, $handler){
        $this->addHandler('GET', $path, $handler);
    }

    // membuat router dengan method post
    public function post($path, $handler){
        $this->addHandler('POST', $path, $handler);
    }

    // menambah handler ke array handlers
    public function addHandler($method, $path, $handler){
        // handler nya memiliki index dari gabungan method dan path request, jadi pasti unique, jika ada yang sama akan tertimpa
        $this->handlers[$method . $path] = [
            'path' => $path,
            'method' => $method,
            'handler' => $handler
        ];
    }

    // menjalankan router
    public function run(){
        $requestUri = parse_url($_SERVER["REQUEST_URI"]); // mengambil url nya
        $requestPath = $requestUri['path']; // mengambil path
        $requestPath = substr($requestPath, strpos($requestPath, "/", 1)); // menghapus folder htdocs nya di path
        $method = $_SERVER['REQUEST_METHOD']; // mengambil method request nya
        $callback = null;
        // mencari handler yang bersesuaian dengan url yang dibuka
        foreach ($this->handlers as $handler) {
            if($handler['path'] === $requestPath && $method === $handler['method']){
                $callback = $handler['handler'];
            }
        }

        // jika handler yang sesuai tidak ditemukan, berarti router nya tidak ada
        // redirect ke 404
        if(!$callback){
            header("HTTP/1.0 404 Not Found");
            return;
        }
        
        // menjalankan fungsi callback/handler yang sudah didapat
        call_user_func_array($callback, [
            array_merge($_GET, $_POST)
        ]);
    }
}