<?php
namespace app\core;

class App{
    public static string $ROOT_PATH;
    public string $class;
    public Router $router;
    public Controller $controller;
    public Database $database;
    public Request $request;
    public static App $app;
    public View $view;
    public Response $response;
    public string $layout;
    public Session $session;
    public ?DatabaseModel $user;
    public function __construct($url,$pages,array $databaseConfigs)
    {
        $this->layout=$pages['layout']['main']??'mainlayout.php';
        self::$app=$this;
        self::$ROOT_PATH=$url;
        $this->class=$databaseConfigs['user'];

        $this->request= new request();
        $this->session= new Session();
        $this->response=new Response();
        $this->router= new Router($this->request,$this->response);
        $this->view= new view($pages);
        $this->database= new Database($databaseConfigs['database']);
        
        $sessionValue=$this->session->get('user');

        if($sessionValue){
            $result=DatabaseModel::findUser(['table'=>'temp_users',
            'id'=>$sessionValue
        ],$this->class);

        $this->user=$result?$result:null;
        }
        else
        $this->user=null;
    }

    public function startApp(){
        try{
            echo $this->router->route();
        }
        catch(\Exception $e){

            $this->response->setPageStatusCode($e->getCode());
            echo $this->view->renderView($this->view->getPage('exception'),[
                'exception'=>$e
            ]);
        }
    }

    public function login(DatabaseModel $user){
        
        $this->user=$user;
        $this->session->set('user',$user->id);
        return true;
    }


    public function logout(){
        
        $this->user=null;
        $this->session->remove('user');
    }
}

?>