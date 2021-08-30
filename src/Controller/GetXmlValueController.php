<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\DomCrawler\Crawler;

class GetXmlValueController extends AbstractController
{
    /**
     * @Route("/getxml", name="get_xml_value")
     */
    public function index(): Response
    {

        $html = <<<'XML'
        <!DOCTYPE xml>
        <xml>
            <library>
                    <book>
                    <title>toto1</title>
                    <author>titi</author>
                    </book>
                    <book type="doc">
                    <title>toto2</title>
                    <author>titi</author>
                    </book>
                    <book type="roman">
                    <title>toto3</title>
                    <author>titi</author>
                    </book>
                    <book type="bd">
                    <title>toto4</title>
                    <author>titi2</author>
                    </book>
                    <library>
                    <book type="roman">
                    <title>toto5</title>
                    <author>titi</author>
                    </book>
            </library>
            </library>
        </xml>
        XML;

        $crawler = new Crawler($html);
        $crawler = $crawler->filterXPath('descendant-or-self::book');

        print('1) Retourner tous les éléments book '.'----->');
        foreach ($crawler as $domElement) {
            print($domElement->nodeValue);
        }
        print('----2) Retourner tous les éléments title ayant comme parent un élément book avec un attribut type
        égal à roman '.'----->');


        return $this->render('get_xml_value/index.html.twig', [
            'controller_name' => 'GetXmlValueController',
        ]);
    }
}
