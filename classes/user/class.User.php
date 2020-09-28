<?php 

class User{
    private $_db;
    private $_constant;
   
    public function __construct($db){
        $this->_db = $db;
    } 

    public function CheckStateApp(){
        $c = new Constant();
        $StateAppArr = $c->getStateAppArr();
       return $c->getStateApp() == $StateAppArr['Running'] ;
    }

    public function Auth($login,$password){
         
        if ($this->CheckStateApp()){
        $req = $this->_db->prepare('SELECT * FROM user WHERE email = ?');
        $req->execute([$login]);
        $user = $req->fetch();   
        if (!empty($user)){
            try {
                // on compare le password en base avec le post
                if (password_verify($password,$user->password)){
                $_SESSION['auth'] = $user;
            
                 return 1;       
                // mise en session des accès Nodes
                /*
                $req = $this->_db->prepare('SELECT * FROM  apptouser , app  WHERE apptouser.id_app  = app.id AND  apptouser.id_user  = ?');
                $req->execute(array($user->id));
                $result = $req->fetchAll();
                // init $_SESSION ['App']
                $_SESSION['App']['--'] = false;
                $_SESSION['App']['MyFlix'] = false;
                $_SESSION['App']['MyBook'] = false;
                $_SESSION['App']['MyIso'] =  false;
                $_SESSION['App']['MyDish'] = false;
                $_SESSION['App']['MyCode'] = false;
                $_SESSION['App']['MyCourse'] = false;
                // Update $_session['App'] du user
                foreach ($result as $enreg ) {
                    $_SESSION['App'][$enreg->name] = true;
                 }
                //GESTION Droit ---------
                $req = $this->_db->prepare('SELECT droit.lvl FROM  user , droit  WHERE user.id_droit  = droit.id AND  user.id  = ?');
                $req->execute(array($user->id));
                $result = $req->fetch();
                $_SESSION['Droit']['lvl'] = $result->lvl;
                */
                /////
                 
                // LOG CONNEXION
                //$log = new LogConnexion($this->_db);
               // $userIP = getUserIP();
               // $log->setUserLogConnexion($user->id,$userIP);
                }else{
                    return 0;
                }
            }catch (\Exception $e) {

            }     
        }
        }

     }
    public function  getRowsId(){
        $stmt = $this->_db->prepare('SELECT id FROM user');
        $stmt->execute();
        $users = $stmt->fetchAll();
        $stmt = null;
        return $users;
    }


    }

  