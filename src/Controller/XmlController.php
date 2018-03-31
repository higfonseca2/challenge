<?php
/**
 * @author Higor Fonseca <higfonseca@gmail.com>
 * Date: 30/03/2018 12:10
 *
 *
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
//use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use App\Entity\Upload;
use App\Entity\People;
use App\Entity\PeoplePhone;
use App\Entity\Shiporders;
use App\Entity\ShipordersItems;


class XmlController extends Controller
{
    /**
     * Simply render view
     *
     * @return Response
     *
     * @Route("/")
     */
    public function index()
    {
        return $this-> render('xml/index.html.twig', array());
    }


    /**
     * Handle file upload
     *
     * @param SessionInterface $session
     * @return Response
     *
     * @Route("/xml/upload")
     */
    public function upload(SessionInterface $session)
    {
        $xml = null;
        if (isset($_FILES['file']) && ($_FILES['file']['error'] == UPLOAD_ERR_OK)) {
            $xml = simplexml_load_file($_FILES['file']['tmp_name']);
        }

        if($xml) {

            $uploadToken = $this-> generateRandomToken();

            if(isset($xml-> person)) {
                $uploadId = $this-> saveUpload($uploadToken, 1);
                $type = 1;

                $person = json_encode($xml);
                $this-> handleXMLperson($person, $uploadId);
            }


            if(isset($xml-> shiporder)) {
                $uploadId = $this-> saveUpload($uploadToken, 2);
                $type = 2;

                $shiporder = json_encode($xml);
                $this-> handleXMLshiporder($shiporder, $uploadId);
            }
        }

        $session-> set("type", $type);
        $session-> set("token", $uploadToken);
        return new Response("OK");
    }


    /**
     * Show API URL
     *
     * @param SessionInterface $session
     * @return Response
     *
     * @Route("/xml/view")
     */
    public function view(SessionInterface $session)
    {
        $token = $session-> get("token");
        $type = $session-> get("type");

        $url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

        switch($type)
        {
            case 1:
                $api = "people";
                break;

            case 2:
                $api = "shiporders";
                break;
        }

        $url = $url . "/api/" . $token . "/" . $api;

        return $this-> render('xml/upload.html.twig', array(
            "apiUrl" => $url,
            "apiPath" => "/api/" . $token . "/" . $api
        ));
    }


    /**
     * Create random token for API authentication
     *
     * @param int $length
     * @return string
     */
    private function generateRandomToken($length = 20)
    {
        return $token = bin2hex(openssl_random_pseudo_bytes($length));
    }


    /**
     * Save file upload with auth token
     *
     * @param $token
     * @param $type
     * @return int
     */
    private function saveUpload($token, $type)
    {
        $upload = new Upload();
        $upload-> setToken($token);
        $upload-> setType($type);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager-> persist($upload);
        $entityManager->flush();

        return $upload-> getId();
    }


    /**
     * Handle people.xml
     *
     * @param $person
     * @param $uploadId
     */
    private function handleXMLperson($person, $uploadId)
    {
        $xml = json_decode($person, true);
        $entityManager = $this->getDoctrine()->getManager();


        foreach($xml["person"] as $person)
        {
            $people = new People();
            $people-> setUploadId($uploadId);
            $people-> setPersonId($person["personid"]);
            $people-> setName($person["personname"]);

            $entityManager-> persist($people);
            $entityManager->flush();
            $peopleId = $people-> getId();

            if(is_array($person["phones"]["phone"])) {
                foreach($person["phones"]["phone"] as $phone)
                {
                    $peoplePhone = new PeoplePhone();
                    $peoplePhone-> setPersonId($peopleId);
                    $peoplePhone-> setPhone($phone);

                    $entityManager-> persist($peoplePhone);
                    $entityManager->flush();
                }
            } else {
                $peoplePhone = new PeoplePhone();
                $peoplePhone-> setPersonId($peopleId);
                $peoplePhone-> setPhone($person["phones"]["phone"]);

                $entityManager-> persist($peoplePhone);
                $entityManager->flush();
            }

        }

    }


    /**
     * Handle shiporder XML
     *
     * @param $shiporder
     * @param $uploadId
     */
    private function handleXMLshiporder($shiporder, $uploadId)
    {
        $xml = json_decode($shiporder, true);
        $entityManager = $this->getDoctrine()->getManager();

        foreach($xml["shiporder"] as $shiporder)
        {
            $shiporders = new Shiporders();
            $shiporders-> setUploadId($uploadId);
            $shiporders-> setOrderId($shiporder["orderid"]);
            $shiporders-> setPersonId($shiporder["orderperson"]);
            $shiporders-> setShipTo($shiporder["shipto"]["name"]);
            $shiporders-> setShipAddress($shiporder["shipto"]["address"]);
            $shiporders-> setShipCity($shiporder["shipto"]["city"]);
            $shiporders-> setShipCountry($shiporder["shipto"]["country"]);

            $entityManager-> persist($shiporders);
            $entityManager->flush();
            $shiporderId = $shiporders-> getId();

            if(isset($shiporder["items"]["item"]["title"])) {

                $item = $shiporder["items"]["item"];

                $shiporderItems = new ShipordersItems();
                $shiporderItems-> setShiporderId($shiporderId);
                $shiporderItems-> setTitle($item["title"]);
                $shiporderItems-> setNote($item["note"]);
                $shiporderItems-> setQuantity($item["quantity"]);
                $shiporderItems-> setPrice($item["price"]);

                $entityManager-> persist($shiporderItems);
                $entityManager->flush();

            } else {

                foreach($shiporder["items"]["item"] as $item) {
                    $shiporderItems = new ShipordersItems();
                    $shiporderItems-> setShiporderId($shiporderId);
                    $shiporderItems-> setTitle($item["title"]);
                    $shiporderItems-> setNote($item["note"]);
                    $shiporderItems-> setQuantity($item["quantity"]);
                    $shiporderItems-> setPrice($item["price"]);

                    $entityManager-> persist($shiporderItems);
                    $entityManager->flush();
                }

            }

        }

    }


}