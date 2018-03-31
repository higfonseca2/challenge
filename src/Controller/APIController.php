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
     * Get People data
     *
     * @param $token
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     *
     * @Route("/api/people/{token}/all", name="app_api_people")
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
     * Get Person data
     *
     * @param $token
     * @param $personId
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     *
     * @Route("/api/people/{token}/{personId}", name="app_api_people2")
     */
    public function people2($token, $personId)
    {
        $db = $this->getDoctrine()->getManager();

        $sql = "SELECT 
                            p.id, p.personId AS personid, p.name AS personname
                        FROM
                            upload u
                                JOIN
                            people p ON u.id = p.uploadId
                        WHERE
                            u.token = :token AND
                            p.personId = :personId";

        $s1 = $db-> getConnection()-> prepare($sql);
        $s1-> bindParam(":token", $token);
        $s1-> bindParam(":personId", $personId);
        $s1-> execute();

        $result = $s1-> fetch();
        $s1 = null;

        $array = array("person" => $result);
        $array["person"]["phones"] = $this-> getPhones($result["id"]);

//        return new Response(json_encode($result));
        return $this->json($array);
    }


    /**
     * Get person phones
     *
     * @param $personId
     * @return mixed
     */
    private function getPhones($personId)
    {
        $db = $this->getDoctrine()->getManager();
        $sql = "SELECT phone FROM people_phone WHERE personId = :personId";

        $s1 = $db-> getConnection()-> prepare($sql);
        $s1-> bindParam(":personId", $personId);
        $s1-> execute();

        $result = $s1-> fetchAll();
        $s1 = null;

        return $result;
    }


    /**
     * Get shiporder data
     *
     * @param $token
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     *
     * @Route("/api/shiporders/{token}/all", name="app_api_shiporders")
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


    /**
     * Get shiporder data
     *
     * @param $token
     * @param $orderId
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     *
     * @Route("/api/shiporders/{token}/{orderId}", name="app_api_shiporders2")
     */
    public function shiporders2($token, $orderId)
    {
        $db = $this->getDoctrine()->getManager();

        $sql = "SELECT 
                    s.id,
                    s.orderId AS orderid,
                    s.personId AS orderperson,
                    s.shipTo AS shipto_name,
                    s.shipAddress AS shipto_address,
                    s.shipCity AS shipto_city,
                    s.shipCountry AS shipto_country
                FROM
                    upload u
                        JOIN
                    shiporders s ON u.id = s.uploadId
                WHERE
                    u.token = :token AND
                    s.orderId = :orderId";

        $s1 = $db-> getConnection()-> prepare($sql);
        $s1-> bindParam(":token", $token);
        $s1-> bindParam(":orderId", $orderId);
        $s1-> execute();

        $result = $s1-> fetch();
        $s1 = null;

        $shipOrder = array(
            "orderid" => $result["orderid"],
            "orderperson" => $result["orderperson"]
        );

        $shipTo = array(
            "name" => $result["shipto_name"],
            "address" => $result["shipto_address"],
            "city" => $result["shipto_city"],
            "country" => $result["shipto_country"]
        );

        $array = array("shiporder" => $shipOrder);
        $array["shiporder"]["shipto"] = $shipTo;
        $array["shiporder"]["items"] = $this-> getOrderItems($result["id"]);

//        return new Response(json_encode($result));
        return $this->json($array);
    }


    /**
     * Get order items
     *
     * @param $orderId
     * @return mixed
     */
    private function getOrderItems($orderId)
    {
        $db = $this->getDoctrine()->getManager();

        $sql = "SELECT title, note, quantity, price FROM shiporders_items WHERE shiporderId = :orderId";

        $s1 = $db-> getConnection()-> prepare($sql);
        $s1-> bindParam(":orderId", $orderId);
        $s1-> execute();

        $result = $s1-> fetchAll();
        $s1 = null;

        return $result;
    }




}