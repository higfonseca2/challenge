<?php
/**
 * @author Higor Fonseca <higfonseca@gmail.com>
 * Date: 30/03/2018 21:07
 *
 *
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class APIController extends Controller
{
    /**
     * @Route("/api/{token}/people", name="app_api_people")
     */
    public function people($token)
    {
        $db = $this->getDoctrine()->getManager();

        $sql = "SELECT 
                            p.personId AS personid, p.name AS personname, pp.phone
                        FROM
                            upload u
                                JOIN
                            people p ON u.id = p.uploadId
                                JOIN
                            people_phone pp ON p.id = pp.personId
                        WHERE
                            u.token = :token";

        $s1 = $db-> getConnection()-> prepare($sql);
        $s1-> bindParam(":token", $token);
        $s1-> execute();

        $result = $s1-> fetchAll();
//        return new Response(json_encode($result));
        return $this->json($result);
    }


    /**
     * @Route("/api/{token}/shiporders", name="app_api_shiporders")
     */
    public function shiporders($token)
    {
        $db = $this->getDoctrine()->getManager();

        $sql = "SELECT 
                    s.orderId AS orderid,
                    s.personId AS orderperson,
                    s.shipTo AS shipto_name,
                    s.shipAddress AS shipto_address,
                    s.shipCity AS shipto_city,
                    s.shipCountry AS shipto_country,
                    si.title AS item_title,
                    si.note AS item_note,
                    si.quantity AS item_quantity,
                    si.price AS item_price
                FROM
                    upload u
                        JOIN
                    shiporders s ON u.id = s.uploadId
                        JOIN
                    shiporders_items si ON s.id = si.shiporderId
                WHERE
                    u.token = :token";

        $s1 = $db-> getConnection()-> prepare($sql);
        $s1-> bindParam(":token", $token);
        $s1-> execute();

        $result = $s1-> fetchAll();
//        return new Response(json_encode($result));
        return $this->json($result);
    }

}