<?php
use PHPUnit\Framework\TestCase;
require_once "Constantes.php";
require_once "metier/Livre.php";
require_once "PDO/LivreDB.php";


class LivreDBTest extends TestCase {

    /**
     * @var LivreDB
     */
    protected $object;
    protected $pdodb;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp():void {
        //parametre de connexion à la bae de donnée
        $strConnection = Constantes::TYPE . ':host=' . Constantes::HOST . ';dbname=' . Constantes::BASE;
        $arrExtraParam = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
        $this->pdodb = new PDO($strConnection, Constantes::USER, Constantes::PASSWORD, $arrExtraParam); //Ligne 3; Instancie la connexion
        $this->pdodb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown():void {
        
    }

    /**
     * @covers LivreDB::ajout
     * @todo   Implement testAjout().
     */
    public function testAjout() {
        try {
        $this->livre = new LivreDB($this->pdodb);
   
   $l = new Livre("team","Gaumard","des infos", "LEROUXEL");
//insertion en bdd
$this->livre->ajout($l);

$livr=$this->livre->selectLivre($l->getLivre());
//echo "pers bdd: $pers";
$this->assertEquals($l->getTitre(),$livr->getTitre());
$this->assertEquals($l->getInformation(),$livr->getInformation());
$this->assertEquals($l->getEdition(),$livr->getEdition());
$this->assertEquals($l->getAuteur(),$livr->getEmail());
        } catch (Exception $e) {
            echo 'Exception recue : ', $e->getMessage(), "\n";
        }
    }

    /**
     * @covers LivreDB::update
     * @todo   Implement testUpdate().
     */
    public function testUpdate() {
        $this->object = new LivreDB($this->pdodb);
        $l = new Livre("Flaubert", "livre de Flaubert", "Galimard", "titre update");
        $l->setId(58);
      $this->object->update($l);
//update pers 
$livr=$this->livr->selectionId($l->getId());
$this->assertEquals($l->getTitre(),$livr->getTitre());
$this->assertEquals($l->getInformation(),$livr->getInformation());
$this->assertEquals($l->getEdition(),$livr->getPrenom());
$this->assertEquals($l->getAuteur(),$livr->getPrenom());
    }

    /**
     * @covers LivreDB::suppression
     * @todo   Implement testSuppression().
     */
    public function testSuppression() {
               try{
  $this->livre = new LivreDB($this->pdodb);

  $livr=$this->livre->selectionTitre("team");
$this->livre->suppression($livr);
  $livre2=$this->livre->selectionTitre("titre update");
if($livr2!=null){
      $this->markTestIncomplete(
                "La suppression de l'enreg livre a echoué"
        );
}
    }  catch (Exception $e){
        //verification exception
        $exception="RECORD LIVRE not present in DATABASE";
        $this->assertEquals($exception,$e->getMessage());

    }
    }

    /**
     * @covers LivreDB::selectAll
     * @todo   Implement testSelectAll().
     */
    public function testSelectAll() {
       $ok=true;
    $this->livre = new LivreDB($this->pdodb);
    $res=$this->livre->selectAll();
    $i=0;
   foreach ($res as $key=>$value) {
       $i++; 
   }
   print_r($res);
    if($i==0){
       $this->markTestIncomplete( 'Pas de résultat' );
      $ok=false;
    }
$this->assertTrue($ok);
    }

    /**
     * @covers LivreDB::selectLivre
     * @todo   Implement testSelectLivre().
     */
    public function testSelectLivre() {
     //TODO
    }

}
