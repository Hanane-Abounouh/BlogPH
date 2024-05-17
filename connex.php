<?php 
class crud{
    private $con;

    public function __construct($dbname,$host,$user,$password){
        try{
            $this->con = new PDO("mysql:host=$host;dbname=$dbname",$user,$password);
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e){
            echo "Connection failed: " . $e->getMessage();
            die();
        }
    }

    public function insertData($name,$lastname,$email,$password,$id,$mobil)
    {
        try {
            $p = $this->con->prepare('INSERT INTO utilisateurs(nom_utilisateur, lastname, email, mot_de_passe, id_role, mobil) VALUES(:n, :l, :e, :p, :d, :m)');
            $p->bindValue(':n', $name);
            $p->bindValue(':l', $lastname);
            $p->bindValue(':e', $email);
            $p->bindValue(':p', $password);
            $p->bindValue(':d', $id);
            $p->bindValue(':m', $mobil);

            if ($p->execute()) {
                echo "User added successfully.";
            } else {
                echo "Error adding user.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function loginSession($email, $password){
        try {
            $p = $this->con->prepare('SELECT email FROM utilisateurs WHERE email = :e AND mot_de_passe = :p');
            $p->bindValue(':e', $email);
            $p->bindValue(':p', $password);
            $p->execute();
            if ($p->rowCount() > 0) {
                $b = $p->fetch(PDO::FETCH_ASSOC);
                session_start(); // Correct spelling of session_start
                $_SESSION['email'] = $b['email']; // Assuming 'nom_utilisateur' is the username column
                echo 'logged successfully...!';
            } else {
                echo 'make sure you are regitred!';
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

}
?>