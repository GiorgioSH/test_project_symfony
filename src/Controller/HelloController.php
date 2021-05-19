<?php 
    namespace App\Controller; 

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    class HelloController {
        /**
        *@Route("/hello")
        */
        public function hello():Response{
            // echo "Hello World";
            return new Response("hello world");
        }
       /**
        *@Route("/hello/{name}")
        */
        public function helloName($name):Response{
            return new Response("Hello" . $name);
        }
    }
?>