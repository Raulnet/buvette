<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 14/06/15
 * Time: 14:19
 */

namespace buvette\Domain;


class Recette {

    /**
     * @var
     */
    private $primProdId;

    /**
     * @var
     */
    private $productId;

    /**
     * @var
     */
    private $quantity;

    /**
     * @return mixed
     */
    public function getPrimProdId()
    {
        return $this->primProdId;
    }

    /**
     * @param mixed $primProdId
     */
    public function setPrimProdId($primProdId)
    {
        $this->primProdId = $primProdId;
    }

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @param mixed $productId
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return array Entity
     */
    public function getArray(){

        return array(
            're_prm_id' => $this->primProdId,
            're_pro_id' => $this->productId,
            're_prm_quantity' => $this->quantity,
        );
    }


}