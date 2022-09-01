<?php

namespace ShopifyApi\Models;

use ShopifyApi\Client;
use ShopifyApi\Models\Traits\OwnsMetafields;

/**
 * Class Variant
 *
 * @method string getTitle()
 * @method string getProductId()
 * @method string getPrice()
 * @method string getSku()
 * @method string getPosition()
 * @method string getGrams()
 * @method string getInventoryPolicy()
 * @method string getCompareAtPrice()
 * @method string getFulfillmentService()
 * @method string getInventoryManagement()
 * @method string getOption1()
 * @method string getOption2()
 * @method string getOption3()
 * @method string getTaxable()
 * @method string getBarcode()
 * @method string getImageId()
 * @method string getInventoryQuantity()
 * @method string getWeight()
 * @method string getWeightUnit()
 * @method string getOldInventoryQuantity()
 * @method string getRequiresShipping()
 * @method $this setProductId(int $product_id)
 * @method $this setPrice(float $price)
 * @method $this setSku(string $sku)
 * @method $this setPosition(int $position)
 * @method $this setGrams(int $gram)
 * @method $this setInventoryPolicy(string $inventory_policy)
 * @method $this setOption1(string $option1)
 * @method $this setOption2(string $option2)
 * @method $this setOption3(string $option3)
 * @method $this setTaxable(int $taxable)
 * @method $this setBarcode(string $barcode)
 * @method $this setImageId(int $image_id)
 * @method $this setInventoryQuantity(int $inventory_quantity)
 * @method $this setWeight(float $weight)
 * @method $this setWeightUnit(string $weight_unit)
 * @method $this setOldInventoryQuantity(int $old_inventory_quantity)
 * @method $this setRequiresShipping(int $requires_shipping)
 * @method string hasTitle()
 * @method string hasProductId()
 * @method string hasPrice()
 * @method string hasSku()
 * @method string hasPosition()
 * @method string hasGrams()
 * @method string hasInventoryPolicy()
 * @method string hasCompareAtPrice()
 * @method string hasFulfillmentService()
 * @method string hasInventoryManagement()
 * @method string hasOption1()
 * @method string hasOption2()
 * @method string hasOption3()
 * @method string hasTaxable()
 * @method string hasBarcode()
 * @method string hasImageId()
 * @method string hasInventoryQuantity()
 * @method string hasWeight()
 * @method string hasWeightUnit()
 * @method string hasOldInventoryQuantity()
 * @method string hasRequiresShipping()
 */
class Variant extends AbstractModel
{

    use OwnsMetafields;

    /** @var string $api_name */
    protected static $api_name = 'variant';

    /** @var array $load_params */
    protected static $load_params = [];

    /** @var null|int $product_id */
    protected $product_id = null;

    /**
     * Constructor.
     *
     * @param Client $client
     * @param int $id_or_data   The id of the Variant
     * @param int $product_id   The id of the Product
     */
    public function __construct(Client $client, $id_or_data = null, $product_id = null)
    {
        if ($product_id) {
            $this->product_id = $product_id;
        }

        $this->client = $client;

        if (is_array($id_or_data)) {
            $id =isset($id_or_data['id']) ? $id_or_data['id'] : null;
            $this->api = $client->api(static::$api_name, $id);
            $this->fields = $this->api->product($product_id)->getFields();
            $this->setData($id_or_data);
        } else {
            $this->api = $client->api(static::$api_name, $id_or_data);
            $this->fields = $this->api->product($product_id)->getFields();
            if ($id_or_data) {
                $this->id = $id_or_data;
                $this->refresh();
            }
        }
    }

    /**
     * @return $this
     */
    public function refresh()
    {
        $this->preRefresh();
        $this->data = $this->api->show($this->id, static::$load_params);
        if (is_array($this->data) && array_key_exists(static::$api_name, $this->data)) {
            $this->setData($this->data[static::$api_name]);
        }
        $this->postRefresh();

        return $this;
    }

    /**
     * When you set the title, option1 must match it.
     *
     * @param $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->setOption1($title);
        return $this;
    }

    /**
     * @return \ShopifyApi\Models\Product
     */
    public function product()
    {
        return new Product($this->client, $this->getProductId());
    }

}