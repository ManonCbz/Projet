<?php

require '../model/Database2.php';

// J'indique à PHP le chemin vers la classe de test de PHPUnit
use PHPUnit\Framework\TestCase;


class DatabaseTest extends TestCase
{
    private $database;

    protected function setUp()
    {
        //Cette méthode est executé par phpunit lorsqu'un test commence, je crée une nouvelle instance de ma classe
        // Calculateur que je vais stocker dans la propriété $calculateur
        $this->database = new Database2();
    }

    protected function tearDown()
    {
        //Cette méthode est éxécutée par phpUnit lorsqu'un test est terminé, ici nous libérons la mémoire en supprimant
        // l'instance de classe
        $this->database = NULL;
    }

    public function testAdd()
    {
        $result = $this->database->add(1, 2);
        $this->assertEquals(3, $result);
    }
}