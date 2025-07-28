<?php
namespace App\Core\Abstract;

use App\Core\Session;
use App\Core\Validator;

abstract class AbstractController{

    protected string $layout = "baseLayout";
    protected Session $session;
    protected Validator $validator;

    public function __construct()
    {
        $this->session = new Session();
        $this->validator = new Validator();
    }
  protected function toJson(array $data): string {
    header('Content-Type: application/json');
    return json_encode($data);
  }

    
    //  Affiche une vue avec un layout, accessible via $this->render_view dans les contrôleurs enfants.
     
    protected function render_view(string $view, array $data = []): void
    {
        extract($data, EXTR_SKIP);        
        $viewFile = ROOT_PATH . "/views/{$view}.html.php";
        if (!file_exists($viewFile)) {
            throw new \Exception("View {$view} not found");
        }

        ob_start();
        require $viewFile;
        $content = ob_get_clean();

        $layoutFile = ROOT_PATH . "/views/layout/{$this->layout}.html.php";
        if (file_exists($layoutFile)) {
            require $layoutFile;
        } else {
            echo $content;
        }
    }
}
